<?php

include_once "../lib/helpers.php";


include_once "../view/partials/head.php";


include_once "../view/partials/footer.php";

?>
<style>
    .navbar-nav .nav-link.fw-bold {
        color: black !important;
    }
</style>
<div class='wrapper'>
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" style="margin-top: 30px;" type="button">
                <img src="img/grid.png" style="width: 30px; margin-top: 30px;" alt="">
            </button>
            <div class="sidebar-logo" style="margin-top: 60px;">
                <a href="index.php"><img src="img/logo_claro.png" alt="" style="width: 120px;">
                </a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <div class="dropdown-divider"></div>
            <li class="sidebar-item ml-4">
                <a href="index.php" class="sidebar-link">
                    <img src="img/hogar.png" style="width: 30px;" alt="">
                    <span class="ml-3 gradient-text">Inicio</span>
                </a>
            </li>
        </ul>
    </aside>
    <div class='container'>

        <div class="mt-5">
            <h3 class="display-4">Registro</h3>
        </div>
        <form action="<?php echo getUrl("Usuarios", "Usuarios", "postCreate"); ?> " method="post" id="formRegistrolog">
            <div class="row mt-5">
                <div class='alert alert-danger d-none' role='alert' id="error">

                </div>
                <?php
                if (isset($_SESSION['errores'])) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    foreach ($_SESSION['errores'] as $error) {
                        echo $error . "<br>";
                    }
                    echo "</div>";
                    unset($_SESSION['errores']);
                }

                ?>

                <div class="col-md-6">
                    <label for="usu_nombre1">Primer nombre</label>
                    <input type="text" name="usu_nombre1" id="nombre1" class="form-control validar-nombre"
                        placeholder="Primer nombre">
                </div>
                <div class="col-md-6">
                    <label for="usu_nombre2">Segundo nombre (Si tiene)</label>
                    <input type="text" name="usu_nombre2" id="nombre2" class="form-control validar-nombre"
                        placeholder="Segundo nombre">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="usu_apellido1">Primer Apellido</label>
                    <input type="text" name="usu_apellido1" id="apellido1" class="form-control validar-nombre"
                        placeholder="Primer apellido">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="usu_apellido2"> Segundo Apellido (Opcional)</label>
                    <input type="text" name="usu_apellido2" id="apellido2" class="form-control validar-nombre"
                        placeholder="Segundo apellido">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="doc_id">Tipo de documento</label>
                    <select name="doc_id" id="doc" class="form-control">
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($docs as $doc) {
                            echo "<option value ='" . $doc['doc_id'] . "'>" . $doc['nombre_tipo'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_tel">Documento</label>
                    <input type="text" name="usu_documento" id="documento" class="form-control validar-num"
                        placeholder="Documento">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_tel">Telefono</label>
                    <input type="text" name="usu_tel" id="telefono" class="form-control validar-num"
                        placeholder="Telefono">
                </div>


                <div class="row">
                    <div class="col-md-3 mt-3">
                        <label for="tipoVia">Tipo de vía</label>
                        <select id="tipoVia" name="tipoVia" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="Calle">Calle</option>
                            <option value="Carrera">Carrera</option>
                            <option value="Avenida">Avenida</option>
                            <option value="Transversal">Transversal</option>
                            <option value="Diagonal">Diagonal</option>
                        </select>
                        <small class="form-text text-muted">Ejemplo: Calle</small>
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="numeroPrincipal">Número principal</label>
                        <input type="number" id="numeroPrincipal" name="numeroPrincipal" class="form-control"
                            placeholder="123" min="1" max="300" required>
                        <small class="form-text text-muted">Ejemplo: 23</small>
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="numeroSecundario">Número secundario</label>
                        <input type="number" id="numeroSecundario" name="numeroSecundario" class="form-control"
                            placeholder="10" min="1" max="300" required>
                        <small class="form-text text-muted">Ejemplo: 10</small>
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento" class="form-control"
                            placeholder="Bis/A/Sur">
                        <small class="form-text text-muted">Opcional. Ejemplo: Bis</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mt-3">
                        <label for="barrio">Barrio</label>
                        <select name="barrio" id="barrio" class="form-control" required>
                            <option value="">Seleccione...</option>
                        </select>
                        <small class="form-text text-muted">Seleccione el barrio donde se encuentra.</small>
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="codigoPostal">Código Postal</label>
                        <input type="text" id="codigoPostal" name="codigoPostal" class="form-control"
                            placeholder="760001">
                        <small class="form-text text-muted">Opcional. Ejemplo: 760001</small>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="referencias">Referencias adicionales</label>
                        <textarea id="referencias" name="referencias" class="form-control" rows="2" maxlength="100"
                            placeholder="Frente al parque o cerca del supermercado"></textarea>
                        <small class="form-text text-muted">Opcional. Máximo 100 caracteres.</small>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_correo">Correo</label>
                    <input type="text" name="usu_correo" id="correo" class="form-control"
                        placeholder="usuario@dominio.com">
                </div>

                <div class="col-md-4 mt-3">
                    <label for="usu_clave">Clave</label>
                    <input type="password" name="usu_clave" id="clave" class="form-control claves" placholder="Clave">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_clave">Confirmar clave</label>
                    <input type="password" name="usu_clavenew" id="clavenew" class="form-control claves"
                        placholder="Clave">
                </div>
                <div class="mt-4">
                    <span>Ya tienes cuenta? <a href="login.php">Inciar sesión</a></span>
                </div>
                <div class="mt-5">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
    </div>
