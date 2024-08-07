<?php 

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';

use Controllers\InicioController;
use Controllers\Auth\LoginEmpresaController;
use Controllers\Auth\LoginUsuarioController;
use Controllers\empresa\DashboardEmpresaController;
use Controllers\Empresa\ServiciosController;
use Controllers\Empresa\TurnosController;
use Controllers\Reservador\DashboardReservadorController;
use MVC\Router;

$router = new Router();

// Inicio Página
// $router->get('/', [InicioController::class, 'inicio']);
$router->get('/', [InicioController::class, 'inicio']);

// Iniciar Sesión
$router->get('/login', [LoginEmpresaController::class, 'login']);
$router->post('/login', [LoginEmpresaController::class, 'login']);

// Cerrar Sesión
$router->get('/logout', [LoginEmpresaController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginEmpresaController::class, 'olvide']);
$router->post('/olvide', [LoginEmpresaController::class, 'olvide']);
$router->get('/recuperar', [LoginEmpresaController::class, 'recuperar']);
$router->post('/recuperar', [LoginEmpresaController::class, 'recuperar']);


// Crear Cuenta
$router->get('/crear-cuenta', [LoginEmpresaController::class, 'crear']);
$router->post('/crear-cuenta', [LoginEmpresaController::class, 'crear']);

// Confirmar Cuenta
$router->get('/confirmar-cuenta', [LoginEmpresaController::class, 'confirmar']);
$router->get('/mensaje', [LoginEmpresaController::class, 'mensaje']);

// ZONA DE EMPRESA
$router->get('/empresa/index', [DashboardEmpresaController::class, 'inicioEmpresa']);

// ZONA SERVICIOS
$router->get('/empresa/servicios/index', [ServiciosController::class, 'AllServicios']);
$router->get('/empresa/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/empresa/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/empresa/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/empresa/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

// ZONA TURNOS
$router->get('/empresa/turnos/crear', [TurnosController::class, 'mostrarTurnos']); // Mostrar el formulario
$router->post('/empresa/turnos/crear', [TurnosController::class, 'crear']); // Procesar el formulario
$router->get('/empresa/turnos/actualizar', [TurnosController::class, 'actualizar']);
$router->post('/empresa/turnos/actualizar', [TurnosController::class, 'actualizar']);
$router->get('/empresa/turnos/turnos', [TurnosController::class, 'turnos']); // Mostrar el formulario
$router->post('/empresa/turnos/turnos', [TurnosController::class, 'turnos']); 


// //////////////////////////////////////////////////////// //
/* ZONA RESREVADOR */
// Iniciar Sesión - RESERVADOR
// $router->get('/login', [LoginUsuarioController::class, 'login']);
// $router->post('/login', [LoginUsuarioController::class, 'login']);

// Cerrar Sesión  - RESERVADOR
$router->get('/index', [LoginUsuarioController::class, 'inicioReservador']);
$router->get('/logout', [LoginUsuarioController::class, 'logout']);

// Recuperar Password  - RESERVADOR
$router->get('/olvide', [LoginUsuarioController::class, 'olvide']);
$router->post('/olvide', [LoginUsuarioController::class, 'olvide']);
$router->get('/recuperar', [LoginUsuarioController::class, 'recuperar']);
$router->post('/recuperar', [LoginUsuarioController::class, 'recuperar']);

// Crear Cuenta  - RESERVADOR
$router->get('/crear-cuentaRES', [LoginUsuarioController::class, 'crear']);
$router->post('/crear-cuentaRES', [LoginUsuarioController::class, 'crear']);

// Confirmar Cuenta  - RESERVADOR
$router->get('/confirmar-cuenta', [LoginUsuarioController::class, 'confirmar']);
$router->get('/mensaje', [LoginUsuarioController::class, 'mensaje']);

//ZONA RESERVADOR
$router->get('/reservador/index', [DashboardReservadorController::class, 'inicioReservador']);

// Mostrar todas las categorías - RESERVADOR
$router->get('/reservador/categorias', [DashboardReservadorController::class, 'mostrarTodasCategorias']);

// Ruta para mostrar servicios por categoría usando un parámetro GET - RESERVADOR
$router->get('/reservador/categoria', [DashboardReservadorController::class, 'mostrarServiciosPorCategoria']);

// Perfil - RESERVADOR
$router->get('/reservador/perfil', [DashboardReservadorController::class, 'perfilReservador']);

$router->get('/auth/actualizarPerfil', [DashboardReservadorController::class, 'actualizarPerfil']);
$router->post('/auth/actualizarPerfil', [DashboardReservadorController::class, 'actualizarPerfil']);





// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();