<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('Dokumen', 'Dokumen::index');
$routes->get('Bidang', 'DataMaster::Bidang');
$routes->get('SubKegiatan', 'DataMaster::SubKegiatan');
$routes->get('Pinjam', 'Peminjaman::Pinjam');
$routes->get('DaftarPeminjam', 'Peminjaman::DaftarPeminjam');
$routes->get('Dokumen/hapus/(:num)', 'Dokumen::hapus/$1');
$routes->get('Dokumen/detail/(:num)', 'Dokumen::detail/$1');
// $routes->get('Dokumen/info/(:num)', 'Dokumen::info/$1');
$routes->post('Dokumen/simpan', 'Dokumen::simpan');
$routes->post('Dokumen/getDokumenById', 'Dokumen::getDokumenById');
$routes->post('Dokumen/update', 'Dokumen::update');
$routes->post('Peminjaman/simpan', 'Peminjaman::simpan');

// File Upload
// $routes->get('/', 'FileUploadController::index');
$routes->post('upload', 'FileUploadController::upload');
