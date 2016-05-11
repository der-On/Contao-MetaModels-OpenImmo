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

use MetaModelsOpenImmo\MetaModelsOpenImmo;
use MetaModelsOpenImmo\Api;
use MetaModelsOpenImmo\Models\MetaModelObject;

class Cron extends \Frontend {

    protected $mmoi = null;
    protected $api = null;

    public function __construct()
    {
        parent::__construct();
        $this->mmoi = new MetaModelsOpenImmo();
        $this->api = new Api();
    }

    protected function compile()
    {

    }

    public function run()
    {
        $objects = $this->api->loadAllMetaModelObjects();

        foreach($objects as $mmobj) {
            if ($mmobj->deleteFilesOlderThen != 0) {
                $this->deleteFiles($mmobj);
            }

            if ($mmobj->autoSync !== 'never') {
                $now = time();
                $syncTime = intval($mmobj->lastSync);
                $timeDiff = $now - $syncTime;
                $hoursDiff = $timeDiff / 60 / 60;
                $daysDiff = $timeDiff / 60 / 60 / 24;
                $needsSync = false;

                switch($mmobj->autoSync) {
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
                    $this->sync($mmobj);
                }
            }
        }
    }

    /**
     * Automaticly deletes files older then limit
     * @param Models\MetaModelObject $mmobj
     */
    public function deleteFiles(MetaModelObject $mmobj)
    {
        $exportPath = $mmobj->exportPath;
        $files = $this->mmoi->getSyncFiles($exportPath);

        $days = intval($mmobj->deleteFilesOlderThen);

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

    public function sync(MetaModelObject $mmobj)
    {
        $files = $this->api->getSyncFilesFor($mmobj);
        
        $file = null;
        $syncFiles = array();

        foreach($files as $file)
        {
            if ($file->syncTime === 0) {
                $syncFiles[] = $file;
            }
        }

        $syncFiles = array_reverse($syncFiles);

        foreach($syncFiles as $syncFile) {
            $this->api->syncFileFor($mmobj, $syncFile, 'cron');
        }
    }
}
