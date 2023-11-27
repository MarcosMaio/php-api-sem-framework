<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

$GLOBALS['secretJWT'] = 'mp2607';

include_once "classes/autoload.class.php";
new Autoload();

$routes = new Routes();
$routes->add('POST', '/users/login', 'Users::login', false);
$routes->add('GET', '/clients/list', 'Clients::listAll', true);
$routes->add('GET', '/clients/list/[PARAM]', 'Clients::listUnique', true);
$routes->add('POST', '/clients/add', 'Clients::add', true);
$routes->add('PUT', '/clients/update/[PARAM]', 'Clients::update', true);
$routes->add('DELETE', '/clients/delete/[PARAM]', 'Clients::delete', true);
$routes->go($_GET['path']);
