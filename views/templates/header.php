<header class="header">
    <div class="menu-logo">
        <div class="prueba">
            <a href="/" class="img-logo"></a>
        </div>
        
        
        <a class="header_icon" href="./" id="header_icon">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    
    <ul class="menu empresa">
        <?php if(isset($_SESSION['login']) && $_SESSION['login']): ?>
            <?php if($_SESSION['TipoUsuario'] === 'Empresa'): ?>
                <!-- Menu para usuarios logueados tipo Empresa -->
                <li><a href="/empresa/index">Dashboard Empresa</a></li>
                <li><a href="/empresa/servicios/index">Mis Servicios</a></li>
                <li><a href="/empresa/servicios/crear">Cargar Servicios</a></li>
                <li><a href="/empresa/turnos/turnos">Turnos</a></li>
                <li><a href="/perfil">Mi Perfil</a></li>
                <li><a href="/logout">Cerrar Sesión</a></li>

            <?php elseif($_SESSION['TipoUsuario'] === 'Reservador'): ?>
                <!-- Menu para usuarios logueados tipo Reservador -->
                <li><a href="/reservador/index">Dashboard Reservador</a></li>
                <li><a href="/reservador/perfil">Mi Perfil</a></li>
                <li><a href="/logout">Cerrar Sesión</a></li>
            <?php endif; ?>
        <?php else: ?>
            <!-- Menu para usuarios no logueados -->
            <li><a href="/#simulador">Simular Plan</a></li>
            <li><a href="/crear-cuenta">Empresa</a></li>
            <li><a href="/crear-cuentaRES">Reservador</a></li>
            <li><a href="/login">Iniciar Sesion</a></li>
            <li><a href="/#contacto">Contacto</a></li>
        <?php endif; ?>
    </ul>
</header>