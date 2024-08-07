<?php

namespace Controllers\Auth;

use Classes\Email;
use Model\UsuarioReservador;
use MVC\Router;

use function PHPSTORM_META\map;

class LoginUsuarioController{

    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new UsuarioReservador($_POST);
            $alertas = $usuario->validarLogin();
        
            if(empty($alertas)) {
                // Verificar quel el usuario exista
                $usuario = UsuarioReservador::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmado ) {
                    UsuarioReservador::setAlerta('error', 'El Usuario No Existe o no esta confirmado');
                } else {
                    // El Usuario existe
                    if (password_verify($_POST['password'], $usuario->password)) {
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['TipoUsuario'] = $usuario->TipoUsuario;
                        $_SESSION['login'] = true;
                    
                        // Redireccionar basado en el tipo de usuario
                        if ($usuario->TipoUsuario === "Reservador") {
                            header('Location: /reservador/index');
                        } else {
                            header('Location: /');
                        }
                        exit(); // Asegúrate de detener la ejecución después de redirigir
                    } else {
                        UsuarioReservador::setAlerta('error', 'Password Incorrecto');
                    }
                }
            }
        }

        $alertas = UsuarioReservador::getAlertas();
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
        echo "Hola Olvide";
    }

    public static function recuperar(){
        echo "Hola Recuperar";
    }

    public static function crear(Router $router){
            $alertas = [];
            $usuario = new UsuarioReservador();
    
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();
    
                if(empty($alertas)) {
                    $existeUsuario = UsuarioReservador::where('email', $usuario->email);
    
                    if($existeUsuario) {
                        UsuarioReservador::setAlerta('error', 'El Usuario ya esta registrado');
                        $alertas = UsuarioReservador::getAlertas();
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
            $router->render('auth/crear-cuentaRES', [
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
        $usuario = UsuarioReservador::where('token', $token);
        if (empty($usuario)) {
            UsuarioReservador::setAlerta('error', 'Token No Válido');
        }else{
            $usuario->confirmado = 1;
            $usuario->token = '';
            $usuario->TipoUsuario = 'Reservador';
            $usuario->guardar();
            UsuarioReservador::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        $alertas = UsuarioReservador::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
}
