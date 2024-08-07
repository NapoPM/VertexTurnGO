<div class="contenedor-carga">

    <h2 class="nombe-pagina">Crear Servicio</h2>
    <p class="descripcion-pagina">Llena todos los campos para agregar un servicio.</p>

    <?php

    ?>

    <form action="/empresa/servicios/crear" method="POST" class="formulario-carga">
        <div class="contenido">
            <?php
                include_once __DIR__ . '/formulario.php';
            ?>


            
        </div>
        <input type="submit" class="btn" value="Guardar Servicio">
    </form>

</div>