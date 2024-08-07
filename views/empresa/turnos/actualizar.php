<h2 class="nombre-pagina">Actualizar Horario</h2>
<p class="descripcion-pagina">Modifica los campos para actualizar el horario.</p>

<form method="post" action="/empresa/turnos/actualizar?idServicio=<?php echo htmlspecialchars($turno->idServicio, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="form-group">
        <label for="servicio">Servicio:</label>
        <select class="form-control" id="servicio" name="turno[idServicio]" required>
            <?php foreach ($servicios as $servicio) : ?>
                <option value="<?php echo htmlspecialchars($servicio->id, ENT_QUOTES, 'UTF-8'); ?>"
                    <?php if ($turno->idServicio == $servicio->id) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($servicio->nombreServicio, ENT_QUOTES, 'UTF-8'); ?> - $
                    <?php echo htmlspecialchars($servicio->precio, ENT_QUOTES, 'UTF-8'); ?>
                </option> 
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="dias">Días:</label>
        <div>
            <?php
            $diasSeleccionados = explode(',', $turno->dias); // Supongamos que los días se almacenan como una cadena separada por comas
            ?>
            <input type="checkbox" id="lunes" name="turno[dias][]" value="Lunes"
                <?php if (in_array('Lunes', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="lunes">Lunes</label>

            <input type="checkbox" id="martes" name="turno[dias][]" value="Martes"
                <?php if (in_array('Martes', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="martes">Martes</label>

            <input type="checkbox" id="miercoles" name="turno[dias][]" value="Miércoles"
                <?php if (in_array('Miércoles', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="miercoles">Miércoles</label>

            <input type="checkbox" id="jueves" name="turno[dias][]" value="Jueves"
                <?php if (in_array('Jueves', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="jueves">Jueves</label>

            <input type="checkbox" id="viernes" name="turno[dias][]" value="Viernes"
                <?php if (in_array('Viernes', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="viernes">Viernes</label>

            <input type="checkbox" id="sabado" name="turno[dias][]" value="Sábado"
                <?php if (in_array('Sábado', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="sabado">Sábado</label>

            <input type="checkbox" id="domingo" name="turno[dias][]" value="Domingo"
                <?php if (in_array('Domingo', $diasSeleccionados)) echo 'checked'; ?>>
            <label for="domingo">Domingo</label>
        </div>
    </div>

    <div class="form-group">
        <label for="horaInicio">Hora de inicio:</label>
        <input type="time" class="form-control" id="horaInicio" name="turno[horaInicio]" value="<?php echo htmlspecialchars($turno->horaInicio, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="horaFin">Hora de fin:</label>
        <input type="time" class="form-control" id="horaFin" name="turno[horaFin]" value="<?php echo htmlspecialchars($turno->horaFin, ENT_QUOTES, 'UTF-8'); ?>" required>
    </div>

    <div class="form-group">
        <label for="frecuenciaMinutos">Frecuencia (minutos):</label>
        <select class="form-control" id="frecuenciaMinutos" name="turno[frecuenciaMinutos]" required>
            <option value="10" <?php if ($turno->frecuenciaMinutos == 10) echo 'selected'; ?>>10 minutos</option>
            <option value="20" <?php if ($turno->frecuenciaMinutos == 20) echo 'selected'; ?>>20 minutos</option>
            <option value="30" <?php if ($turno->frecuenciaMinutos == 30) echo 'selected'; ?>>30 minutos</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>
<br>
<a href="../index" class="btn btn-primary">No quiero generar cambios aquí.</a>
<br>
<br>