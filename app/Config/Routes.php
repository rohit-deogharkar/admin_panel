<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get( 'add-user', "UserController::add_user");
$routes->post( 'post-user', "UserController::add_user_table");
$routes->get('show-users', "UserController::showusers");
$routes->get('updatedetials/(:num)', "UserController::updatedetails/$1");
$routes->post('postupdatedetials/(:num)', "UserController::postupdatedetails/$1");
$routes->get('delete/(:num)', "UserController::delete/$1");