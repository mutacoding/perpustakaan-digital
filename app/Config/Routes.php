<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

// Halaman Login
$routes->get('', "Auth::index");
$routes->get('registrasi', "Auth::registrasi");
$routes->get('logout', "Auth::logout");

// Halaman Admin
$routes->group("admin", ['filter' => 'authfilter'], function ($routes) {
    $routes->add("/", "Admin::index");
    $routes->add("buku", "Buku::index");
    $routes->add("kategori", "Kategori::index");
    $routes->add("mahasiswa", "User::mahasiswa");
    $routes->add("dosen", "User::dosen");
    $routes->add("prodi", "Prodi::index");
});

// Halaman Pengguna
$routes->group("user", ['filter' => 'authfilter'], function ($routes) {
    $routes->add("/", "User::index");
    $routes->add("book", "User::buku");
    $routes->add("title/(:any)", "User::detail/$1");
    $routes->add("view/(:any)", "User::view/$1");
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
