<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return $this->template->load('v_Dashboard', $data);
    }
}
