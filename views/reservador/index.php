<?php
esReservador();
?>

<h1>Categorías de Servicios</h1>

<?php if (!empty($categorias)): ?>
    <div class="card-container">
        <?php foreach ($categorias as $categoria): ?>
            <div class="card">
                <h2><?php echo htmlspecialchars($categoria->nombre); ?></h2>
                <!-- Enlace para ver servicios de esta categoría -->
                <a href="/reservador/categoria?id_categoria=<?php echo $categoria->id; ?>">Ver Servicios</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>




<style>
body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center; /* Centra horizontalmente */
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 200px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-10px);
}

.card a {
    text-decoration: none;
    color: #333;
    font-size: 1.2em;
}

.card a:hover {
    color: #007BFF;
}
</style>
