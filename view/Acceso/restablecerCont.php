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
        <div class="logo">
            <img src="img/logo_claro.png" alt="Logo geovisor" class="img-fluid">
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
        <div id="formContra">
            <form action="<?php echo getUrl('Acceso', 'Acceso', 'restContraNew', false, "ajax"); ?>" method="POST"
                class="myform" id="restContraseña">
                <h4 class="form-label">Restablezca su contraseña</h4>
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <div class="form-group">
                    <label for="usu_clave" class="form-label">Contraseña</label>
                    <div class="password-container">
                        <input type="password" id="usu_clave" name="usu_clave" class="form-control">
                        <button type="button" class="toggle-password">
                            <i class="far fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="usu_clavenew" class="form-label">Confirmar contraseña</label>
                    <input type="password" id="usu_clavenew" name="usu_clavenew" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" id="restablecer">Restablecer contraseña</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            const patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;

            function agregarError(campo, mensaje) {
                // En lugar de colocar el mensaje dentro del form-group, lo colocamos fuera
                $(campo).closest('.form-group').append(`<p class='text-danger'>${mensaje}</p>`);
            }
            function validarCampo(campo, patron, campoNombre, mensajeError) {
                const valor = campo.val().trim();
                if (valor === '') {
                    agregarError(campo, `Por favor, ingrese ${campoNombre}.`);
                    return false;
                }
                if (!patron.test(valor)) {
                    agregarError(campo, mensajeError);
                    return false;
                }
                return true;
            }

            $('#restContraseña').submit(function (event) {
                event.preventDefault();

                $('.text-danger').remove();
                $('input, select').removeClass('input-error');

                let valido = true;


                if (!validarCampo($('#usu_clave'), patronClave, 'la contraseña', 'La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.')) {
                    valido = false;
                }
                const clavenew = $('#usu_clavenew').val().trim();
                if (clavenew === '' || clavenew !== $('#usu_clave').val().trim()) {
                    agregarError($('#usu_clavenew'), 'La confirmación de la contraseña no coincide con la contraseña ingresada.');
                    valido = false;
                }

                if(valido){
                    this.submit();
                }

            });

            $(document).on('click', ".toggle-password", function () {
                var password = $("#usu_clave");
                var passwordnew = $("#usu_clavenew");
                var boton = $("#toggleIcon");

                if (password.attr("type") === "password") {
                    password.attr("type", "text");
                    passwordnew.attr("type", "text");
                    boton.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    password.attr("type", "password");
                    passwordnew.attr("type", "password");
                    boton.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });

        });    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>


</body>

</html>