<?php
esReservador();
?>

<h1 class="titulo-categorias">Servicios de la Categoría <?php echo htmlspecialchars($categoria->nombre); ?></h1>

<?php if (!empty($servicios)): ?>
    <div class="contenedor-servicios">
        <?php foreach ($servicios as $servicio): ?>
            <div class="servicio">
                <div class="servicio-imagen">
                    <?php if ($servicio->imagenServicio): ?>
                        <img class="img-servicio" src="/path/to/images/<?php echo htmlspecialchars($servicio->imagenServicio); ?>" alt="<?php echo htmlspecialchars($servicio->nombreServicio); ?>">
                    <?php endif; ?>
                </div>
                <div class="servicio-detalles">
                    <p class="nombre-empresa">Empresa: <?php echo htmlspecialchars($servicio->nombreEmpresa); ?></p>
                    <h2 class="nombrecategoria"><?php echo htmlspecialchars($servicio->nombreServicio); ?></h2>
                    <p class="descripcion-categoria"><?php echo htmlspecialchars($servicio->descripcion); ?></p>
                    <p class="precio">Precio: $<?php echo htmlspecialchars($servicio->precio); ?></p>
                    <button class="btn-categoria" onclick="mostrarModal(<?php echo $servicio->id; ?>)">Sacar Turno</button>
                </div>
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

                <input type="submit" value="Confirmar Turno" class="btn-categoria">
            </form>
        </div>
    </div>
<?php endif; ?>



<!-- 
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
    </script> -->




