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

require_once __DIR__ . '/MetaModelsOpenImmo.php';
require_once __DIR__ . '/models/MetaModelObject.php';
require_once __DIR__ . '/models/SyncFile.php';

class MetaModelsOpenImmoApi extends \Controller {

    protected $mmoi = null;

    public function __construct()
    {
        parent::__construct();
        $this->mmoi = new MetaModelsOpenImmo();
        $this->import('Database');
    }

    protected function compile()
    {

    }

    /**
     * Loads all existing MetaModelObjects
     * @return array(Models|MetaModelObject)
     */
    public function loadAllMetaModelObjects()
    {
        $objects = array();

        $rows = $this->Database->execute("SELECT id FROM tl_metamodels_openimmo")->fetchAllAssoc();
        foreach($rows as $row) {
            $objects[] = $this->loadMetaModelObject($row['id']);
        }

        return $objects;
    }

    /**
     * Returns an existing metamodels object
     * @param $id string|int - ID of a metamodels object
     * @return Models\MetaModelObject
     */
    public function loadMetaModelObject($id)
    {
        return new Models\MetaModelObject($this->mmoi->getMetaModelObject($id));
    }

    /**
     * Creates a new MetaModelObject (not saved yet)
     * @param $data array - (optional) data
     * @return Models\MetaModelObject
     */
    public function createMetaModelObject(array $data = array())
    {
        return new Models\MetaModelObject($data);
    }

    /**
     * Saves a MetaModelObject
     * @param Models\MetaModelObject $mmobj
     */
    public function saveMetaModelObject(Models\MetaModelObject $mmobj)
    {
        $values = '';

        if ($mmobj->id) {
            $id = $mmobj->id;

            //$this->Database->execute("UPDATE tl_metamodels_openimmo mmo SET $values WHERE mmo.id=$id")->fetchAll();
        }
        else {
            //$this->Database->execute("CREATE tl_metamodels_openimmo mmo SET $values")->fetchAll();
        }
    }

    /**
     * Returns all syncable files for a MetaModelObject
     * @param Models\MetaModelObject $mmobj
     * @return array(Models\SyncFile)
     */
    public function getSyncFilesFor(Models\MetaModelObject $mmobj)
    {
        $files = $this->mmoi->getSyncFiles($mmobj->exportPath);

        foreach($files as $i => $file) {
            $files[$i] = new Models\SyncFile($file);
        }

        return $files;
    }

    /**
     * Syncs one file for a MetaModelObject
     * @param Models\MetaModelObject $mmobj
     * @param Models\SyncFile $syncFile
     * @param string $user - (optional) the username who synced the file
     */
    public function syncFileFor(Models\MetaModelObject $mmobj, Models\SyncFile $syncFile, $user = '')
    {
        $exportPath = $mmobj->exportPath;
        $obj = $mmobj->toArray();

        if ($syncFile) {
            $path = $exportPath . '/' . $syncFile->file;
            $rel_path = $syncFile->file;
            if (strtolower(substr($path, -4, 4)) === '.zip') {
                $this->mmoi->unpackSyncFile($path);
                $extracted_path = $this->mmoi->getSyncFile($exportPath . '/tmp', false, false);
            }
            else {
                $extracted_path = $path;
            }

            $data = $this->mmoi->loadData($extracted_path);

            if ($data) {
                $this->log($path . ': OpenImmo data loaded', 'MetaModelsOpenImmoApi->syncFileFor', TL_IFNO);
                $syncFields = $this->mmoi->getSyncFields($mmobj->id, $mmobj->uniqueIDField);

                if ($syncFields) {
                    $this->log($path . ': loaded synchronization data', 'MetaModelsOpenImmoApi->syncFileFor', TL_IFNO);

                    if ($this->mmoi->syncDataWithCatalog($data, $obj, $syncFields)) {
                        $this->log($path . ': data synced', 'MetaModelsOpenImmoApi->syncFileFor', TL_IFNO);

                        if ($this->mmoi->syncDataFiles($obj, $extracted_path)) {
                            $this->log($path . ': files synced', 'MetaModelsOpenImmoApi->syncFileFor', TL_IFNO);

                            $mm_id = $mmobj->id;
                            $now = time();

                            $this->Database->execute("UPDATE tl_metamodels_openimmo SET lastSync='$now' WHERE id='$mm_id'");
                            $success = true;
                        } else $error = 4;
                    } else $error = 3;
                } else $error = 2;
            } else $error = 1;
            if ($error) {
                $this->mmoi->addFileToHistory($exportPath, $rel_path, 2, $user);
            } else $this->mmoi->addFileToHistory($exportPath, $rel_path, 1, $user);
        }
    }

    /**
     * Syncs all files for a given MetaModelObject
     * @param Models\MetaModelObject $mmobj
     * @param string $user - (optional) the username who synced the file
     */
    public function syncAllFilesFor(Models\MetaModelObject $mmobj, $user = '')
    {
        $files = $this->getSyncFilesFor($mmobj);

        $syncFiles = array_reverse($files);

        foreach($syncFiles as $syncFile) {
            $this->syncFileFor($mmobj, $syncFile, $user);
        }
    }
} 