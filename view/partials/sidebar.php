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

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#solicitudes" aria-expanded="false" aria-controls="solicitudes"
                title="Realiza la solicitud que desees">
                <img src="img/solicitudes.png" style="width: 30px;" alt="" title="Realiza la solicitud que desees">
                <span class="gradient-text">Solicitudes</span>
            </a>
            <ul id="solicitudes" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item">
                    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getSolicitud'); ?>"
                        class="sidebar-link gradient-text" title="Realiza solicitudes">
                        <img src="img/realizar.png" style="width: 25px; margin-right: 15px; margin-left: 7px;" alt="" title="Realiza la solicitud que desees">
                        Hacer una solicitud
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getSolicitudConsult'); ?>"
                        class="sidebar-link gradient-text" title="Mira tus solicitudes">
                        <img src="img/consulta.png" style="width: 25px;  margin-right: 15px; margin-left: 7px;" alt="" title="Realiza la solicitud que desees">
                        Consultar solicitudes
                    </a>
                </li>
            </ul>
        </li>

        <!-- <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#reductores" aria-expanded="false" aria-controls="reductores" title="Reductores">
                    <img src="img/reductores.png" style="width: 30px;" alt="">
                    <span class="gradient-text">Reductores</span>
                </a>
                <ul id="reductores" class="sidebar-dropdown list-unstyled collapse">
                    <li class="sidebar-item">
                        <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getReductoresNuevo'); ?>"
                            class="sidebar-link gradient-text" title="Nuevo">Nuevo</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getReductoresDaño'); ?>"
                            class="sidebar-link gradient-text" title="Reparacion">Reparación</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'getVias'); ?>" class="sidebar-link">
                    <img src="img/carretera.png" style="width: 30px;" alt="" title="Reportar daño en la via">
                    <span class="gradient-text">Reportar daño en la via</span>
                </a>
            </li> -->
        <h4 class="text-section d-none" id="rep">REPORTES</h4>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#reportes"
                aria-expanded="false" aria-controls="reportes">
                <img src="img/estadistica.png" style="width: 30px;" alt="" title="Ver reportes">
                <span class="gradient-text">Ver reportes</span>
            </a>
            <ul id="reportes" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item">
                    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'acConsult'); ?>" class="sidebar-link gradient-text" title="Reporte de accidentes">Accidentes</a>
                </li>
                <li class="sidebar-item">
                    <a href="" class="sidebar-link gradient-text" title="Reporte de señales">Señales</a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'viaConsult'); ?>" class="sidebar-link gradient-text" title="Reporte de vias">Via</a>
                </li>
                <li class="sidebar-item">
                    <a href="" class="sidebar-link gradient-text" title="Reporte de reductores">Reductores</a>
                </li>
            </ul>
        </li>
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
                        class="sidebar-link gradient-text" title="Registrar usuarios">Registrar usuarios</a>
                </li>
                <li class="sidebar-item">
                    <a href="<?php echo getUrl('Usuarios', 'Usuarios', 'getUsuarios'); ?>"
                        class="sidebar-link gradient-text " title="Consultar usuarios">Consultar usuarios</a>
                </li>
            </ul>
        </li>

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