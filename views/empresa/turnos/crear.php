<h2 class="nombe-pagina">Crear Horarios</h2>
<p class="descripcion-pagina">Llena todos los campos para agregar horario.</p>

<form class="formulario-carga" method="post" action="/empresa/turnos/crear">
    <div class="campo">
        <label for="servicio">Servicio:</label>
        <select id="servicio" name="turno[idServicio]">
            <?php foreach ($servicios as $servicio) : ?>
                <option value="<?php echo htmlspecialchars($servicio->id, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($servicio->nombreServicio, ENT_QUOTES, 'UTF-8'); ?> - $
                    <?php echo htmlspecialchars($servicio->precio, ENT_QUOTES, 'UTF-8'); ?>
                </option> 
            <?php endforeach; ?>
        </select>
    </div>
    <div class="campo">
        <label for="dias">Días:</label>
        <input type="checkbox" name="turno[dias][]" value="Lunes">Lunes
        <input type="checkbox" name="turno[dias][]" value="Martes">Martes
        <input type="checkbox" name="turno[dias][]" value="Miércoles">Miércoles
        <input type="checkbox" name="turno[dias][]" value="Jueves">Jueves
        <input type="checkbox" name="turno[dias][]" value="Viernes">Viernes
        <input type="checkbox" name="turno[dias][]" value="Sábado">Sábado
        <input type="checkbox" name="turno[dias][]" value="Domingo">Domingo
    </div>
    <div class="campo">
        <label for="horaInicio">Hora de inicio:</label>
        <input type="time" id="horaInicio" name="turno[horaInicio]">
    </div>
    <div class="campo">
        <label for="horaFin">Hora de fin:</label>
        <input type="time" id="horaFin" name="turno[horaFin]">
    </div>
    <div class="campo">
        <label for="frecuenciaMinutos">Frecuencia (minutos):</label>
        <select id="frecuenciaMinutos" name="turno[frecuenciaMinutos]">
            <option value="10">10 minutos</option>
            <option value="20">20 minutos</option>
            <option value="30">30 minutos</option>
        </select>
    </div>
        
</form>

<button type="submit">Guardar turno</button>