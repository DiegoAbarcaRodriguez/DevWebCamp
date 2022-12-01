<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu acceso a DevWebcamp</p>

    <?php  include_once __DIR__.'/../templates/alerta.php'; ?>

    <form method="POST" class="formulario">

        <div class="formulario__campo">
            <label for="email" class="fomulario__label">Email</label>
            <input class="formulario__input" type="text" name="email" id="email" placeholder="Tu Email">
        </div>


        <input type="submit" value="Enviar Instrucciones" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesión</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtener una</a>
    </div>
</main>