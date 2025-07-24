<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'AuthController::loginForm');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('blog', 'Blog::index');

$routes->group('admin/posts', function($routes) {
    $routes->get('/', 'PostController::index');
    $routes->get('blogManager', 'PostController::create');
    $routes->post('store', 'PostController::store');
    $routes->get('edit/(:num)', 'PostController::edit/$1');
    $routes->post('update/(:num)', 'PostController::update/$1');
    $routes->get('delete/(:num)', 'PostController::delete/$1');
});
