<div class="form-group">
    <label for="nombreServicio">Nombre del Servicio:</label>
    <input type="text" class="form-control" id="nombreServicio" name="nombreServicio" value="<?php echo htmlspecialchars($servicio->nombreServicio, ENT_QUOTES, 'UTF-8'); ?>" required>
</div>
<div class="form-group">
    <label for="imagenServicio">Agregue Imagen</label>
    <input type="file" class="form-control" id="imagenServicio" name="imagenServicio">
</div>
<div class="form-group">
    <label for="categoria">Categoría</label>
    <select class="form-control" id="categoria" name="id_categoria">
    <option value="">Seleccionar categoría</option>
    <?php if (!empty($categorias)): ?>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?php echo htmlspecialchars($categoria->id); ?>" <?php if ($servicio->id_categoria == $categoria->id) echo 'selected'; ?>>
                <?php echo htmlspecialchars($categoria->nombre); ?>
            </option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">No hay categorías disponibles</option>
    <?php endif; ?>
</select>
</div>
<div class="form-group">
    <label for="descripcion">Descripción del Servicio:</label>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo htmlspecialchars($servicio->descripcion, ENT_QUOTES, 'UTF-8'); ?></textarea>
</div>
<div class="form-group">
    <label for="precio">Precio del Servicio:</label>
    <input type="number" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($servicio->precio, ENT_QUOTES, 'UTF-8'); ?>">
</div>