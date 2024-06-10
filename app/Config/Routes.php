<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('/subir', 'Archivo::upload');
$routes->get('/apuntes', 'Archivo::index');
$routes->get('/reportes', 'Home::indexReportes');
$routes->get('/apuntesForm', 'Archivo::index2');
$routes->get('/archivo/view/(:num)', 'Archivo::view/$1');
$routes->get('/archivo/edit/(:num)', 'Archivo::edit/$1');  // Ruta para la vista de edición
$routes->post('/archivo/update/(:num)', 'Archivo::update/$1');  // Ruta para actualizar el archivo
$routes->post('/archivo/delete/(:num)', 'Archivo::delete/$1');  // Ruta para eliminar el archivo

$routes->get('/calendar', 'Calendario::index');
$routes->get('/user', 'Home::informacion');
$routes->get('/menu', 'Home::menu');

$routes->post('/validar', 'Home::validar');

$routes->get('reminder', 'Reminder::index');
$routes->get('reminder/create', 'Reminder::create');
$routes->post('reminder/store', 'Reminder::store');
$routes->get('reminder/edit/(:num)', 'Reminder::edit/$1');
$routes->post('reminder/update/(:num)', 'Reminder::update/$1');
$routes->get('reminder/delete/(:num)', 'Reminder::delete/$1');

?>
