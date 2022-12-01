<h2 class="registro__heading"><?php echo $titulo; ?></h2>
<p class="registro__descripcion">Elige un Plan</p>


<div class="eventos-registro">
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&lt;Conferencias /></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach ($eventos['conferencias_v'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

        <p class="eventos-registro__fecha">Sàbado 6 de Octubre</p>

        <div class="eventos-registro__grid">
            <?php foreach ($eventos['conferencias_s'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

        <h3 class="eventos-registro__heading--workshops">&lt;Workshops /></h3>
        <p class="eventos-registro__fecha">Viernes 5 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach ($eventos['workshops_v'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

        <p class="eventos-registro__fecha">Sàbado 6 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops">
            <?php foreach ($eventos['workshops_s'] as $evento) { ?>
                <?php include __DIR__ . '/evento.php'; ?>
            <?php } ?>
        </div>

    </main>

    <aside class="registro">
        <h2 class="registro__heading">Tu Registro</h2>

        <div id="registro-resumen" class="registro-resumen"></div>

        <div class="registro__regalos">
            <label for="regalo" class="registro__label">Seleccione un regalo</label>
            <select id="regalo" class="registro__select">
                <option value="">--Selecciona tu regalo--</option>
                <?php foreach ($regalos as $regalo) { ?>
                    <option value="<?php echo $regalo->id ?>"><?php echo $regalo->nombre ?></option>
                <?php } ?>
            </select>
        </div>

        <form class="formulario" id="registro">
            <div class="fomulario__campo">
                <input type="submit" class="formulario__submit formulario__submit--full" value="Registrarme">
            </div>
        </form>
    </aside>
</div>