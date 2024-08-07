<?php

namespace Controllers;

use MVC\Router;

class SimuladorController{
    public static function simulador(Router $router){
        $tituloPage = 'Simula Tu Plan';
        $router->render('/simulador',[
            'titulo' => $tituloPage
        ]);
    }
}