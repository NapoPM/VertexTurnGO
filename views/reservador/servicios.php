<?php
esReservador();
?>

<h1>Servicios de la Categoría <?php echo htmlspecialchars($categoria->nombre); ?></h1>

<?php if (!empty($servicios)): ?>
    <div class="card-container">
        <?php foreach ($servicios as $servicio): ?>
            <div class="card">
                <h2><?php echo htmlspecialchars($servicio->nombreServicio); ?></h2>
                <p><?php echo htmlspecialchars($servicio->descripcion); ?></p>
                <p>Precio: <?php echo htmlspecialchars($servicio->precio); ?></p>
                <p>Empresa: <?php echo htmlspecialchars($servicio->nombreEmpresa); ?></p>
                <!-- Mostrar imagen del servicio si existe -->
                <?php if ($servicio->imagenServicio): ?>
                    <img src="/path/to/images/<?php echo htmlspecialchars($servicio->imagenServicio); ?>" alt="<?php echo htmlspecialchars($servicio->nombreServicio); ?>">
                <?php endif; ?>

                <!-- Botón para sacar un turno -->
                <button class="boton" onclick="mostrarModal(<?php echo $servicio->id; ?>)">Sacar Turno</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal para sacar turno -->
    <div id="modal-turno" class="modal" style="display: none;">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal()">&times;</span>
            <h2>Sacar Turno para el Servicio</h2>
            <form id="form-turno" method="POST" action="/reservador/sacar-turno">
                <input type="hidden" name="servicio_id" id="servicio-id">
                <input type="hidden" name="id_categoria" value="<?php echo htmlspecialchars($categoria->id); ?>">
                <!-- Agregar otros campos necesarios para el turno -->
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" required>

                <input type="submit" value="Confirmar Turno" class="boton">
            </form>
        </div>
    </div>

    <style>
        .modal {
            display: block;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-contenido {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
        }

        .cerrar {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .cerrar:hover,
        .cerrar:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <script>
        function mostrarModal(servicioId) {
            // Establecer el ID del servicio en el formulario
            document.getElementById('servicio-id').value = servicioId;
            document.getElementById('modal-turno').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modal-turno').style.display = 'none';
        }

        // Cerrar el modal si el usuario hace clic fuera de él
        window.onclick = function(event) {
            var modal = document.getElementById('modal-turno');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
<?php else: ?>
    <p>No hay servicios disponibles en esta categoría.</p>
<?php endif; ?>




<style>
.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: calc(33.333% - 40px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card img {
    max-width: 100%;
    border-radius: 4px;
}

.card h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.card p {
    margin-bottom: 10px;
}
</style>
