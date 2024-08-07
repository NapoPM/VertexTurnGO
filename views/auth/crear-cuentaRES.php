<?php

// include_once __DIR__ . '/../templates/alertas.php';
?>
<div class="contenedor">

    <p class="descripcion-pagina">Registrarse</p>


    <form class="formulario" method="POST" action="/crear-cuentaRES">
        <div class="contenido">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php s($usuario->nombre) ?>" placeholder="Ingresar Nombre">
            </div>

            <div class="campo">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php s($usuario->apellido) ?>" placeholder="Ingresar Apellido">
            </div>

            <div class="campo">
                <label for="DNI">DNI</label>
                <input type="text" class="form-control" id="DNI" name="DNI" value="<?php s($usuario->DNI) ?>" placeholder="Ingresar DNI">
            </div>

            <div class="campo">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php s($usuario->email) ?>" placeholder="ejemplo@gmail.com">
            </div>

            <div class="campo">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php s($usuario->telefono) ?>" placeholder="15446559">
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php s($usuario->password) ?>" placeholder="Ingresar Contraseña">
            </div>

            <input type="submit" value="Registrarse" class="boton">
        </div>

    </form>

    <div class="acciones">
        <a href="/login">¿Ya tienes una cuenta? Iniciar Session</a>
        <a href="/olvide">¿Olvidaste tu Password? Recuperar contraseña</a>
    </div>

</div>