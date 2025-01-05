<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $dokumenUpload = [
        'kd_rak' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kode rak harus diisi.',
            ],
        ],
        'file' => [
            'rules' => 'uploaded[file]|max_size[file,10000]|ext_in[file,pdf]',
            'errors' => [
                'uploaded' => 'File harus diunggah.',
                'max_size' => 'Ukuran file maksimum adalah 10 MB.',
                'ext_in' => 'File yang diunggah harus berupa PDF.',
            ],
        ],
    ];
}
