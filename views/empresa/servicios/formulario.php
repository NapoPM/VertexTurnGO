<div class="campo">
    <label for="nombreServicio">Nombre del Servicio:</label>
    <input 
        type="text" 
        class="control" 
        id="nombreServicio" 
        name="nombreServicio" 
        value="<?php echo htmlspecialchars($servicio->nombreServicio, ENT_QUOTES, 'UTF-8'); ?>" 
        required>

</div>
<div class="campo">
    <label for="imagenServicio">Agregue Imagen</label>
    <input 
        type="file" 
        class="control" 
        id="imagenServicio" 
        name="imagenServicio">
    

</div>
<div class="campo">
    <label for="categoria">Categoría del Servicio:</label>
    <select class="control" id="categoria" name="categoria" required>
        <option value="">Seleccionar categoría</option>
        <option value="Deporte" <?php if ($servicio->categoria === 'Deporte') echo 'selected'; ?>>Deporte</option>
        <option value="Estética" <?php if ($servicio->categoria === 'Estética') echo 'selected'; ?>>Estética</option>
        <option value="Salud" <?php if ($servicio->categoria === 'Salud') echo 'selected'; ?>>Salud</option>
        <!-- Agregar más opciones según sea necesario -->
    </select>
</div>
<div class="campo">
    <label for="precio">Precio del Servicio:</label>
    <input 
        type="number" 
        class="control" 
        id="precio" 
        name="precio" 
        value="<?php echo htmlspecialchars($servicio->precio, ENT_QUOTES, 'UTF-8'); ?>" 
        required>

</div>

<div class="campo">
    <label for="descripcion">Descripción del Servicio:</label>
    <textarea 
        class="control" 
        id="descripcion" 
        name="descripcion" 
        rows="3" required>
        <?php echo htmlspecialchars($servicio->descripcion, ENT_QUOTES, 'UTF-8'); ?>
    </textarea>
</div>
