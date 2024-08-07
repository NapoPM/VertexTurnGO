<?php

namespace Controllers\Empresa;

use MVC\Router;
use Model\Servicio;
use Model\Turno;

class TurnosController {

    public static function mostrarTurnos(Router $router) {
        $servicios = Servicio::obtenerServicios();
        $router->render('/empresa/turnos/crear', [
            'titulo' => "Crear Turno",
            'servicios' => $servicios,
        ]);
    }

    public static function turnos(Router $router) {
        $servicios = Servicio::obtenerServicios();

        // Verificar si se ha seleccionado un servicio
        $turnos = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idServicio = $_POST['idServicio'] ?? null;
            if ($idServicio) {
                // Obtener los turnos para el servicio seleccionado
                $turnos = Turno::whereTurn('idServicio', $idServicio);
            }
        }

        $router->render('/empresa/turnos/turnos', [
            'titulo' => "Ver Turnos",
            'servicios' => $servicios,
            'turnos' => $turnos,
        ]);
    }

    public static function crear(Router $router) {
        $servicios = Servicio::obtenerServicios();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['turno'])) {
                $args = $_POST['turno'];

                // Convertir frecuenciaMinutos a entero
                $frecuenciaMinutos = isset($args['frecuenciaMinutos']) ? (int)$args['frecuenciaMinutos'] : null;
                $horaInicio = $args['horaInicio'] ?? null;
                $horaFin = $args['horaFin'] ?? null;
                $idServicio = isset($args['idServicio']) ? (int)$args['idServicio'] : null;
                $idEmpresa = isset($args['idEmpresa']) ? (int)$args['idEmpresa'] : 1; // Valor predeterminado de 1

                if ($horaInicio && $horaFin && $frecuenciaMinutos) {
                    $horaActual = new \DateTime($horaInicio);
                    $horaFinal = new \DateTime($horaFin);

                    while ($horaActual < $horaFinal) {
                        $horaInicioIntervalo = $horaActual->format('H:i:s');
                        $horaActual->modify("+{$frecuenciaMinutos} minutes");
                        $horaFinIntervalo = $horaActual->format('H:i:s');

                        if ($horaActual > $horaFinal) {
                            break;
                        }

                        $turno = new Turno([
                            'idServicio' => $idServicio,
                            'dias' => implode(',', $args['dias']),
                            'horaInicio' => $horaInicioIntervalo,
                            'horaFin' => $horaFinIntervalo,
                            'frecuenciaMinutos' => $frecuenciaMinutos,
                            'idEmpresa' => $idEmpresa
                        ]);

                        $turno->guardar();
                    }

                    header('Location: /empresa/index');
                    exit;
                } else {
                    echo "Error: Datos incompletos para generar los turnos.";
                }
            }
        }

        $router->render('/empresa/turnos/crear', [
            'titulo' => "Crear Turno",
            'servicios' => $servicios,
        ]);
    }
    
    
    public static function actualizar(Router $router) {
        esEmpresa();
        
        // Validar que el ID del servicio sea numérico
        if (!isset($_GET['idServicio']) || !is_numeric($_GET['idServicio'])) {
            header('Location: /empresa/error');
            exit();
        }
        
        // Obtener el idServicio desde la URL
        $idServicio = $_GET['idServicio'];
    
        // Obtener todos los turnos asociados al idServicio
        $turnos = Turno::whereTurn('idServicio', $idServicio);
        
        if (empty($turnos)) {
            // Si no hay turnos asociados, manejar el error
            header('Location: /empresa/error');
            exit();
        }
    
        $servicios = Servicio::all();
        $alertas = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['turno'];
    
            // Asegúrate de que todos los datos necesarios estén presentes
            $frecuenciaMinutos = isset($args['frecuenciaMinutos']) ? (int)$args['frecuenciaMinutos'] : null;
            $horaInicio = $args['horaInicio'] ?? null;
            $horaFin = $args['horaFin'] ?? null;
            $dias = $args['dias'] ?? null; // Asegúrate de que los días estén presentes
            $idEmpresa = $turnos[0]->idEmpresa; // Suponiendo que todos los turnos tienen el mismo idEmpresa
    
            // Validar los datos
            if ($horaInicio && $horaFin && $frecuenciaMinutos && $dias) {
                // Elimina todos los turnos existentes para el idServicio actual
                Turno::eliminarPorServicio($idServicio);
    
                // Convertir los días seleccionados a una cadena
                $diasSeleccionados = implode(',', $dias);
    
                $horaActual = new \DateTime($horaInicio);
                $horaFinal = new \DateTime($horaFin);
    
                // Generar turnos en intervalos de tiempo definidos por frecuenciaMinutos
                while ($horaActual < $horaFinal) {
                    $horaInicioIntervalo = $horaActual->format('H:i:s');
                    $horaActual->modify("+{$frecuenciaMinutos} minutes");
                    $horaFinIntervalo = $horaActual->format('H:i:s');
    
                    if ($horaActual > $horaFinal) {
                        break;
                    }
    
                    $nuevoTurno = new Turno([
                        'idServicio' => $idServicio,
                        'dias' => $diasSeleccionados,
                        'horaInicio' => $horaInicioIntervalo,
                        'horaFin' => $horaFinIntervalo,
                        'frecuenciaMinutos' => $frecuenciaMinutos,
                        'idEmpresa' => $idEmpresa
                    ]);
    
                    $nuevoTurno->guardar();
                }
    
                header('Location: /empresa/index');
                exit;
            } else {
                $alertas[] = "Error: Datos incompletos para generar los turnos.";
            }
        }
    
        $router->render('empresa/turnos/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'turno' => $turnos[0], // Usa un turno para pre-llenar el formulario
            'servicios' => $servicios,
            'alertas' => $alertas
        ]);
    }
}
