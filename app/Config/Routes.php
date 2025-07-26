<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========================================
// PUBLIC ROUTES
// ========================================
$routes->get('/', 'Blog\BlogController::index');
$routes->get('blog', 'Blog\BlogController::index');
$routes->get('blog/details/(:num)', 'Blog\BlogController::details/$1');

// ========================================
// AUTHENTICATION ROUTES
// ========================================

// Administrator Authentication
$routes->get('admin', 'Admin\AuthController::loginForm');
$routes->post('admin', 'Admin\AuthController::login');
$routes->get('logout', 'Admin\AuthController::logout');

// Blog Users Authentication
$routes->get('auth/users', 'Admin\AuthController::userAuthForm');
$routes->post('auth/login', 'Admin\AuthController::userLogin');
$routes->post('auth/register', 'Admin\AuthController::userRegister');
$routes->get('auth/logout', 'Admin\AuthController::userLogout');

// ========================================
// ADMINISTRATIVE ROUTES
// ========================================
$routes->group('admin/posts', function($routes) {
    $routes->get('/', 'Admin\PostController::index');
    $routes->get('blogManager', 'Admin\PostController::create');
    $routes->post('store', 'Admin\PostController::store');
    $routes->get('edit/(:num)', 'Admin\PostController::edit/$1');
    $routes->post('update/(:num)', 'Admin\PostController::update/$1');
    $routes->get('delete/(:num)', 'Admin\PostController::delete/$1');
    $routes->get('search', 'Admin\PostController::search');
});


