<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TurnGo | <?php echo $titulo ?? '' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

<?php  include __DIR__ . '/templates/header.php'?>
<?php echo $contenido; ?>
<?php include __DIR__ . '/templates/footer.php' ?>

</body>
</html>