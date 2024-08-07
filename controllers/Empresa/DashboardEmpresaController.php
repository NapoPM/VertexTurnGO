<?php

namespace Controllers\Empresa;

use MVC\Router;
use function PHPSTORM_META\map;

class DashboardEmpresaController{
    public static function inicioEmpresa(Router $router){
        $router->render('/empresa/index', [
            'titulo' => "Inicio Empresa"
        ]);
    }
}
