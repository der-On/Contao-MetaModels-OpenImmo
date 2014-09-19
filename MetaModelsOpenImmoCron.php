<?php

/**
 *
 * PHP version 5
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    MetaModelsOpenImmo
 * @license    MIT
 * @filesource
 */

namespace MetaModelsOpenImmo;


class MetaModelsOpenImmoCron extends \Frontend {

    protected $mmoi = null;

    protected function compile()
    {

    }

    protected function addMessage($msg, $type = TL_INFO)
    {
        $this->log($msg, TL_CRON, $type);
    }

    public function run()
    {
        $this->import('Database');
        $this->mmoi = new MetaModelsOpenImmo();

        $rows = $this->Database->execute("SELECT id FROM tl_metamodels_openimmo WHERE deleteFilesOlderThen>0 OR autoSync!='never'")->fetchAllAssoc();
        foreach($rows as $row) {
            $metamodelObj = $this->mmoi->getMetaModelObject($row['id']);

            if ($metamodelObj['deleteFilesOlderThen'] != '0') {
                $this->deleteFiles($metamodelObj);
            }

            if ($metamodelObj['autoSync'] !== 'never') {
                $now = time();
                $syncTime = intval($metamodelObj['lastSync']);
                $timeDiff = $now - $syncTime;
                $hoursDiff = $timeDiff / 60 / 60;
                $daysDiff = $timeDiff / 60 / 60 / 24;
                $needsSync = false;

                switch($metamodelObj['autoSync']) {
                    case '':
                        break;

                    case 'hourly':
                        if ($hoursDiff >= 1) $needsSync = true;
                        break;

                    case 'daily':
                        if ($daysDiff >= 1) $needsSync = true;
                        break;

                    case 'weekly':
                        if ($daysDiff >= 7) $needsSync = true;
                        break;
                }

                if ($needsSync) {
                    $this->sync($metamodelObj);
                }

            }
        }
    }

    /**
     * Automaticly deletes files older then limit
     * @param array $metamodelObj
     */
    public function deleteFiles($metamodelObj)
    {
        $exportPath = $metamodelObj['exportPath'];
        $files = $this->mmoi->getSyncFiles($exportPath);

        $days = intval($metamodelObj['deleteFilesOlderThen']);

        $now = time();

        foreach($files as $file)
        {
            $timeDiff = $now - $file['time'];
            $daysDiff = $timeDiff / 60 / 60 / 24;

            if ($daysDiff > $days) {
                unlink(TL_ROOT . '/' . $exportPath . '/' . $file['file']);
            }
        }
    }

    public function sync($metamodelObj)
    {
        $obj = $metamodelObj;
        $exportPath = $metamodelObj['exportPath'];
        $files = $this->mmoi->getSyncFiles($exportPath);

        $file = null;
        $syncFiles = array();

        foreach($files as $file)
        {
            if ($file['synctime'] === 0) {
                $syncFiles[] = $file;
            }
        }

        $syncFiles = array_reverse($syncFiles);

        foreach($syncFiles as $syncFile) {
            if ($syncFile) {
                $path = $exportPath . '/' . $syncFile['file'];
                $rel_path = $syncFile['file'];
                if (strtolower(substr($path, -4, 4)) === '.zip') {
                    $this->mmoi->unpackSyncFile($path);
                    $extracted_path = $this->mmoi->getSyncFile($exportPath . '/tmp', false, false);
                }
                else {
                    $extracted_path = $path;
                }

                $data = $this->mmoi->loadData($extracted_path);

                if ($data) {
                    $this->addMessage('OpenImmo data loaded');
                    $syncFields = $this->mmoi->getSyncFields($obj['id'], $obj['uniqueIDField']);
                    if ($syncFields) {
                        $this->addMessage($path . ': loaded synchronization data');
                        if ($this->mmoi->syncDataWithCatalog($data, $obj, $syncFields)) {
                            $this->addMessage($path . ': data synced');
                            if ($this->mmoi->syncDataFiles($obj, $extracted_path)) {
                                $this->addMessage($path . ': files synced');
                                $mm_id = $metamodelObj['id'];
                                $now = time();
                                $this->Database->execute("UPDATE tl_metamodels_openimmo SET lastSync='$now' WHERE id='$mm_id'");
                                $success = true;
                            } else $error = 4;
                        } else $error = 3;
                    } else $error = 2;
                } else $error = 1;
                if ($error) {
                    $this->mmoi->addFileToHistory($exportPath, $rel_path, 2, 'cron');
                } else $this->mmoi->addFileToHistory($exportPath, $rel_path, 1, 'cron');
            }
        }
    }
} 