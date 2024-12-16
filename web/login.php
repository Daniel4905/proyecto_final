<?php

include_once '../lib/helpers.php';

$error_message = '';
if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>AccidentEye</title>
    <link rel="icon" href="img/file.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="css/login.css"> <!-- Enlaza el archivo CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->

</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['RegExitoso'])) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Bienvenido a AccidentEye, ya puedes acceder',
                    confirmButtonText: 'Acceder'
                });
            });
             </script>";
            unset($_SESSION['RegExitoso']);
        }
        ?>
        <div class="logo">
            <img src="img/logo_claro.png" alt="Logo geovisor" class="img-fluid"> <!-- Logo de la clínica -->
        </div>
        <div class="division">
            <div class="row">
                <div class="col-3">
                    <div class="line l"></div>
                </div>
                <div class="col-3">
                    <div class="line r"></div>
                </div>
            </div>
        </div>
        <form action="<?php echo getUrl('Acceso', 'Acceso', 'login', false, "ajax"); ?>" method="POST" class="myform">
            <div class="form-group">
                <label for="numeroId" class="form-label">Número de Identificación:</label>
                <input type="text" id="numeroId" name="numeroId" class="form-control">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" class="form-control">
                    <button type="button" class="toggle-password">
                        <i class="far fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                <span><a href="#">Recuperar contraseña</a></span>
            </div>
            <div class="form-group">
                <?php if ($error_message): ?>
                    <p class='text-danger'><?= htmlspecialchars($error_message) ?></p>

                <?php endif; ?>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>
            <div class=" my-3">
                <span>¿No tienes cuenta? <a
                        href="<?php echo getUrl('Acceso', 'Acceso', 'getCreate', false, "ajax"); ?>">Registrarse</a></span>
            </div>
        </form>
    </div>

    <script>
        // Código jQuery para la validación del formulario
        $(document).ready(function () {
            // Maneja el evento de envío del formulario
            $('.login-form').on('submit', function (event) {
                var valid = true; // Variable para controlar la validación

                // Limpia mensajes de error anteriores
                $('.text-danger').remove();


                // Validar Número de Identificación
                var numeroId = $('#numeroId').val();
                if (numeroId === "" || !/^\d+$/.test(numeroId)) {
                    valid = false; // Marca la validación como fallida
                    $('#numeroId').after("<p class='text-danger'>Por favor, ingrese un número de identificación válido.</p>"); // Mensaje de error
                }

                // Validar Fecha de Nacimiento
                var password = $('#password').val();
                if (password === "") {
                    valid = false; // Marca la validación como fallida
                    $('#password').after("<p class='text-danger'>Por favor, ingrese su contraseña.</p>"); // Mensaje de error
                }

                // Previene el envío del formulario si la validación falla
                if (!valid) {
                    event.preventDefault();
                }
            });

            $(document).on('click', ".toggle-password", function () {
                var password = $("#password");
                var boton = $("#toggleIcon");

                if (password.attr("type") === "password") {
                    password.attr("type", "text");
                    boton.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    password.attr("type", "password");
                    boton.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
        

</body>

</html>