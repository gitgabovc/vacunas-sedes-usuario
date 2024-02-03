<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/* $routes->get('/', 'Auth::index');
$routes->get('register', 'Auth::register');
$routes->post('save', 'Auth::save');
$routes->post('check', 'Auth::check'); */

// $routes->get('/', 'Propietario::index');
// $routes->get('register', 'Propietario::register');

$routes->group('',['filter'=>'AlreadyLoggedIn'], function($routes) {
    $routes->get('/', 'Propietario::index');
    $routes->get('register', 'Propietario::register');
});

$routes->group('',['filter'=>'PropietarioCheck'], function($routes) {
    $routes->get('tablero', 'Tablero::index');
});

$routes->post('save', 'Propietario::save');
$routes->post('check', 'Propietario::check');
$routes->get('propietariologout', 'Propietario::logout');

// $routes->get('tablero', 'Tablero::index');

$routes->post('guardarm', 'Mascota::guardarm');
$routes->get('mascota/modificar/(:num)', 'Mascota::modificar/$1');
$routes->put('mascota/update/(:num)', 'Mascota::update/$1');
$routes->post('mascota/delete/(:num)', 'Mascota::delete/$1');
$routes->get('mascota/carnet/(:num)', 'Mascota::vercarnet/$1');

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
