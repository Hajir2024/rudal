<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Bidang extends Model
{
    protected $table      = 'bidangs';
    protected $useTimestamps = true;
    protected $allowedFields = ['bidang', 'kode'];


    public function getDataBidang()
    {
        return $this->findAll();
    }
}
