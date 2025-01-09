<?php

namespace App\Controllers;

use App\Models\M_Bidang;
use App\Models\M_SubKegiatan;

class DataMaster extends BaseController
{
    protected $bidang;
    protected $subkegiatan;

    public function __construct()
    {
        $this->bidang = new M_Bidang();
        $this->subkegiatan = new M_SubKegiatan();
    }

    public function Bidang()
    {
        $data = [
            'title' => 'Data Master',
            'bidang' => $this->bidang->getDataBidang(),
        ];
        return $this->template->load('v_Bidang', $data);
    }

    public function SubKegiatan()
    {
        $data = [
            'title' => 'Data Master',
            'bidang' => $this->bidang->getDataBidang(),
            'subkeg' => $this->subkegiatan->getDataSubKeg(),
        ];
        return $this->template->load('v_SubKegiatan', $data);
    }
}
