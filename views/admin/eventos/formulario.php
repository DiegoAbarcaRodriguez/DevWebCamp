<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Evento</legend>


    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre Evento</label>
        <input type="text" id="nombre" name="nombre" class="formulario__input" placeholder="Nombre Evento" value="<?php echo $evento->nombre ?? '' ?>">
    </div>

    <div class="formulario__campo">
        <label for="descripcion" class="formulario__label">Descripción</label>
        <textarea rows="8" id="descripcion" name="descripcion" class="formulario__input" placeholder="Descripción Evento" value="<?php echo $evento->descripcion ?? '' ?>"></textarea>
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Categoría o Tipo de Evento</label>
        <select class="formulario__select" name="categoria_id" id="categoria">
            <option value="" selected disabled>- Seleccionar -</option>
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->id ?>" <?php echo $evento->categoria_id == $categoria->id ? 'selected' : '' ?>><?php echo $categoria->nombre ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="formulario__campo">
        <label for="categoria" class="formulario__label">Selecciona el Día</label>
        <div class="formulario__dias">
            <?php foreach($dias as $dia){?>
                <div>
                    <label for="<?php echo strtolower($dia->nombre) ?>"><?php echo $dia->nombre?></label>
                    <input type="radio" name="dia" id="<?php echo strtolower($dia->nombre)?>" value="<?php echo $dia->id?>" <?php echo $evento->dia_id===$dia->id?'checked':''; ?>>
                </div>
            <?php } ?>
        </div>

        <input type="hidden" name="dia_id" value="<?php echo $evento->dia_id;?>">
    </div>

    <div class="formulario__campo" >
        <label class="formulario__label">Seleccionar Hora</label>
        <ul id="horas" class="horas">
            <?php foreach($horas as $hora){?>
                <li data-hora-id="<?php echo $hora->id?>" class="horas__hora horas__hora--deshabilitada">
                    <?php echo $hora->hora?>
                </li>
            <?php }?>
        </ul>
        <input type="hidden" name="hora_id" value="<?php echo $evento->hora_id?>">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Extra</legend>

    <div class="formulario__campo">
        <label for="ponentes" class="formulario__label">Ponente</label>
        <input type="text" id="ponentes"  class="formulario__input" placeholder="Buscar Ponente" >

        <ul class="listado-ponentes" id="listado-ponentes"></ul>

        <input type="hidden" name="ponente_id" value="<?php echo $evento->ponente_id?>">
    </div>

    <div class="formulario__campo">
        <label for="disponibles" class="formulario__label">Lugares Disponibles</label>
        <input type="number" type="number" id="disponibles" name="disponibles" class="formulario__input" placeholder="Ej. 20" value="<?php echo $evento->disponibles?>">
    </div>
</fieldset>