<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Crear-Cuenta', 'Home::crear_usuario');
$routes->get('/Ingresar', 'Home::index');
$routes->get('/Dashboard', 'Home::dashboard',['filter' => 'authGuard']);
$routes->get('/Cerrar-Sesion', 'SignInController::logout');

$routes->get('/CRUD-Productos', 'Home::crud_productos');



$routes->get('/modificar-curso/(:num)', 'Cursos_controller::edit/$1');


$routes->post('/error-producto', 'Productos_controller::formValidation');
$routes->post('/producto-modificar/(:num)', 'Productos_controller::editValidation/$1');
$routes->get('/Baja-Producto/(:num)', 'Productos_controller::delete/$1');

$routes->get('/Listar', 'Home::listar');

$routes->get('/Usuarios-Admin', 'Home::crud_usuarios');
$routes->get('/CRUD-Usuarios', 'Home::crud_usuarios');
$routes->post('/enviar-form', 'Usuarios_controller::formValidation');
$routes->get('/modificar-usuario/(:num)', 'Usuarios_controller::edit/$1');
$routes->post('/validar-edit-usuario/(:num)', 'Usuarios_controller::editValidation/$1');
$routes->get('/baja-usuario/(:num)', 'Usuarios_controller::delete/$1');

$routes->get('/Cuotas_Alumno', 'Home::cuotas_alumno');

$routes->get('/Cursos-Admin', 'Home::crud_cursos');
$routes->get('/crear-curso', 'Home::crear_curso');
$routes->get('/modificar-curso/(:num)', 'Usuarios_controller::edit/$1');

$routes->get('/baja-curso/(:num)', 'Cursos_controller::delete/$1');
$routes->post('/validar-curso', 'Cursos_controller::formValidation');
$routes->post('/validar-edit-curso/(:num)', 'Cursos_controller::editValidation/$1');

$routes->get('/registrar-pago', 'Home::registrar_pago');

$routes->post('/realizar-pago', 'Pagos_controller::realizar_pago');


$routes->get('/Pago-Empleado-Alumno', 'Home::crud_usuarios');
$routes->get('/Pago-Empleado-Cuota', 'Home::cuotas_alumno');
$routes->get('/Pago-Empleado-Cliente', 'Home::crud_clientes');
$routes->get('/Pago-Empleado-Confirmar', 'Home::registrar_pago');

$routes->get('/Cuotas-Empleado', 'Home::cuotas_empleado');


$routes->get('/crear-cliente', 'Home::crear_cliente');
$routes->post('/validar-cliente', 'Clientes_controller::validacion_crear');
$routes->get('/modificar-cliente/(:num)', 'Cliente_controller::edit/$1');

$routes->get('/CRUD-Cursos', 'Home::crud_cursos');

$routes->post('/enviar-login', 'SignInController::iniciar_sesion');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
