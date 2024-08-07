<?php
    foreach ($alertas as $alerta):
        foreach ($alerta as $mensaje):
?>
    <div class="alerta <?php echo $alerta; ?>">
    <?php echo $mensaje; ?>
    </div>
<?php
        endforeach;
    endforeach;
?>