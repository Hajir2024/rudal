<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Login extends Model
{
    protected $table = 'users'; // Nama tabel di database

    // Kolom yang diizinkan untuk operasi CRUD
    protected $allowedFields = ['name', 'password', 'active', 'role'];

    // Aktifkan timestamp otomatis
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
