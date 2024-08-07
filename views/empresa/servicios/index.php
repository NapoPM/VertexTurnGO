<h2 class="nombe-pagina">Servicios</h2>
<p class="descripcion-pagina">Administración de Servicios.</p>

<?php if (!empty($alertas)): ?>
        <?php foreach ($alertas as $alerta): ?>
            <div class="alerta <?php echo $alerta['tipo']; ?>"><?php echo $alerta['mensaje']; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <ul class="servicios">
        <?php if (!empty($servicios)): ?>
            <?php foreach ($servicios as $servicio): ?>
                <li>
                    <p>Nombre: <span><?php echo htmlspecialchars($servicio->nombreServicio, ENT_QUOTES, 'UTF-8'); ?></span></p>
                    <p>Precio: <span>$</span> <span><?php echo htmlspecialchars($servicio->precio, ENT_QUOTES, 'UTF-8'); ?></span></p>
                    <div class="acciones">
                        <a class="boton" href="/empresa/servicios/actualizar?id=<?php echo htmlspecialchars($servicio->id, ENT_QUOTES, 'UTF-8'); ?>">Editar</a>
                        <form action="/servicios/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="submit" value="Eliminar" class="boton-eliminar">
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay servicios para mostrar</p>
        <?php endif; ?>
</ul>