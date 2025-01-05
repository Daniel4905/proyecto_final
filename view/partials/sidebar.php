<div id="sidebar" data-background-color="dark">
    <div class="d-flex">
        <button class="toggle-btn" style="margin-top: 5px;" type="button">
            <img src="img/grid.png" style="width: 30px;" alt="">
        </button>
        <div class="sidebar-logo" style="margin-top: 10px;">
            <a href="index.php"><img src="img/logo_claro.png" alt="" style="width: 120px;">
            </a>
        </div>

    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item ml-4">
            <a href="index.php" class="sidebar-link" title="Inicio">
                <img src="img/hogar.png" style="width: 30px;" alt="Inicio">
                <span class="ml-3 gradient-text">Inicio</span>
            </a>
        </li>

        <li class="sidebar-item ml-4">
            <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getSolicitudConsult'); ?>"
                class="sidebar-link" title="Mira tus solicitudes">
                <img src="img/consulta.png" alt=""  style="width: 30px;"
                    title="Consulta las solicitudes">
                    <span class="gradient-text">Consultar solicitudes</span>
            </a>
        </li>
        <?php
        if ($_SESSION['rol'] == 1) {
            ?>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#gestionUsuarios" aria-expanded="false" aria-controls="gestionUsuarios"
                    title="Gestion de usuarios">
                    <img src="img/gestion-usu.png" style="width: 30px;" alt="">
                    <span class="gradient-text">Gestión de usuarios</span>
                </a>
                <ul id="gestionUsuarios" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item">
                        <a href="<?php echo getUrl('Usuarios', 'Usuarios', 'getCreate'); ?>"
                            class="sidebar-link gradient-text" title="Registrar usuarios"><img src="img/nuevo-usuario.png" alt="" style="width: 25px;  margin-right: 15px; margin-left: 7px;">Registrar usuarios</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?php echo getUrl('Usuarios', 'Usuarios', 'getUsuarios'); ?>"
                            class="sidebar-link gradient-text " title="Consultar usuarios"><img src="img/buscarUsu.png" alt="" style="width: 25px;  margin-right: 15px; margin-left: 7px;">Consultar usuarios</a>
                    </li>
                </ul>
            </li>
        <?php
        }
        ?>
    </ul>
    <li class="sidebar-footer">
        <a href="<?php echo getUrl('Acceso', 'Acceso', 'logout'); ?>"
            onclick="return confirm('¿Estás seguro de que deseas cerrar sesión?');" class="sidebar-link"
            title="Cerrar sesión">
            <img src="img/cerrarS.png" style="width: 30px;" alt="">
            <span class="cerrarS">Cerrar sesion</span>
        </a>
    </li>


</div>