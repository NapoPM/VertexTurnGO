<?php
esReservador();
?>

<h1>Mi Perfil</h1>

<?php if (!empty($reservador)): ?>
    <div class="profile-container">
        <div class="profile-info">
            <h2>Información del Usuario</h2>
            <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($reservador->nombre . ' ' . $reservador->apellido); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($reservador->telefono); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($reservador->email); ?></p>
            <button id="editar-perfil" onclick="mostrarFormulario()">Editar Perfil</button> 
        </div>
    </div>

    <!-- Formulario de Actualización del Perfil -->
    <div id="formulario-actualizar-perfil" style="display: none;">
        <h2>Actualizar Perfil</h2>
        <p class="descripcion-pagina">Modifica los valores del formulario.</p>

        <form class="formulario" method="POST" action="/auth/actualizarPerfil">
            <div class="contenido">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($reservador->nombre); ?>" placeholder="Ingresar Nombre">
                </div>

                <div class="campo">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($reservador->telefono); ?>" placeholder="Ingresar Telefono">
                </div>

                <div class="campo">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($reservador->email); ?>" placeholder="ejemplo@gmail.com">
                </div>

                <input type="submit" value="Actualizar" class="boton">
            </div>
        </form>
    </div>
<?php else: ?>
    <p>No se encontró información del usuario.</p>
<?php endif; ?>



<h2>Notificaciones</h2>

<div class="notifications-container">
    <?php if (!empty($notificaciones)) : ?>
        <?php foreach ($notificaciones as $notificacion) : ?>
            <div class="notification">
                <p><?php echo htmlspecialchars($notificacion->mensaje); ?></p>
                <button onclick="eliminarNotificacion(<?php echo $notificacion->id; ?>)">Eliminar</button>
            </div>
        <?php endforeach; ?>
        <button onclick="eliminarTodasNotificaciones()">Eliminar Todas las Notificaciones</button>
    <?php else : ?>
        <p>No tienes notificaciones.</p>
    <?php endif; ?>
</div>

<?php 
    //include_once __DIR__ . '/actualizarPerfil.php';
?>

<style>
    body {
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    h1,
    h2 {
        text-align: center;
        color: #333;
    }

    .profile-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 40px;
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-photo {
        text-align: center;
    }

    .profile-photo img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .profile-info {
        max-width: 400px;
    }

    .profile-info p {
        margin: 10px 0;
    }

    button {
        padding: 10px 15px;
        margin-top: 10px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .notifications-container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .notification {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .notification p {
        margin: 0;
        flex-grow: 1;
    }
</style>

