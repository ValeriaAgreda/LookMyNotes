<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('/subir', 'Archivo::upload');

$routes->get('/calendar', 'Calendario::index');
$routes->get('/apuntes', 'Archivo::index');


$routes->post('/validar', 'Home::validar');



