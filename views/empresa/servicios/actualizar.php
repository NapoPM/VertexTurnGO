<h2>Actualizar Servicio</h2>
<p class="descripcion-pagina">Modifica los valores del formulario.</p>

<form method="POST" action="/empresa/servicios/actualizar?id=<?php echo htmlspecialchars($servicio->id, ENT_QUOTES, 'UTF-8'); ?>" class="formulario-carga">
    <div class="contenido">
                
        <?php
            include_once __DIR__ . '/formulario.php';
        ?>
            
    </div>
<input type="submit" class="boton" value="Actualizar Servicio">
</form>