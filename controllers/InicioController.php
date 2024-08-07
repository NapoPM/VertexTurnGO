<?php

namespace Controllers;

use MVC\Router;

class InicioController{
    public static function inicio(Router $router){
        $router->render('inicioPage');
    }
}
