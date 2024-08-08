<?php
esReservador();
?>

<h1 class="titulo-categorias">Categorías de Servicios</h1>

<?php if (!empty($categorias)): ?>
    <div class="contenedor-categorias">
        <?php foreach ($categorias as $categoria): ?>
            <div class="categoria">
                <h2 class="nombre-categoria"><?php echo htmlspecialchars($categoria->nombre); ?></h2>
                <!-- Enlace para ver servicios de esta categoría -->
                <a href="/reservador/categoria?id_categoria=<?php echo $categoria->id; ?>">Ver Servicios</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>



