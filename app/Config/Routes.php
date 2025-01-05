<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('Dokumen', 'Dokumen::index');
$routes->post('Dokumen/simpan', 'Dokumen::simpan');
$routes->get('Dokumen/hapus/(:num)', 'Dokumen::hapus/$1');
$routes->get('Dokumen/detail/(:num)', 'Dokumen::detail/$1');
// File Upload
// $routes->get('/', 'FileUploadController::index');
$routes->post('upload', 'FileUploadController::upload');
