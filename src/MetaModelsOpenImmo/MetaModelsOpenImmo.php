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

/**
 * Class MetaModelsOpenImmo
 *
 * @copyright  Ondrej Brinkel 2014
 * @author     Ondrej Brinkel
 * @package    Controller
 */
class MetaModelsOpenImmo extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_metamodels_openimmo';

    /**
     * Allowed file types for attachments
     * @var string
     */
    public static $allowedAttachments = 'png,jpg,gif,pdf';

    /**
     * Flash messages presented to the user
     * @var array
     */
    protected $messages = array();

    /**
     * Flag if exported zip file was already unpacked
     * @var int
     */
    protected $zip_unpacked = 0;

    /**
     * Will be filled with flattened field paths
     * @var array
     */
    public $fieldsFlat;

    /**
     * Name of he attribute containing unique object IDs
     * @var string
     */
    protected $uniqueIDMetamodelAttributeName = null;

    /**
     * Generate module
     */
    protected function compile()
    {

    }

    /**
     * Syncs openimmo export data with database
     * @param object $dc - DataContainer
     * @return string
     */
    protected function sync($dc)
    {
        $success = false;
        $send = false;
        $obj = $this->getMetaModelObject($dc->id);
        $exportPath = $obj['exportPath'];
        $sortFilesBy = $obj['sortFilesBy'];
        $metamodel = $obj['metamodel'];

        if ($this->Input->post('FORM_SUBMIT') == 'tl_metamodels_openimmo_sync') {
            $unpacked = $this->Input->post('tl_metamodels_openimmo_zip_unpacked');
            if ($this->Input->post('tl_metamodels_openimmo_sync_file') != "") {
                if ($unpacked == "2") {
                    $this->zip_unpacked = 2;
                } else $sync_file = $this->Input->post('tl_metamodels_openimmo_sync_file');

                $file = $this->getSyncFile($exportPath);

                if ($file) {
                    if ($this->Input->post("tl_metamodels_openimmo_sync_file")) {
                        $sync_file = $this->Input->post('tl_metamodels_openimmo_sync_file');
                    }
                    $this->addMessage('OpenImmo file: ' . $file);
                    $data = $this->loadData($file);

                    if ($data) {
                        $this->addMessage('OpenImmo data loaded');
                        $syncFields = $this->getSyncFields($obj['id'], $obj['uniqueIDField']);
                        if ($syncFields) {
                            $this->addMessage('loaded synchronization data');
                            if ($this->syncDataFiles($obj, $file)) {
                                $this->addMessage('data synced');
                                if ($this->syncDataWithCatalog($data, $obj, $syncFields)) {
                                    $this->addMessage('files synced');
                                    $mm_id = $dc->id;
                                    $now = time();
                                    $this->Database->execute("UPDATE tl_metamodels_openimmo SET lastSync='$now' WHERE id='$mm_id'");
                                    $success = true;
                                } else $error = 4;
                            } else $error = 3;
                        } else $error = 2;
                    } else $error = 1;
                    if ($error) {
                        $this->addFileToHistory($exportPath, $sync_file, 2);
                    } else $this->addFileToHistory($exportPath, $sync_file, 1);
                } else $error = 0;

                $send = true;
            } else $this->addMessage($GLOBALS['TL_LANG']['tl_metamodels_openimmo']['noSyncFile']);
        }

        $this->Template = new \BackendTemplate($this->strTemplate);

        $this->Template->setData(array(
            'send' => $send,
            'messages' => $this->getMessages(),
            'files' => (!$send) ? $this->getSyncFiles($exportPath, $sortFilesBy) : null,
            'zip_unpacked' => $this->zip_unpacked,
            'success' => $success,
            'error' => $error,
            "sync_file" => $sync_file
        ));

        return $this->Template->parse();
    }

    /**
     * Will resolve special field data types
     * @param string $xpath - absolute x-path for this field in the openimmo xml
     * @param string $value - field value as retrieved from the openimmo xml
     * @param object $metamodelObj
     * @return string
     */
    private function parseFieldType($xpath, $value, $metamodelObj)
    {
        //if($this->fieldsFlat!=null) {
        if (isset($this->fieldsFlat[$xpath]) && $this->fieldsFlat[$xpath] == 'path') {
            return $metamodelObj['filesPath'] . '/' . $value;
        } else return $value;
        //} else return $value;
    }

    /**
     * Returns a metamodels object by id
     * @param string|int $id
     * @return mixed
     */
    public function getMetaModelObject($id)
    {
        $obj = $this->Database->execute("SELECT mmo.id AS id,mmo.metamodel AS metamodel, mmo.exportPath AS exportPath, mmo.filesPath AS filesPath, mmt.tableName AS tableName, mmo.oiVersion AS oiVersion, mmo.uniqueIDField AS uniqueIDField, mmo.uniqueIDMetamodelAttribute AS uniqueIDMetamodelAttribute, mmo.deleteFilesOlderThen AS deleteFilesOlderThen, mmo.autoSync AS autoSync, mmo.lastSync AS lastSync, mmo.language AS language " .
            "FROM tl_metamodels_openimmo mmo " .
            "LEFT JOIN tl_metamodel mmt ON mmt.id=mmo.metamodel " .
            "WHERE mmo.id='$id'")->fetchAssoc();

        // Contao 3 stores files in database using uuids
        if (VERSION >= '3') {
            $obj['filesPath'] = \FilesModel::findByUuid($obj['filesPath']);
            $obj['exportPath'] = \FilesModel::findByUuid($obj['exportPath']);
            $obj['filesPath'] = $obj['filesPath']->path;
            $obj['exportPath'] = $obj['exportPath']->path;
        }

        return $obj;
    }

    /**
     * Returns a list of syncable files
     * @param string $exportPath - path where files are stored
     * @param bool $canBeZip
     * @return array|bool - false of no files have been found
     */
    public function getSyncFiles($exportPath, $sortFilesBy = 'time', $canBeZip = true)
    {
        $folder = new \Folder($exportPath);

        $synced = array();

        $history = $this->Database->execute("SELECT * FROM tl_metamodels_openimmo_history")->fetchAllAssoc();

        foreach ($history as $entry) {
            $synced[$entry['file']] = array(
                "filetime" => $entry['filetime'],
                "synctime" => $entry['synctime'],
                "user" => $entry['user'],
                "status" => $entry['status']
            );
        }

        if (!$folder->isEmpty()) {
            $files = array();
            $lasttime = time();
            $checked = -1;

            //get latest file
            foreach (FilesHelper::scandirByExt($exportPath, ($canBeZip) ? array('zip', 'xml') : array('xml')) as $i => $file) {
                $mtime = FilesHelper::fileModTime($file);
                $size = FilesHelper::fileSize($file);

                if (array_key_exists($file, $synced)) {
                    $syncedMtime = intval($synced[$file]['filetime']);

                    if ($syncedMtime > 0) {
                      $mtime = $syncedMtime;
                    }

                    $user = $synced[$file]['user'];
                    $status = intval($synced[$file]['status']);
                    $synctime = intval($synced[$file]['synctime']);
                } else {
                    $user = '';
                    $status = 0;
                    $synctime = 0;
                    if ($lasttime > $mtime) {
                        $lasttime = $mtime;
                        $checked = $i;
                    }
                }

                $files[] = array(
                    "file" => $file,
                    "time" => $mtime,
                    "size" => $size,
                    "user" => $user,
                    "status" => $status,
                    "synctime" => $synctime,
                    "checked" => false
                );
            }

            if ($checked != -1) $files[$checked]['checked'] = true;

            switch($sortFilesBy) {
                case 'time':
                  usort($files, array('\MetaModelsOpenImmo\MetaModelsOpenImmo', 'sortFilesByTime'));
                  break;
                case 'name_asc':
                  usort($files, array('\MetaModelsOpenImmo\MetaModelsOpenImmo', 'sortFilesByNameAsc'));
                  break;
                case 'name_desc':
                  usort($files, array('\MetaModelsOpenImmo\MetaModelsOpenImmo', 'sortFilesByNameDesc'));
                  break;
                default:
                  usort($files, array('\MetaModelsOpenImmo\MetaModelsOpenImmo', 'sortFilesByTime'));
            }

            return $files;
        } else return false;
    }

    public static function sortFilesByTime($a, $b)
    {
        if ($a == $b) return 0;
        return ($a["time"] > $b["time"]) ? -1 : 1;
    }

    public static function sortFilesByNameAsc($a, $b)
    {
        if ($a == $b) return 0;
        return ($a["file"] < $b["file"]) ? -1 : 1;
    }

    public static function sortFilesByNameDesc($a, $b)
    {
        if ($a == $b) return 0;
        return ($a["file"] > $b["file"]) ? -1 : 1;
    }

    /**
     * Returns
     * @param string $exportPath - path to the exported openimmo files
     * @param bool $canBeZip - if true, files can be zip archives
     * @param bool $use_post - if true the sync file from the post data will be used, else the latest unsynced file will be used
     * @return bool|null|string
     */
    public function getSyncFile($exportPath, $canBeZip = true, $use_post = true)
    {
        $folder = new \Folder($exportPath);
        $currentFile = null;
        $currentTime = 0;

        if (!$folder->isEmpty()) {
            $sync_file = $this->Input->post('tl_metamodels_openimmo_sync_file');

            if (!$use_post || ($use_post && ($sync_file == null || $sync_file == ''))) {
                //get latest file
                foreach (FilesHelper::scandirByExt($exportPath, ($canBeZip) ? array('zip', 'xml') : array('xml'), !$canBeZip) as $file) {
                    $mtime = FilesHelper::fileModTime($file);
                    if ($mtime > $currentTime) {
                        $currentTime = $mtime;
                        $currentFile = $file;
                    }
                }
            } else $currentFile = $sync_file;

            if (file_exists(TL_ROOT . '/' . $currentFile)) {
                //check if it is a zip, and if so unpack it
                if ($canBeZip && $this->zip_unpacked == 0 && FilesHelper::fileExt($currentFile, true, true) == 'ZIP') {
                    $this->unpackSyncFile($currentFile);
                    $currentFile = false;
                    $this->zip_unpacked = 1;
                } elseif ($this->zip_unpacked == 2) {
                    $this->zip_unpacked = 3;
                    $currentFile = $this->getSyncFile($exportPath . '/tmp', false, false);
                }
                return $currentFile;
            } else return false;
        } else return false;
    }

    /**
     * Will unpack a zip archive
     * @param string $path - path to file to unpack
     * @throws \Exception
     */
    public function unpackSyncFile($path)
    {
        $tmpFolder = new \Folder(FilesHelper::fileDirPath($path) . 'tmp');
        //clear tmp folder if not empty
        if (!$tmpFolder->isEmpty()) $tmpFolder->clear();

        $tmpPath = $tmpFolder->__get('value');

        //extract zip to tmp folder
        $zip = new \ZipReader($path);
        $files = $zip->getFileList();
        $zip->first();
        foreach ($files as $file) {
            $content = $zip->unzip();
            $filePath = TL_ROOT . '/' . $tmpPath . '/' . $file;
            $dir = dirname($filePath);

            if (!file_exists($dir)) {
              mkdir($dir);
            }
            file_put_contents(TL_ROOT . '/' . $tmpPath . '/' . $file, $content);
            $zip->next();
        }
        //return $this->getSyncFile($tmpPath,false,false);
    }

    /**
     * Will store sync file in the history (database)
     * @param string $exportPath
     * @param array $file
     * @param string $status - status to attach to this file
     * @param string $user - (optional) username, if not set current user will be used
     */
    public function addFileToHistory($exportPath, $file, $status, $user = null)
    {
        $filetime = FilesHelper::fileModTime($file);
        $item = array(
            "file" => $file,
            "filetime" => $filetime,
            "synctime" => time(),
            "status" => $status,
            "user" => ($user) ? $user : $GLOBALS['TL_USERNAME']
        );
        $exists = $this->Database->execute("SELECT id,filetime FROM tl_metamodels_openimmo_history WHERE file = '$item[file]'")->fetchAssoc();
        if ($exists != false && count($exists) > 0) {
            $item["filetime"] = $exists["filetime"];
            $this->Database->prepare("UPDATE tl_metamodels_openimmo_history %s WHERE id='$exists[id]'")->set($item)->execute();
        } else $this->Database->prepare("INSERT INTO tl_metamodels_openimmo_history %s")->set($item)->execute();

    }

    /**
     * Loads the xml in a sync file
     * @param array $file
     * @return \SimpleXMLElement
     */
    public function loadData($file)
    {
        $data = file_get_contents(TL_ROOT . '/' . $file);

        // FlowFact 2014 uses 'imo:' namespace, so remove it to
        /*$data = str_replace('<imo:', '<', $data);
        $data = str_replace('</imo:', '</', $data);

        //remove all namespace stuff as simplexml cannot handle it reliably
        $oi_open_pos = strpos($data, '<openimmo');
        $oi_close_pos = strpos(substr($data, $oi_open_pos), '>');
        $data = substr($data, 0, $oi_open_pos) . '<openimmo>' . substr($data, $oi_close_pos + $oi_open_pos + 1);*/
        return simplexml_load_string($data);
    }

    /**
     * Returns all fields that need to be synced from the openimmo xml to the metamodel
     * @param string|int $id - metamodel openimmo field collection id
     * @param string $uniqueIDField - name of the xml field containing the unique ID
     * @return array
     */
    public function getSyncFields($id, $uniqueIDField)
    {
        $fields = array();
        $_fields = $this->Database->execute("SELECT mma.colname as metamodelAttribute, mmof.metamodelAttribute AS metamodelAttributeID , mmof.oiField AS oiField, mmof.oiFieldGroup as oiFieldGroup, mmof.oiDefaultValue as oiDefaultValue, mmof.oiCustomField as oiCustomField, mmof.oiConditionField as oiConditionField, mmof.oiConditionValue as oiConditionValue, mmof.oiCallback as oiCallback " .
            "FROM tl_metamodels_openimmo_fields mmof " .
            "LEFT JOIN tl_metamodel_attribute mma ON mma.id=mmof.metamodelAttribute " .
            "WHERE mmof.pid='" . $id . "'")->fetchAllAssoc();

        foreach ($_fields as $field) {
            //prevent loading missing metamodel fields
            if ($field['metamodelAttribute'] != '') {
                if (!isset($fields[$field['metamodelAttribute']])) {
                    $fields[$field['metamodelAttribute']] = array();
                }
                if ($field['oiCustomField'] != '') {
                    $field_obj = new Field($field['metamodelAttribute'], $field['oiCustomField'], $field['oiDefaultValue']);

                } else {
                    $field_obj = new Field($field['metamodelAttribute'], $field['oiFieldGroup'] . '/' . $field['oiField'], $field['oiDefaultValue']);
                }
                if (!empty($field['oiConditionField'])) {
                    $field_obj->setConditionField($field['oiConditionField']);
                    $field_obj->setConditionValue($field['oiConditionValue']);
                }
                if (!empty($field['oiCallback'])) {
                    $field_obj->setCallback(explode(',', $field['oiCallback'], 2));
                }
                $fields[$field['metamodelAttribute']][] = $field_obj;
            }
        }

        //add uniqueIDField
        if ($uniqueIDField != '') $fields['id'] = array(new Field('id', $uniqueIDField));

        return $fields;
    }

    /**
     * Adds flattened fields to $this->fieldsFlat
     * @param string $oiVersion - openimmo version
     */
    private function flattenFields($oiVersion)
    {
        $this->fieldsFlat = OpenImmo::getFlattenedFields($oiVersion);
    }

    /**
     * Will sync xml-data with for metamodels object
     * @param array $data
     * @param object $metamodelObj
     * @param array $syncFields - list of fields to sync
     * @return bool - true if sync was successfull, else false
     */
    public function syncDataWithCatalog(&$data, &$metamodelObj, &$syncFields)
    {
        if ($this->dataIsValid($data)) {

            //flatten fields array temporally
            $this->flattenFields($metamodelObj['oiVersion']);

            $anbieter = $this->getAnbieter($data);

            if (count($anbieter)) {
                $xpath = 'anbieter';
                $immo_id = 0;
                $sorting = 0;

                $immos = array();

                foreach ($anbieter as $_anbieter) {
                    $immo_anbieter = array();
                    $xpath = 'anbieter';
                    $this->setImmoFields($_anbieter, $immo_anbieter, $syncFields, $xpath, $metamodelObj);

                    $immobilien = $this->getImmobilien($_anbieter);

                    $xpath = 'anbieter/immobilie';

                    foreach ($immobilien as $immobilie) {
                        $immo_id++; //generate immo id
                        $sorting++;

                        //add anbieter info to immo
                        $immo = array("id" => $immo_id, "pid" => $metamodelObj['metamodel'], "tstamp" => time(), "sorting" => $sorting);
                        $immo = array_merge($immo_anbieter, $immo);

                        //immo info
                        $this->setImmoFields($immobilie, $immo, $syncFields, $xpath, $metamodelObj);

                        //store reference to xml-node
                        $immo['_xml_'] = $immobilie;

                        // execute
                        if (isset($GLOBALS['TL_HOOKS']['metaModelsOpenImmoSync'])) {
                            foreach ($GLOBALS['TL_HOOKS']['metaModelsOpenImmoSync'] as $callback)
                            {
                                $this->import($callback[0]);
                                $immo = $this->$callback[0]->$callback[1]($immo);
                            }
                        }

                        $immos[] = $immo;
                    }
                }
                $this->addMessage("found " . count($immos) . " objects");

                return $this->updateCatalog($immos, $metamodelObj);
            } else return false;
        } else {
            $this->addMessage('invalid OpenImmo data');
            return false;
        }
    }

    /**
     * Checks if xml data is valid
     * @param SimpleXml $data
     * @return bool
     */
    private function dataIsValid(&$data)
    {
        if ($data->getName() == 'openimmo') {
            $anbieter = $data->xpath('anbieter');
            if (count($anbieter)) {
                return true;
            } else return false;
        } else return false;
    }

    /**
     * Sets fields from the openimmo xml to the $immo array based on the $metamodelObj
     * @param SimpleXml $xml
     * @param array $immo
     * @param array $fields
     * @param string $xpath - base x-path to use
     * @param object $metamodelObj
     */
    private function setImmoFields(&$xml, &$immo, &$fields, $xpath, &$metamodelObj)
    {
        foreach (array_keys($fields) as $metamodelAttribute) {
            foreach ($fields[$metamodelAttribute] as $field_obj) {
                // prevent setting immo fields to anbieter
                if ($xpath === 'anbieter' && strpos($field_obj->getField(), 'anbieter/immobilie') === 0) {
                    continue;
                }

                $value = $this->getFieldData($xml, $field_obj->getField(), $xpath, $metamodelObj, false);

                if ($field_obj->hasCondition()) {
                    $condition_value = $this->getFieldData($xml, $field_obj->getConditionField(), $xpath, $metamodelObj, false);

                    // both value and condition value are not arrays
                    if (!is_array($condition_value)) {
                        // if not equal set value to null
                        if ($condition_value != $field_obj->getConditionValue()) {
                            $value = null;
                        }
                    } // value and condition are arrays, so we have to compare each value item against the corresponding condition value item
                    elseif (is_array($value) && is_array($condition_value)) {
                        foreach ($value as $i => $value_item) {
                            // if not equal we have to remove the value item
                            if (isset($condition_value[$i]) && $condition_value[$i] != $field_obj->getConditionValue()) {
                                unset($value[$i]);
                            }
                        }
                        // reindex array
                        $_value = array();
                        foreach ($value as $value_item) {
                            $_value[] = $value_item;
                        }
                        $value = $_value;
                    }
                }

                if ($field_obj->hasCallback()) {

                    $return_value = call_user_func_array($field_obj->getCallback(), array($value, $field_obj, &$immo, &$xml, $xpath, $metamodelAttribute));

                    // prevent setting value to false when call_user_func_array produced an error
                    if ($return_value) {
                        $value = $return_value;
                    }
                }

                if ($value != null) {
                    if (is_array($value)) {
                        $value = serialize($value);
                    }
                } // set default as fallback if any
                elseif (empty($value) && $field_obj->hasDefaultValue()) {
                    $value = $field_obj->getDefaultValue();
                } // no default an not existing in import, set to empty string
                else {
                    $value = '';
                }

                $immo[$metamodelAttribute] = $value;
            }
        }
    }

    /**
     * Returns data for an openimmo xml field
     * @param SimpleXml $xml
     * @param string $fieldPath - relative field x-path
     * @param string $xpath - base x-path
     * @param object $metamodelObj
     * @param bool $serialize
     * @return null|string
     */
    private function getFieldData(&$xml, $fieldPath, $xpath, &$metamodelObj, $serialize = true)
    {
        $attr_pos = strpos($fieldPath, '@');
        if ($attr_pos != FALSE) {
            $attr = substr($fieldPath, $attr_pos + 1);
            $fieldPath = substr($fieldPath, 0, $attr_pos);
        }

        $xpath_part = str_replace($xpath . '/', '', $fieldPath);

        $xmlNodes = $xml->xpath($xpath_part);
        $filePaths = array();
        $results = array();

        foreach($xmlNodes as $i => $xmlNode) {
            if ($attr) {
                $attributes = $xmlNode->attributes();
                $filePaths[$i] = $attributes[$attr];
            }
            $filePaths[$i] = $this->parseFieldType($fieldPath, $xmlNode . '', $metamodelObj);
        }

        // Contao 3 has FileModels
        if (VERSION >= '3') {
            if (isset($this->fieldsFlat[$fieldPath]) && $this->fieldsFlat[$fieldPath] == 'path') {
                $files = \FilesModel::findMultipleByPaths($filePaths);

                if ($files) {
                    foreach($files->getModels() as $i => $file) {
                        $this->attachMetaToFile($file, $xmlNodes[$i], $metamodelObj);
                        $results[] = $file->uuid;
                    }
                }

                return ($serialize) ? serialize($results) : $results;
            }
        }

        if (count($results) == 1) {
            return trim($results[0]);
        } elseif (count($results) > 1) {
            return ($serialize) ? serialize($results) : $results;
        }

        return null;
    }

    private function attachMetaToFile(\FilesModel $file, &$xmlNode, &$metamodelObj)
    {
        $titleNodes = $xmlNode->xpath('../../anhangtitel');
        $meta = is_array($file->meta) ? $meta : unserialize($file->meta);
        $lang = $metamodelObj['language'];

        if (!isset($meta[$metamodelObj->language])) {
            $meta[$lang] = array();
        }

        $meta[$lang]['title'] = count($titleNodes) ? (string) $titleNodes[0] : '';
        $file->meta = serialize($meta);
        $file->save();
    }

    /**
     * Returns the <anbieter> Xml object
     * @param SimpleXml $xml
     * @return mixed
     */
    private function getAnbieter(&$xml)
    {
        return $xml->xpath('anbieter');
    }

    /**
     * Returns all <immobilie> Xml objects
     * @param SimpleXml $xml
     * @return mixed
     */
    private function getImmobilien(&$xml)
    {
        return $xml->xpath('immobilie');
    }

    /**
     * Converts XML string values to real data types in place
     * @param array $data
     */
    private function convertDataValues(&$data)
    {
        foreach (array_keys($data) as $key) {
            switch ($data[$key]) {
                case 'true':
                    $data[$key] = 1;
                    break;

                case 'false':
                    $data[$key] = 0;
                    break;
            }
        }
    }

    private function getUniqueIdMetaModelAttributeName($metamodelObj) {
      if (!$this->uniqueIDMetamodelAttributeName) {
        $name = $this->Database->execute('SELECT colname FROM tl_metamodel_attribute WHERE id=' . $metamodelObj['uniqueIDMetamodelAttribute'])->fetchAssoc();
        $this->uniqueIDMetamodelAttributeName = $name['colname'];
      }

      return $this->uniqueIDMetamodelAttributeName;
    }

    /**
     * Updates the database with items retrieved from an openimmo xml
     * @param array $items
     * @param object $metamodelObj
     * @return bool - true if update was successfull else false
     */
    private function updateCatalog(&$items, $metamodelObj)
    {
        $uniqueIdField = $this->getUniqueIdMetaModelAttributeName($metamodelObj);
        $tableName = $metamodelObj['tableName'];

        foreach ($items as &$item) {
            //check if entry already exists
            $exists = $this->Database->execute("SELECT COUNT(id) FROM $tableName WHERE $uniqueIdField='" . $item['id'] . "'")->fetchAssoc();

            //remove if deleteAction is in use
            $deleted = $this->getFieldData($item['_xml_'], OpenImmo::$deleteActionField[$metamodelObj['oiVersion']]['path'], 'anbieter/immobilie', $metamodelObj);
            $deleted = ($deleted == OpenImmo::$deleteActionField[$metamodelObj['oiVersion']]['value']) ? true : false;

            $this->convertDataValues($item);

            if (intval($exists['COUNT(id)']) > 0) {
                //remove old entry if one exists and this should be deleted
                if ($deleted) {
                    $this->Database->execute("DELETE FROM $tableName WHERE $uniqueIdField='" . $item['id'] . "'");
                    $this->addMessage("deleted object: " . $item['id']);
                } else {
                    $id = $item['id'];
                    unset($item['id']);
                    unset($item['_xml_']);
                    $this->Database->prepare("UPDATE $tableName %s WHERE $uniqueIdField='$id'")->set($item)->execute();
                }
            } elseif (!$deleted) {
                unset($item['_xml_']);
                unset($item['id']);
                $this->Database->prepare("INSERT INTO $tableName %s")->set($item)->execute();
            }
        }
        return true;
    }

    /**
     * Syncs an openimmo xml with the database
     * @param object $metamodelObj
     * @param string $dataFile
     * @return bool - true if sync was successful else false
     */
    public function syncDataFiles(&$metamodelObj, $dataFile)
    {
        $dataPath = $metamodelObj['exportPath'] . '/tmp';

        //get attachments in the data folder
        $files = FilesHelper::scandirByExt($dataPath, explode(',', MetaModelsOpenImmo::$allowedAttachments));

        $filesFolder = new \Folder($metamodelObj['filesPath']);

        if (FilesHelper::isWritable($metamodelObj['filesPath'])) {
            $filesObj = \Files::getInstance();

            foreach ($files as $file) {
                $file = FilesHelper::filename($file);
                $filesObj->copy($dataPath . '/' . $file, $metamodelObj['filesPath'] . '/' . $file);
            }
            $this->addMessage('copied ' . count($files) . ' files from temporary directory to: ' . $metamodelObj['filesPath']);
        } else $this->addMessage('cannot copy temporary files: ' . $metamodelObj['filesPath'] . ' not writable');

        //empty the data directory if it is the temp directory so we do not have files doubled
        if (substr($dataPath, -4) == 'tmp/') {
            $dataFolder = new \Folder($dataPath);
            if (VERSION >= '3') {
                $dataFolder->purge();
            }
            else {
                $dataFolder->clear();
            }
            $this->addMessage('emptied temporary directory: ' . $dataPath);
        }

        // Since Contao 3 files must be synced with database
        if (VERSION >= '3') {
            \Dbafs::syncFiles();

            // we now have to update the file uuids for export and attachment paths
            $files = \FilesModel::findMultipleByPaths(array(
              $metamodelObj['exportPath'],
              $metamodelObj['filesPath']
            ));

            $this->Database->execute('UPDATE tl_metamodels_openimmo SET exportPath=UNHEX(\'' . bin2hex($files[0]->uuid) . '\'), filesPath=UNHEX(\'' . bin2hex($files[1]->uuid) . '\') WHERE id=' . $metamodelObj['id']);
        }

        return true;
    }

    /**
     * Adds a flash message, which will be displayed to the user
     * @param string $msg
     * @param string $strType - (default = TL_INFO)
     */
    protected function addMessage($msg, $strType = TL_INFO)
    {
        $this->messages[] = $msg;
    }

    /**
     * Returns all flash messages
     * @param bool $blnDcLayout
     * @param bool $blnNoWrapper
     * @return string
     */
    protected function getMessages($blnDcLayout = false, $blnNoWrapper = false)
    {
        $strMsg = '';

        foreach ($this->messages as $msg) {
            $strMsg .= $msg . "<br/>\n";
        }
        return $strMsg;
    }
}

?>
