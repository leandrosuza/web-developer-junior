<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('admin', 'AuthController::loginForm');
$routes->post('admin', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('blog', 'BlogController::index');
$routes->get('blog/details/(:num)', 'BlogController::details/$1');

$routes->group('admin/posts', function($routes) {
    $routes->get('/', 'AdminPostController::index');
    $routes->get('blogManager', 'AdminPostController::create');
    $routes->post('store', 'AdminPostController::store');
    $routes->get('edit/(:num)', 'AdminPostController::edit/$1');
    $routes->post('update/(:num)', 'AdminPostController::update/$1');
    $routes->get('delete/(:num)', 'AdminPostController::delete/$1');
    $routes->get('search', 'AdminPostController::search');
});
