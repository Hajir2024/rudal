<?php

namespace App\Controllers;

class Dokumen extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dokumen'
        ];
        return $this->template->load('v_Dokumen', $data);
    }
}
