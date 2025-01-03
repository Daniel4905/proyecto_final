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
    <div class='container-fluid'>
        <div class="container" id="cajita2">
            <div class="mt-3 p-4" id="tituloM">
                <img src="img/logo_claro.png" id="logonav" alt="" width="300px">
            </div>
            <div class="container-scroll">
                <form action="<?php echo getUrl("Acceso", "Acceso", "postCreate", false, "ajax"); ?>" method="POST"
                    id="formRegistrolog">

                    <div class="row mt-3">
                        <div class='alert alert-danger d-none' role='alert' id="error"></div>

                        <?php
                        if (isset($_SESSION['ErrorReg'])) {
                            echo "<div class='alert alert-danger' role='alert'>";
                            foreach ($_SESSION['ErrorReg'] as $error) {
                                echo $error . "<br>";
                            }
                            echo "</div>";
                            unset($_SESSION['ErrorReg']);
                        }
                        ?>
                        <div class="col-md-6 p-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="titulos">Nombres</h2>
                                    <div>
                                        <label class="titulos" for="usu_nombre1">Primer nombre*</label>
                                        <input type="text" name="usu_nombre1" id="nombre1"
                                            class="form-control validar-nombre" placeholder="Primer nombre">
                                    </div>
                                    <div class="mt-3">
                                        <label class="titulos" for="usu_nombre2">Segundo nombre</label>
                                        <input type="text" name="usu_nombre2" id="nombre2"
                                            class="form-control validar-nombre" placeholder="Segundo nombre">
                                        <small class="form-text text-muted">Opcional.</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h2 class="titulos">Apellidos</h2>
                                    <div>
                                        <label class="titulos" for="usu_apellido1">Primer Apellido*</label>
                                        <input type="text" name="usu_apellido1" id="apellido1"
                                            class="form-control validar-nombre" placeholder="Primer apellido">
                                    </div>
                                    <div class="mt-3">
                                        <label class="titulos" for="usu_apellido2">Segundo Apellido</label>
                                        <input type="text" name="usu_apellido2" id="apellido2"
                                            class="form-control validar-nombre" placeholder="Segundo apellido">
                                        <small class="form-text text-muted">Opcional.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <h2 class="titulos">Datos de Identificación</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="titulos" for="doc_id">Tipo de documento*</label>
                                    <select name="doc_id" id="doc" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        foreach ($docs as $doc) {
                                            echo "<option value='" . $doc['doc_id'] . "'>" . $doc['nombre_tipo'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="titulos" for="usu_documento">Nro Documento*</label>
                                    <input type="text" name="usu_documento" id="documentoRegistro"
                                        class="form-control validar-num" placeholder="Documento"
                                        data-url="<?php echo getUrl("Acceso", "Acceso", "validarDoc", false, "ajax") ?>">
                                </div>
                                <div class="mt-3">
                                    <label class="titulos" for="sex_id">Sexo biologico*</label>
                                    <select id="sexo" name="sex_id" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        foreach ($sexo as $sex) {
                                            echo "<option value ='" . $sex['sex_id'] . "'>" . $sex['sex_desc'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12  p-2">
                            <h2 class="titulos">Direccion de residencia</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="titulos" for="tipoVia">Tipo de vía*</label>
                                    <select id="tipoVia" name="tipoVia" class="form-control"
                                        title="Escoja el tipo de via, por ejemplo: Calle">
                                        <option value="">Seleccione...</option>
                                        <option value="Calle">Calle</option>
                                        <option value="Carrera">Carrera</option>
                                        <option value="Avenida">Avenida</option>
                                        <option value="Transversal">Transversal</option>
                                        <option value="Diagonal">Diagonal</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="titulos" for="numeroPrincipal">Número principal*</label>
                                    <input type="number" id="numeroPrincipal" name="numeroPrincipal"
                                        class="form-control" placeholder="123" min="1" max="300">
                                </div>
                                <div class="col-md-1">
                                    <label class="titulos" for="complemento1">Complemento</label>
                                    <input type="text" id="complemento1" name="complemento1" class="form-control"
                                        placeholder="J" maxlength="3">
                                </div>
                                <div class="col-md-2">
                                    <label class="titulos" for="numeroSecundario">Número 1</label>
                                    <input type="number" id="numeroSecundario" name="numeroSecundario"
                                        class="form-control" placeholder="22" min="1" max="300" maxlength="3">
                                </div>
                                <div class="col-md-1">
                                    <label class="titulos" for="complemento2">Complemento</label>
                                    <input type="text" id="complemento2" name="complemento2" class="form-control"
                                        placeholder="Bis/A/Sur">
                                </div>
                                <div class="col-md-2">
                                    <label class="titulos" for="numeroTerciario">Número 2</label>
                                    <input type="number" id="numeroTerciario" name="numeroTerciario"
                                        class="form-control" placeholder="42" min="1" max="300" maxlength="3">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="titulos" for="referencias">Referencias adicionales</label>
                                    <textarea id="referencias" name="referencias" class="form-control" rows="1"
                                        maxlength="100" placeholder="Máx. 100 Carácteres"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <h2 class="titulos">Datos de contacto</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="titulos" for="usu_tel">Teléfono*</label>
                                    <input type="text" name="usu_tel" id="telefono" class="form-control validar-num"
                                        placeholder="Teléfono">
                                </div>
                                <div class="col-md-6">
                                    <label class="titulos" for="usu_correo">Correo*</label>
                                    <input type="text" name="usu_correo" id="correo" class="form-control"
                                        placeholder="usuario@dominio.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <h2 class="titulos">Contraseñas</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="titulos" for="usu_clave">Clave*</label>
                                    <input type="password" name="usu_clave" id="clave" class="form-control claves"
                                        placeholder="Clave">
                                </div>
                                <div class="col-md-6">
                                    <label class="titulos" for="usu_clavenew">Confirmar clave*</label>
                                    <input type="password" name="usu_clavenew" id="clavenew" class="form-control claves"
                                        placeholder="Confirmar clave">
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="enviar p-4">
                <input type="submit" value="Registrarme" class="btn">
                <div class="mt-2">
                    <span id="pregunta">¿Ya tienes cuenta? <a href="index.php" id="link">Ingresar</a></span>
                </div>
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