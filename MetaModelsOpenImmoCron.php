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

    protected function compile()
    {

    }

    public function run()
    {
        $this->import('Database');

        $rows = $this->Database->execute('SELECT id FROM tl_metamodels_openimmo WHERE deleteFilesOlderThen>0')->fetchAllAssoc();
        foreach($rows as $row) {
            $this->deleteFiles($row['id']);
        }
    }

    /**
     * Automaticly deletes files older then limit
     * @param string|int $id
     */
    public function deleteFiles($id)
    {
        $mmoi = new MetaModelsOpenImmo();
        $metamodelObj = $mmoi->getMetaModelObject($id);
        $exportPath = $metamodelObj['exportPath'];
        $files = $mmoi->getSyncFiles($exportPath);

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
} 