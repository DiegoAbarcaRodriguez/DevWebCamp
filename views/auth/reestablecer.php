<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Coloca tu Nuevo Password</p>

    <?php  include_once __DIR__.'/../templates/alerta.php'; ?>

    <?php if($token_valido){?>
    <form method="POST" class="formulario">

        <div class="formulario__campo">
            <label for="password" class="fomulario__label">Nuevo Password</label>
            <input class="formulario__input" type="password" name="password" id="password" placeholder="Tu Nuevo Password">
        </div>


        <input type="submit" value="Guardar Password" class="formulario__submit">

    </form>
    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtener una</a>
    </div>
</main>