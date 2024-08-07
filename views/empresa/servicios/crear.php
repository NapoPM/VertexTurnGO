<h2 class="nombe-pagina">Crear Servicio</h2>
<p class="descripcion-pagina">Llena todos los campos para agregar un servicio.</p>

<?php

?>

<form method="POST" action="/empresa/servicios/crear" class="formulario">
<?php
include_once __DIR__ . '/formulario.php';
?>
<input type="submit" class="boton" value="Guardar Servicio">
</form>

