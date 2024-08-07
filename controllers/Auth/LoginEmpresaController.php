<?php

namespace Controllers\Auth;

use Classes\Email;
use Model\UsuarioEmpresa;
use Model\UsuarioReservador;
use MVC\Router;

use function PHPSTORM_META\map;

class LoginEmpresaController{

    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar encontrar el usuario en la tabla de Empresa
            $usuario = UsuarioEmpresa::where('email', $email);
            $tipoUsuario = 'Empresa';

            // Si no se encuentra en Empresa, intentar en Reservador
            if (!$usuario) {
                $usuario = UsuarioReservador::where('email', $email);
                $tipoUsuario = 'Reservador';
            }

            // Verificar que el usuario exista y esté confirmado
            if (!$usuario || !$usuario->confirmado) {
                $alertas[] = 'El Usuario No Existe o no está confirmado';
            } else {
                if (password_verify($password, $usuario->password)) {
                    // Iniciar la sesión
                    session_start();
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['TipoUsuario'] = $usuario->TipoUsuario;
                    $_SESSION['login'] = true;

                    // Redireccionar basado en el tipo de usuario
                    if ($tipoUsuario === 'Empresa') {
                        header('Location: /empresa/index');
                    } else {
                        header('Location: /reservador/index');
                    }
                    exit(); // Asegúrate de detener la ejecución después de redirigir
                } else {
                    $alertas[] = 'Password Incorrecto';
                }
            }
        }

        // Obtener alertas de cada tipo de usuario
        $alertas = array_merge($alertas, UsuarioEmpresa::getAlertas(), UsuarioReservador::getAlertas());

        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout(Router $router){
        session_start();

        $_SESSION = [];
        header('Location: /');
    }


    public static function olvide(){
        echo "Hola Olvide Dehesa";
    }

    public static function recuperar(){
        echo "Hola Recuperar";
    }

    public static function crear(Router $router){
            $alertas = [];
            $usuario = new UsuarioEmpresa;
    
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();
    
                if(empty($alertas)) {
                    $existeUsuario = UsuarioEmpresa::where('email', $usuario->email);
    
                    if($existeUsuario) {
                        UsuarioEmpresa::setAlerta('error', 'El Usuario ya esta registrado');
                        $alertas = UsuarioEmpresa::getAlertas();
                    } else {
                        // Hashear el password
                        $usuario->hashPassword();
    
                        // Eliminar password2
                        unset($usuario->password2);
    
                        // Generar el Token
                        $usuario->crearToken();
    
                        // Crear un nuevo usuario
                        $resultado =  $usuario->guardar();
    
                        // Enviar email
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        
    
                        if($resultado) {
                            header('Location: /mensaje');
                        }
                    }
                }
            }
    
            // Render a la vista
            $router->render('auth/crear-cuenta', [
                'titulo' => 'Crea tu cuenta en TurnGO', 
                'usuario' => $usuario, 
                'alertas' => $alertas
            ]);
        }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        if(!$token) header('Location: /');
        $usuario = UsuarioEmpresa::where('token', $token);
        if (empty($usuario)) {
            UsuarioEmpresa::setAlerta('error', 'Token No Válido');
        }else{
            $usuario->confirmado = 1;
            $usuario->token = '';
            $usuario->TipoUsuario = 'Empresa';
            $usuario->guardar();
            UsuarioEmpresa::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        $alertas = UsuarioEmpresa::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}