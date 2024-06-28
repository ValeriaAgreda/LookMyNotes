<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Página de inicio / login
$routes->get('/', 'Home::index');

// Rutas para manejar archivos
$routes->post('/subir', 'Archivo::upload');
$routes->get('/apuntes', 'Archivo::index');
$routes->get('/apuntesForm', 'Archivo::index2');
$routes->get('/archivo/view/(:num)', 'Archivo::view/$1');
$routes->get('/archivo/edit/(:num)', 'Archivo::edit/$1');  
$routes->post('/archivo/update/(:num)', 'Archivo::update/$1');  
$routes->post('/archivo/delete/(:num)', 'Archivo::delete/$1');  

// Rutas para reportes
$routes->get('/reportes', 'Home::indexReportes');

// Ruta para el calendario
$routes->get('/calendar', 'Calendario::index');

// Rutas de información del usuario y menú
$routes->get('/user', 'Home::informacion');
$routes->get('/menu', 'Home::menu');

// Validación de usuarios
$routes->post('/validar', 'Home::validar');

// Rutas para recordatorios del calendario
$routes->get('/reminder/getReminders', 'Calendario::getReminders');
$routes->post('/reminder/addReminder', 'Calendario::addReminder');
$routes->put('/reminder/updateReminder/(:num)', 'Calendario::updateReminder/$1');
$routes->delete('/reminder/deleteReminder/(:num)', 'Calendario::deleteReminder/$1');
$routes->get('/reminder/getReminder/(:num)', 'Calendario::getReminder/$1');

// Reporte de estudiantes por carrera
$routes->get('/reporte', 'Estudiante::reporteEstudiantesPorCarrera');

// Ruta para el filtro de archivos por materia
$routes->get('/archivo/filter', 'Archivo::index');

// Rutas para Estudiante
$routes->get('/estudiante', 'Estudiante::index');
$routes->get('/estudiante/principal', 'Estudiante::principal');
$routes->get('/estudiante/reporteEstudiantesPorCarrera', 'Estudiante::reporteEstudiantesPorCarrera');
$routes->get('/estudiante/create', 'Estudiante::create');
$routes->post('/estudiante/store', 'Estudiante::store');
$routes->get('/estudiante/edit/(:num)', 'Estudiante::edit/$1');
$routes->post('/estudiante/update/(:num)', 'Estudiante::update/$1');
$routes->post('/estudiante/delete/(:num)', 'Estudiante::delete/$1'); // Cambiar delete a post
$routes->get('/estudiante/view', 'Estudiante::view');
$routes->get('/estudiante/viewStudent/(:num)', 'Estudiante::viewStudent/$1');

?>
