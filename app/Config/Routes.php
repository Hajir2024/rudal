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
$routes->get('Dokumen/info/(:num)', 'Dokumen::info/$1');
$routes->post('Dokumen/simpan', 'Dokumen::simpan');
$routes->post('Dokumen/getDokumenById', 'Dokumen::getDokumenById');
$routes->post('Dokumen/update', 'Dokumen::update');
$routes->post('Peminjaman/simpan', 'Peminjaman::simpan');
$routes->get('Peminjaman/info/(:segment)', 'Peminjaman::info/$1');
$routes->post('Peminjaman/updateStatus', 'Peminjaman::updateStatus');

$routes->post('DataMaster/Bidang/simpan', 'DataMaster::Bidang/simpan');
$routes->get('DataMaster/Bidang/delete/(:any)', 'DataMaster::bidang/delete/$1');

$routes->post('DataMaster/SubKegiatan/simpan', 'DataMaster::SubKegiatan/simpan');
$routes->get('DataMaster/SubKegiatan/delete/(:any)', 'DataMaster::SubKegiatan/delete/$1');

// File Upload
// $routes->get('/', 'FileUploadController::index');
$routes->post('upload', 'FileUploadController::upload');
