<?php

namespace Controllers\Empresa;


use MVC\Router;
use Model\Servicio;
use Model\UsuarioEmpresa;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Categorias;
use Model\Dias;
use Model\Frecuencia;
use Model\Turno;
use function PHPSTORM_META\map;

class ServiciosController{

    
    public static function AllServicios(Router $router){
        esEmpresa();
        $servicios = Servicio::obtenerServicios();

        $id_empresa = $_SESSION['id'] ?? null;

        if ($id_empresa) {
            $servicios = Servicio::whereAll('id_empresa', $id_empresa);
        } else {
            $servicios = [];
            Servicio::setAlerta('error', 'No estás logeado como empresa');
        }
        
        $router->render('empresa/servicios/index',[
            'titulo' => 'Cargar Servicios',
            'servicios' => $servicios,
        ]);
    }
    
    public static function crear(Router $router) {
        esEmpresa();
        $alertas = [];
        $servicio = new Servicio;
        $categorias = Categorias::all();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener el id_empresa del usuario logueado
            $id_empresa = $_SESSION['id'] ?? null;
            // Sincronizar el servicio con los datos del formulario
            $servicio->sincronizar($_POST);
            // Validar los datos del servicio
            $alertas = $servicio->validarNuevoServicio();
            if (empty($alertas)) {
                // Asignar el id_empresa al servicio
                $servicio->id_empresa = $id_empresa;
                // Comprobar si ya existe un servicio con el mismo nombre (opcional)
                $existeServicio = Servicio::where('nombreServicio', $servicio->nombreServicio);
                if ($existeServicio) {
                    Servicio::setAlerta('error', 'El servicio ya está registrado');
                    $alertas = Servicio::getAlertas();
                } else {
                    // Guardar el servicio
                    // Guardar la imagen del servicio (opcional)
                    // if ($_FILES['imagenServicio']['tmp_name']) {
                    //     $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                    //     $_POST['imagenServicio'] = $nombreImagen;

                    //     // Realizar el resize a la imagen con Intervention
                    //     $image = Image::make($_FILES['imagenServicio']['tmp_name'])->fit(800, 600);
                    //     $servicio->setImagen($nombreImagen);
                    // }
                    $resultado = $servicio->guardar();
                    if ($resultado) {
                        // // Guardar la imagen en el servidor (opcional)
                        //  if ($_FILES['imagenServicio']['tmp_name']) {
                        //          $image->save(CARPETA_IMAGENES . $nombreImagen);
                        //      }

                        // Redirigir al usuario a la página de éxito
                        header('Location: /empresa/turnos/crear');
                    }
                }
            }
        }

        // Renderizar la vista

        $router->render('empresa/servicios/crear',[
            'titulo' => 'Crear Nuevo Servicio',
            'servicio' => $servicio,
            'alertas' => $alertas,
            'categorias' => $categorias
        ]);
    }
    
    
    public static function actualizar(Router $router){
        esEmpresa();
        if (!is_numeric($_GET['id'])) return;
        $servicio = Servicio::find(($_GET['id']));
        $alertas = [];
        $categorias = Categorias::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                header('Location: /empresa/turnos/actualizar?idServicio=' . $servicio->id);
                exit();
            }
        }        

        $router->render('empresa/servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
            'categorias' => $categorias    
        ]);
    }

    public static function eliminar(){
        esEmpresa();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /empresa/servicios/index'); 
        }
    }
}