
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" id="navbar-logo"><img src="img/logo_normal.png"   id="logonav"  alt=""
        style="width: 120px; ">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      

      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['nombre'])) { ?>
          <li class="nav-item topbar-user dropdown hidden-caret">
            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
              <div class="avatar-sm">
                <?php
                if ($_SESSION['sexo'] == 1) {
                  echo '<img src="img/hombre.png" alt="..." class="avatar-img rounded-circle" />';
                } else if($_SESSION['sexo'] == 2) {
                  echo '<img src="img/mujer.png" alt="..." class="avatar-img rounded-circle" />';
                }
                ?>
              </div>
              <span class="profile-username">
                <span class="op-7">Hola,</span>
                <span class="fw-bold"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></span>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
              <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                  <div class="user-box">
                    <div class="avatar-lg">
                      <img src="img/descarga.png" alt="image profile" class="avatar-img rounded" />
                    </div>
                    <div class="u-text">
                      <h4><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></h4>
                      <p class="text-muted"><?php echo $_SESSION['correo']; ?></p>
                      <a href="<?php echo getUrl('Usuarios', 'Usuarios', 'viewProfile', array("usu_id" => $_SESSION['id'])); ?>"
                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"
                    href="<?php echo getUrl('Usuarios', 'Usuarios', 'viewProfile', array("usu_id" => $_SESSION['id'])); ?>">Mi
                    perfil</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"
                    href="<?php echo getUrl('Usuarios', 'Usuarios', 'getUpdateUsu', array("usu_id" => $_SESSION['id'])); ?>">Configuracion
                    de la cuenta</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="<?php echo getUrl('Acceso', 'Acceso', 'logout'); ?>"
                    onclick="return confirm('¿Estás seguro de que deseas cerrar sesión?');">Cerrar sesion</a>
                </li>
              </div>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>