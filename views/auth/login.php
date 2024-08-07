<?php

include_once __DIR__ . '/../templates/alertas.php';
?>
<div class="card container mt-5 col-md-8 justify-content-center padfooter card underForm">
    <div class="card-header text-center">
        <h3>Iniciar Sesión</h3>
    </div>
    <div class="card-body">
    <form action="/login" method="POST">
        <div class="row" id="formularioRegistro">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Tu Email" name="email" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Tu Password" name="password" />
                </div>
                <input type="submit" value="Registrarse" class="btn btn-primary btn-block">
            </div>
        </div>
    </form>
    </div>
    <div class="acciones">
        <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
</div>