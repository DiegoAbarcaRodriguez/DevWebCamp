<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia Sesión DevWebcamp</p>

    
    <?php  include_once __DIR__.'/../templates/alerta.php'; ?>

    <form method="POST" class="formulario">

        <div class="formulario__campo">
            <label for="email" class="fomulario__label">Email</label>
            <input class="formulario__input" type="text" name="email" id="email" placeholder="Tu Email">
        </div>

        <div class="formulario__campo">
            <label for="password" class="fomulario__label">Password</label>
            <input class="formulario__input" type="password" name="password" id="password" placeholder="Tu Password">
        </div>

        <input type="submit" value="Iniciar Sesión" class="formulario__submit">

    </form>

    <div class="acciones">
        <a href="/registro" class="acciones__enlace">¿Aún no tienes una cuenta? Obtener una</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Password?</a>
    </div>
</main>