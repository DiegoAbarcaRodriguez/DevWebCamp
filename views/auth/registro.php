<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate a DevWebcamp</p>

    <?php  include_once __DIR__.'/../templates/alerta.php'; ?>

    

    <form method="POST" class="formulario">

        <div class="formulario__campo">
            <label for="nombre" class="fomulario__label">Nombre</label>
            <input class="formulario__input" type="text" name="nombre" id="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre?>">
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="fomulario__label">Apellido</label>
            <input class="formulario__input" type="text" name="apellido" id="apellido" placeholder="Tu Apellido" value="<?php echo $usuario->apellido?>">
        </div>

        <div class="formulario__campo">
            <label for="email" class="fomulario__label">Email</label>
            <input class="formulario__input" type="text" name="email" id="email" placeholder="Tu Email" value="<?php echo $usuario->email?>">
        </div>

        <div class="formulario__campo">
            <label for="password" class="fomulario__label">Password</label>
            <input class="formulario__input" type="password" name="password" id="password" placeholder="Tu Password">
        </div>

        <div class="formulario__campo">
            <label for="password2" class="fomulario__label">Password</label>
            <input class="formulario__input" type="password" name="password2" id="password2" placeholder="Repetir Password">
        </div>

        <input type="submit" value="Crear Cuenta" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Password?</a>
    </div>
</main>