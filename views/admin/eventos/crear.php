<h2 class="dashboard__heading"> <?php echo $titulo; ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton " href="/admin/eventos">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
    <?php
    include_once __DIR__ . '/../../templates/alerta.php';
    ?>

    <form method="POST" class="formulario">

        <?php include_once __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Registrar Evento" class="formulario__submit--registrar">
    </form>
</div>