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
            <form action="<?php echo getUrl('Acceso', 'Acceso', 'restContra', false, "ajax"); ?>" method="POST"
                class="myform" id="restContra">
                <h3 class="form-label">Para recuperar su contraseña ingrese los siguientes campos: </h3>
                <div class="form-group">
                    <label for="numeroId" class="form-label">Número de Identificación:</label>
                    <input type="text" id="numeroId" name="numeroId" class="form-control">
                </div>

                <div class="form-group">
                    <label for="correo" class="form-label">Correo electronico</label>
                    <input type="text" id="correoRest" name="correoRest" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" id="enviarCor">Enviar correo electronico</button>
                </div>
                <div class="enviar p-4">
                    <div class="mt-2">
                        <span id="pregunta">¿Ya tienes cuenta? <a href="index.php" id="link">Ingresar</a></span>
                    </div>
                </div>
            </form>
        </div>
        <div id="loading" style="display: none; color: white;" class="text-center mt-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p>Cargando...</p>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var form = $('#restContra');
            var loading = $('#loading');

            form.on('submit', function (event) {
                event.preventDefault();
                loading.show();

                var formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        loading.hide();
                        if (data.trim() === "Correo enviado exitosamente") {
                            Swal.fire({
                                title: 'Éxito!',
                                text: 'Fue enviado el paso a paso para restablecer su contraseña a su correo.',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'index.php';
                                }
                            });
                        } else if (data.trim() === "Credenciales invalidas") {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Las credenciales son inválidas.',
                                icon: 'error',
                                confirmButtonText: 'Intentar de nuevo'
                            });
                        } else if (data.trim() === "No se pudo enviar el correo") {
                            Swal.fire({
                                title: 'Error!',
                                text: 'No se pudo enviar el correo. Intenta nuevamente.',
                                icon: 'error',
                                confirmButtonText: 'Intentar de nuevo'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Ocurrió un error inesperado.',
                                icon: 'error',
                                confirmButtonText: 'Intentar de nuevo'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        loading.hide();
                        Swal.fire({
                            title: 'Error!',
                            text: 'Ocurrió un error en la solicitud.',
                            icon: 'error',
                            confirmButtonText: 'Intentar de nuevo'
                        });
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>


</body>

</html>