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

namespace MetaModelsOpenImmo\Models;

class MetaModelObject {

    public $id;
    public $metamodelID;
    public $exportPath;
    public $filesPath;
    public $metamodel;
    public $oiVersion;
    public $uniqueIDField;
    public $deleteFilesOlderThen;
    public $autoSync;
    public $lastSync;

    public static function fromArray(array $data = array())
    {
        return new self($data);
    }

    public function __construct(array $data = array())
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->metamodelID = isset($data['metamodel']) ? $data['metamodel'] : null;
        $this->exportPath = isset($data['exportPath']) ? $data['exportPath'] : null;
        $this->filesPath = isset($data['filesPath']) ? $data['filesPath'] : null;
        $this->metamodel = isset($data['tableName']) ? $data['tableName'] : null;
        $this->oiVersion = isset($data['oiVersion']) ? $data['oiVersion'] : null;
        $this->uniqueIDField = isset($data['uniqueIDField']) ? $data['uniqueIDField'] : null;
        $this->deleteFilesOlderThen = isset($data['deleteFilesOlderThen']) ? intval($data['deleteFilesOlderThen']) : 0;
        $this->autoSync = isset($data['autoSync']) ? intval($data['autoSync']) : 'never';
        $this->lastSync = isset($data['lastSync']) ? intval($data['lastSync']) : 0;
    }

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'metamodel' => $this->metamodelID,
            'exportPath' => $this->exportPath,
            'filesPath' => $this->filesPath,
            'tableName' => $this->metamodel,
            'oiVersion' => $this->oiVersion,
            'uniqueIDField' => $this->uniqueIDField,
            'deleteFilesOlderThen' => $this->deleteFilesOlderThen,
            'autoSync' => $this->autoSync,
            'lastSync' => $this->lastSync,
        );
    }
} 