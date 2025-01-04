<?php

namespace App\Libraries;

class Template
{
    protected $data = [];

    // Set Data untuk Template
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    // Render Template
    public function load($view, $data = [])
    {
        $data = array_merge($this->data, $data); // Gabungkan data global dan lokal
        echo view('Templates/v_Header', $data);      // Header
        echo view('Templates/v_Sidebar', $data);     // Sidebar
        echo view($view, $data);                // Konten utama
        echo view('Templates/v_Footer', $data);      // Footer
    }
}
