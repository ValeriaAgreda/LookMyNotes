<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//login
$routes->get('/', 'Home::index');
//cargar archivos
$routes->post('/subir', 'Archivo::upload');
//view lista de archivos subidos
$routes->get('/apuntes', 'Archivo::index');
//ver un archivo en especifico
$routes->get('/archivo/view/(:num)', 'Archivo::view/$1');
//view del calendario
$routes->get('/calendar', 'Calendario::index');
//carga informacion del usuario*
$routes->get('/user', 'Home::informacion');
//view de inicio
$routes->get('/menu', 'Home::menu');
//valida los usuarios
$routes->post('/validar', 'Home::validar');

$routes->get('/reminder/getReminders', 'Calendario::getReminders');
$routes->post('/reminder/addReminder', 'Calendario::addReminder');

$routes->put('/reminder/updateReminder/(:num)', 'Calendario::updateReminder/$1');
$routes->delete('/reminder/deleteReminder/(:num)', 'Calendario::deleteReminder/$1');

$routes->get('/reminder/getReminder/(:num)', 'Calendario::getReminder/$1');

?>
