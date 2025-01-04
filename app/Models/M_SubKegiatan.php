<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SubKegiatan extends Model
{
    protected $table      = 'sub_kegiatans';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_bid', 'sub_kegiatan'];


    public function getDataSubKeg()
    {
        return $this->findAll();
    }
}
