<?php

include_once __DIR__ . '/../templates/alertas.php';
?>
<div class="card container mt-5 col-md-8 justify-content-center padfooter card underForm">
    <div class="card-header text-center">
        <h3>Registrarse</h3>
    </div>
    <div class="card-body">

        <!-- Aca va el formulario -->
        <form action="/crear-cuenta" class="formulario" method="POST">

            <div class="contenido" id="formularioRegistro">
                    <div class="campo">
                        <label for="nombreEmpresa">Nombre Empresa</label>
                        <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" value="<?php echo $usuario->nombreEmpresa ?>" placeholder="Ingresar Nombre">
                    </div>
                    <div class="campo">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario->nombre ?>" placeholder="Ingresar Nombre">
                    </div>
                    <div class="campo">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $usuario->apellido ?>" placeholder="Ingresar Apellido">
                    </div>
                    <div class="campo">
                        <label for="dniResponsable">DNI Responsable</label>
                        <input type="text" class="form-control" id="dniResponsable" name="dniResponsable" value="<?php echo $usuario->dniResponsable ?>" placeholder="Ingresar DNI">
                    </div>
                
                    <div class="campo">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario->telefono ?>" placeholder="15446559">
                    </div>
                    <div class="campo">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario->email ?>" placeholder="ejemplo@gmail.com">
                    </div>
                    <div class="campo">
                        <label for="codigoPostal">Código Postal</label>
                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" value="<?php echo $usuario->codigoPostal ?>" placeholder="Ingresar Codigo Portal">
                    </div>
                    <div class="campo">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresar Contraseña">
                    </div>
                
            </div>

            <input type="submit" value="Registrarse" class="boton">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
        </div>

    </div>
</div>