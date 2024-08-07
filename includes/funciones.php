<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function pagina_actual($path ) : bool {
    return str_contains( $_SERVER['PATH_INFO'] ?? '/', $path  ) ? true : false;
}

function esEmpresa() : void{
    isAuth();
    // Verificar si el usuario está logueado y es del tipo Empresa
    if (!isset($_SESSION['login']) || !$_SESSION['login'] || $_SESSION['TipoUsuario'] !== 'Empresa') {
        // Redirigir a la página de inicio si no cumple con los requisitos
        header('Location: /');
        exit();
    }
}

function esReservador() : void{
    isAuth();
    // Verificar si el usuario está logueado y es del tipo Empresa
    if (!isset($_SESSION['login']) || !$_SESSION['login'] || $_SESSION['TipoUsuario'] !== 'Reservador') {
        // Redirigir a la página de inicio si no cumple con los requisitos
        header('Location: /');
        exit();
    }
}