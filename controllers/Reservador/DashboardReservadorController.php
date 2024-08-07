<?php

namespace Controllers\Reservador;

use MVC\Router;
use Model\Categorias;
use Model\Servicio;
use Model\UsuarioReservador;

class DashboardReservadorController {
    
    public static function inicioReservador(Router $router) {
        $categorias = Categorias::all();

        $router->render('/reservador/index', [
            'titulo' => "Inicio Reservador",
            'categorias' => $categorias
        ]);
    }
    

    public static function perfilReservador(Router $router) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtén el ID del usuario desde la sesión
        $usuarioId = $_SESSION['id'] ?? null;

        if ($usuarioId) {
            // Obtiene el usuario de la base de datos
            $reservador = UsuarioReservador::findById($usuarioId);

            // Verifica que el usuario ha sido encontrado
            if ($reservador) {
                $router->render('/reservador/perfil', [
                    'titulo' => "Perfil Reservador",
                    'reservador' => $reservador
                ]);
            } else {
                $router->render('/reservador/error', [
                    'titulo' => "Error",
                    'mensaje' => 'No se encontró información del usuario.'
                ]);
            }
        } else {
            $router->render('/reservador/error', [
                'titulo' => "Error",
                'mensaje' => 'Debes iniciar sesión para ver tu perfil.'
            ]);
        }
    }



    public static function actualizarPerfil(Router $router) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $usuarioId = $_SESSION['id'] ?? null;
    
        if (!$usuarioId) {
            header('Location: /auth/login');
            exit();
        }
    
        $usuario = UsuarioReservador::findById($usuarioId);
        $alertas = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
    
            // Aquí, asegúrate de que validar y guardar funcionen correctamente
            $alertas = $usuario->validarNuevaCuenta();
    
            if (empty($alertas)) {
                $usuario->guardar();
                header('Location: /reservador/perfil');
                exit();
            }
        }        
    
        // Renderiza la vista de actualización de perfil
        $router->render('auth/actualizarPerfil', [
            'titulo' => "Actualizar Perfil",
            'usuario' => $usuario,
            'alertas' => $alertas            
        ]);
    }



    // public static function mostrarServiciosCategoria1(Router $router) {
    //     self::mostrarServiciosPorCategoria($router, 1, '/reservador/serviciosXcategoria/servicios_categoria_1');
    // }

    // public static function mostrarServiciosCategoria2(Router $router) {
    //     self::mostrarServiciosPorCategoria($router, 2, '/reservador/serviciosXcategoria/servicios_categoria_2');
    // }

    // public static function mostrarServiciosCategoria3(Router $router) {
    //     self::mostrarServiciosPorCategoria($router, 3, '/reservador/serviciosXcategoria/servicios_categoria_3');
    // }

    // // Método reutilizable para mostrar servicios por categoría
    // private static function mostrarServiciosPorCategoria(Router $router, $id_categoria, $vista) {
    //     $servicios = Servicio::obtenerPorCategoria($id_categoria);
    //     $categoria = Categorias::find($id_categoria);

    //     if ($categoria) {
    //         $router->render($vista, [
    //             'titulo' => "Servicios de la Categoría " . $categoria->nombre,
    //             'servicios' => $servicios,
    //             'categoria' => $categoria
    //         ]);
    //     } 
    // }


    public static function mostrarTodasCategorias(Router $router) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener todas las categorías de la base de datos
        $categorias = Categorias::obtenerTodos();

        // Renderizar la vista con las categorías
        $router->render('reservador/categorias/index', [
            'titulo' => 'Todas las Categorías',
            'categorias' => $categorias,
        ]);
    }


    public static function mostrarServiciosPorCategoria(Router $router) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener el ID de la categoría desde los parámetros de la URL o formulario
        $id_categoria = $_GET['id_categoria'] ?? null;

        // Verificar que el ID de la categoría es válido
        if ($id_categoria && is_numeric($id_categoria)) {
            // Obtener servicios y categoría de la base de datos
            $servicios = Servicio::obtenerPorCategoria($id_categoria);
            $categoria = Categorias::find($id_categoria);

            // Verifica que la categoría exista
            if ($categoria) {
                $router->render('reservador/servicios', [
                    'titulo' => "Servicios de la Categoría " . $categoria->nombre,
                    'servicios' => $servicios,
                    'categoria' => $categoria
                ]);
            } else {
                $router->render('reservador/error', [
                    'titulo' => "Error",
                    'mensaje' => 'No se encontró la categoría solicitada.'
                ]);
            }
        } else {
            $router->render('reservador/error', [
                'titulo' => "Error",
                'mensaje' => 'ID de categoría no válido.'
            ]);
        }
    }






}