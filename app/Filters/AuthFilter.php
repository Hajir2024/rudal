<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika user belum login, redirect ke halaman login, kecuali jika dia sudah berada di /login atau /logout
        if (!$session->get('isLoggedIn')) {
            $uri = service('uri');
            $segment = $uri->getSegment(1);
            if (!in_array($segment, ['login', 'logout'])) {
                return redirect()->to('/')->with('error', 'Anda harus login terlebih dahulu.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $session = session();

        // Jika user sudah login, cegah akses ke halaman login agar tidak bisa kembali ke login
        if ($session->get('isLoggedIn')) {
            $uri = service('uri');
            $segment = $uri->getSegment(1);

            if ($segment === 'login') {
                return redirect()->to('/');
            }
        }
    }
}
