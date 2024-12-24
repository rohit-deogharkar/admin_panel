<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/login', "UserController::login");
$routes->post('/postlogin', "UserController::postlogin");
$routes->get('/logout', "UserController::logout");

$routes->get('/', 'Home::index');
$routes->get('add-user', "UserController::add_user");
$routes->post('post-user', "UserController::add_user_table");
$routes->get('show-users', "UserController::showusers");
$routes->get('updatedetials/(:num)', "UserController::updatedetails/$1");
$routes->post('postupdatedetials/(:num)', "UserController::postupdatedetails/$1");
$routes->get('delete/(:num)', "UserController::delete/$1");

$routes->get('/show-campaigns', "CampaignController::index");
$routes->get('/add-campaign', "CampaignController::add");
$routes->post('/insert-campaign', "CampaignController::insertCampaign");

$routes->get('/campaignupdatedetails/(:any)', "CampaignController::edit/$1");
$routes->post('/postcampaignupdatedetails/(:any)', "CampaignController::postedit/$1");
$routes->get('/deletecampaign/(:any)', "CampaignController::delete/$1");