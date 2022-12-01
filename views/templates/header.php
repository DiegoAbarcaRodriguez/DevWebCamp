<header class="header">
    <div class="header__contenedor">
        <div class="header__navegacion">
            <?php if (is_auth()) { ?>

                <a class="header__enlace" href= <?php echo is_admin()?'/admin/dashboard':'/finalizar-registro'?>>Administrar</a>

                <form action="/logout" method="POST" class="header__form">
                    <input type="submit" class="header__submit" value="Cerrar Sesión">
                </form>

            <?php } else { ?>
                <a class="header__enlace" href="/registro">Registro</a>
                <a class="header__enlace" href="/login">Iniciar Sesión</a>
            <?php } ?>
        </div>

        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">
                    &#60;DebWebCamp/>
                </h1>
            </a>

            <p class="header__texto">Octubre 5-6 - 2023</p>
            <p class="header__texto header__texto--modalidad">En Línea - Presencial</p>

            <a href="/registro" class="header__boton">Comprar Pase</a>
        </div>
    </div>
</header>
<div class="barra">
    <div class="barra__contenido">
        <a href="/">
            <h2 class="barra__logo">&#60;DebWebCamp/></h2>
        </a>
        <nav class="navegacion">
            <a href="/devwebcamp" class="navegacion__enlace  <?php echo pagina_actual('/devwebcamp') ? 'navegacion__enlace--actual' : '' ?>">Evento</a>
            <a href="/paquetes" class="navegacion__enlace <?php echo pagina_actual('/paquetes') ? 'navegacion__enlace--actual' : '' ?>"">Paquetes</a>
            <a href=" /workshops-conferencias" class="navegacion__enlace <?php echo pagina_actual('/workshops-conferencias') ? 'navegacion__enlace--actual' : '' ?>"">Workshops / Conferencias</a>
            <a href=" /registro" class="navegacion__enlace <?php echo pagina_actual('/registro') ? 'navegacion__enlace--actual' : '' ?>"">Comprar Pase</a>
        </nav>
    </div>
</div>