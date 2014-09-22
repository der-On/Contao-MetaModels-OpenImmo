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


class SyncFile {

    public $file;
    public $time;
    public $size;
    public $user;
    public $status;
    public $syncTime;

    public function __construct(array $data = array())
    {
        $this->file = isset($data['file']) ? $data['file'] : null;
        $this->time = isset($data['time']) ? intval($data['time']) : 0;
        $this->size = isset($data['size']) ? intval($data['size']) : 0;
        $this->user = isset($data['user']) ? $data['user'] : '';
        $this->status = isset($data['status']) ? $data['status'] : 0;
        $this->syncTime = isset($data['synctime']) ? intval($data['synctime']) : 0;
    }

    public function toArray()
    {
        return array(
            'file' => $this->file,
            'time' => $this->time,
            'size' => $this->size,
            'user' => $this->user,
            'status' => $this->status,
            'synctime' => $this->syncTime
        );
    }
} 