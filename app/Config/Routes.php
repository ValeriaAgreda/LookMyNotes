<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//login
$routes->get('/', 'Home::index');
//cargar archivos
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



$routes->get('/reporte', 'Estudiante::reporteEstudiantesPorCarrera');

?>
