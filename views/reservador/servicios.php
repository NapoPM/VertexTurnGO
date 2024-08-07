<?php
esReservador();
?>

<h1>Servicios de la Categoría <?php echo htmlspecialchars($categoria->nombre); ?></h1>

<?php if (!empty($servicios)): ?>
    <div class="card-container">
        <?php foreach ($servicios as $servicio): ?>
            <div class="card">
                <h2><?php echo htmlspecialchars($servicio->nombreServicio); ?></h2>
                <p><?php echo htmlspecialchars($servicio->descripcion); ?></p>
                <p>Precio: <?php echo htmlspecialchars($servicio->precio); ?></p>
                <p>Empresa: <?php echo htmlspecialchars($servicio->nombreEmpresa); ?></p>
                <!-- Mostrar imagen del servicio si existe -->
                <?php if ($servicio->imagenServicio): ?>
                    <img src="/path/to/images/<?php echo htmlspecialchars($servicio->imagenServicio); ?>" alt="<?php echo htmlspecialchars($servicio->nombreServicio); ?>">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>




<style>
.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: calc(33.333% - 40px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card img {
    max-width: 100%;
    border-radius: 4px;
}

.card h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.card p {
    margin-bottom: 10px;
}
</style>
