<?php

namespace Controllers\Reservador;

use MVC\Router;
use Model\Servicio;
use Model\Categorias;
use Model\Turno;

class TurnosController {

    public static function sacarTurno(Router $router) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicioId = $_POST['servicio_id'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];

            // Aca añadir la lógica para guardar el turno en la base de datos
            // Por ejemplo, verificar disponibilidad, guardar el turno, enviar confirmaciones, etc.

            // Simulación de guardado de turno
            $turnoGuardado = true;  // Esto debería ser el resultado real de la lógica de guardado

            if ($turnoGuardado) {
                $_SESSION['mensaje_exito'] = 'Turno agendado con éxito.';
                header('Location: /reservador/categoria?id_categoria=' . $_POST['id_categoria']);
                exit();
            } else {
                $_SESSION['mensaje_error'] = 'Hubo un problema al agendar el turno. Inténtalo de nuevo.';
                header('Location: /reservador/categoria?id_categoria=' . $_POST['id_categoria']);
                exit();
            }
        }
    }
}