<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('Dokumen', 'Dokumen::index');
$routes->get('Pinjam', 'Peminjaman::Pinjam');
$routes->get('DaftarPeminjam', 'Peminjaman::DaftarPeminjam');
$routes->post('Dokumen/simpan', 'Dokumen::simpan');
$routes->get('Dokumen/hapus/(:num)', 'Dokumen::hapus/$1');
$routes->get('Dokumen/detail/(:num)', 'Dokumen::detail/$1');
$routes->post('Dokumen/getDokumenById', 'Dokumen::getDokumenById');
$routes->post('Dokumen/update', 'Dokumen::update');
$routes->post('Peminjaman/simpan', 'Peminjaman::simpan');
// File Upload
// $routes->get('/', 'FileUploadController::index');
$routes->post('upload', 'FileUploadController::upload');
