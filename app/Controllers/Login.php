<?php

namespace App\Controllers;

use App\Models\M_Login;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('v_Login'); // Menampilkan halaman login
    }

    public function auth()
    {
        $session = session();
        $model = new M_Login();

        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password');

        // Ambil data pengguna berdasarkan name
        $user = $model->where('name', $name)->first();

        if ($user) {
            // Verifikasi password
            // if (password_verify($password, $user['password'])) {
            //     $session->set([
            //         'id'  => $user['id'],
            //         'name' => $user['name'],
            //         'logged_in' => true
            //     ]);
            // Cek apakah password sesuai (tanpa hashing)
            if ($password === $user['password']) {
                $session->set([
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'logged_in' => true
                ]);
                return redirect()->to('/'); // Redirect ke dashboard
            } else {
                $session->setFlashdata('error', 'Password salah!');
            }
        } else {
            $session->setFlashdata('error', 'Name tidak ditemukan!');
        }

        return redirect()->to('/login'); // Redirect kembali ke login
    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // Hapus session
        return redirect()->to('/login'); // Redirect ke halaman login
    }
}
