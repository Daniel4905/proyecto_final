<?php

include_once "../lib/helpers.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>AccidentEye</title>
    <link rel="icon" href="img/file.png" type="image/png">
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="stylesheet" href="assets/css/registrar.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://use.typekit.net/ksk3czv.css">
</head>

<body class="">


    <div class='wrapper'>
        <div id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" style="margin-top: 7px;" type="button">
                    <img src="img/grid.png" style="width: 30px; margin-top: 30px;" alt="">
                </button>
                <div class="sidebar-logo" style="margin-top: 30px;">
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
        </div>
        <div class='container-fluid'>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid p-4">
                    <a class="navbar-brand" href="index.php" id="navbar-logo"><img src="img/logo_normal.png"
                            id="logonav" alt="" style="width: 120px; ">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>

            <div class="container">
                <div class="mt-3">
                    <h3 class="display-4">Registrar Usuarios</h3>
                </div>
            </div>
            <div class="container container-scroll">

                <form action="<?php echo getUrl("Acceso", "Acceso", "postCreate", false, "ajax"); ?>" method="POST"
                    id="formRegistrolog">
                    <div class="row mt-5">
                        <div class='alert alert-danger d-none' role='alert' id="error"></div>

                        <?php
                        if (isset($_SESSION['ErrorReg'])) {
                            echo "<div class='alert alert-danger' role='alert'>";
                            foreach ($_SESSION['ErrorReg'] as $error) {
                                echo $error . "<br>";
                            }
                            echo "</div>";
                            unset($_SESSION['errores']);
                        }
                        ?>

                        <div class="col-md-3">
                            <label for="usu_nombre1">Primer nombre*</label>
                            <input type="text" name="usu_nombre1" id="nombre1" class="form-control validar-nombre"
                                placeholder="Primer nombre">
                        </div>
                        <div class="col-md-3">
                            <label for="usu_nombre2">Segundo nombre</label>
                            <input type="text" name="usu_nombre2" id="nombre2" class="form-control validar-nombre"
                                placeholder="Segundo nombre">
                            <small class="form-text text-muted">Opcional.</small>
                        </div>
                        <div class="col-md-3">
                            <label for="usu_apellido1">Primer Apellido*</label>
                            <input type="text" name="usu_apellido1" id="apellido1" class="form-control validar-nombre"
                                placeholder="Primer apellido">
                        </div>
                        <div class="col-md-3">
                            <label for="usu_apellido2" class="white-color">Segundo Apellido</label>
                            <input type="text" name="usu_apellido2" id="apellido2" class="form-control validar-nombre"
                                placeholder="Segundo apellido">
                            <small class="form-text text-muted">Opcional.</small>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="doc_id">Tipo de documento*</label>
                            <select name="doc_id" id="doc" class="form-control">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($docs as $doc) {
                                    echo "<option value='" . $doc['doc_id'] . "'>" . $doc['nombre_tipo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="usu_documento">Nro Documento*</label>
                            <input type="text" name="usu_documento" id="documento" class="form-control validar-num"
                                placeholder="Documento">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="usu_tel">Teléfono*</label>
                            <input type="text" name="usu_tel" id="telefono" class="form-control validar-num"
                                placeholder="Teléfono">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="sex_id">Sexo biologico*</label>
                            <select id="sexo" name="sex_id" class="form-control">
                                <option value="">Seleccione...</option>
                                <?php
                                foreach ($sexo as $sex) {
                                    echo "<option value ='" . $sex['sex_id'] . "'>" . $sex['sex_desc'] . "</option>";
                                }
                                ?>

                            </select>
                        </div>


                        <div class="col-md-3 mt-3">
                            <label for="tipoVia">Tipo de vía*</label>
                            <select id="tipoVia" name="tipoVia" class="form-control">
                                <option value="">Seleccione...</option>
                                <option value="Calle">Calle</option>
                                <option value="Carrera">Carrera</option>
                                <option value="Avenida">Avenida</option>
                                <option value="Transversal">Transversal</option>
                                <option value="Diagonal">Diagonal</option>
                            </select>
                            <small class="form-text text-muted">Ejemplo: Calle</small>
                        </div>
                        <div class="col-md-2 mt-3">
                            <label for="numeroPrincipal">Número principal*</label>
                            <input type="number" id="numeroPrincipal" name="numeroPrincipal" class="form-control"
                                placeholder="123" min="1" max="300">
                        </div>
                        <div class="col-md-1 mt-3">
                            <label for="complemento1">Complemento</label>
                            <input type="text" id="complemento1" name="complemento1" class="form-control"
                                placeholder="J" maxlength="3">
                            <small class="form-text text-muted">Opcional.</small>
                        </div>
                        <div class="col-md-1 mt-3">
                            <label for="numeroSecundario">Número 1</label>
                            <input type="number" id="numeroSecundario" name="numeroSecundario" class="form-control"
                                placeholder="" min="1" max="300" maxlength="3">
                        </div>
                        <div class="col-md-1 mt-3">
                            <label for="complemento2">Complemento</label>
                            <input type="text" id="complemento2" name="complemento2" class="form-control"
                                placeholder="Bis/A/Sur">
                            <small class="form-text text-muted">Opcional.</small>
                        </div>
                        <div class="col-md-1 mt-3">
                            <label for="numeroTerciario">Número 2</label>
                            <input type="number" id="numeroTerciario" name="numeroTerciario" class="form-control"
                                placeholder="" min="1" max="300" maxlength="3">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="referencias">Referencias adicionales</label>
                            <textarea id="referencias" name="referencias" class="form-control" rows="2" maxlength="100"
                                placeholder="Frente al parque o cerca del supermercado"></textarea>
                            <small class="form-text text-muted">Opcional. Máximo 100 caracteres.</small>
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="usu_correo">Correo*</label>
                            <input type="text" name="usu_correo" id="correo" class="form-control"
                                placeholder="usuario@dominio.com">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="usu_clave">Clave*</label>
                            <input type="password" name="usu_clave" id="clave" class="form-control claves"
                                placeholder="Clave">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="usu_clavenew">Confirmar clave*</label>
                            <input type="password" name="usu_clavenew" id="clavenew" class="form-control claves"
                                placeholder="Confirmar clave">
                        </div>
                        <div class="mt-3">
                            <input type="submit" value="Enviar" class="btn btn-success">
                        </div>
                    </div>


            </div>
            <div class="container">
                <div class=" my-3">
                    <span>¿Ya tienes cuenta? <a href="index.php">Iniciar sesión</a></span>
                </div>
            </div>
            </form>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/script.js"></script>



</html>