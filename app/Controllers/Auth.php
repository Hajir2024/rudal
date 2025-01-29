<?php

namespace App\Controllers;

use App\Models\M_Login;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        $session = session();
        // Cek apakah user sudah login
        if ($session->get('isLoggedIn') == true) {
            return redirect()->to('/');
        } else {
            // $session->setFlashdata('message', 'Anda Berhasil <strong>Logout..!!</strong>');
            return view('v_Login');
        }
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new M_Login();
        $request = service('request');

        $name = $request->getPost('name');
        $password = $request->getPost('password');

        $user = $model->where('name', $name)->first();

        // dd($user);

        if (!$user || $password !== dekrip($user['password'])) {
            return redirect()->to('login')->with('error', 'Nama atau password salah.');
        }

        if ($user['active'] == 0) {
            return redirect()->to('login')->with('error', 'Akun tidak aktif.');
        }
        // Simpan session hanya setelah validasi berhasil
        $session->set([
            'id'            => $user['id'],
            'name'          => $user['name'],
            'role'          => $user['role'],
            'isLoggedIn'    => true
        ]);

        return redirect()->to('/'); // Pastikan halaman ini tidak menyebabkan loop
    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // Hapus session

        // Simpan flashdata sebelum menghancurkan session
        return redirect()->to('login');
    }

    public function showSession()
    {
        $sessionData = session()->get(); // Ambil semua session
        echo '<pre>';
        print_r($sessionData);
        echo '</pre>';
    }
}
