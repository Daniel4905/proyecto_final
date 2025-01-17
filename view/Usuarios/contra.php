<form action="<?php echo getUrl("Usuarios", "Usuarios", "actualizarContra", false, "ajax") ?>" id="formActContra">
    <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
    <div class="row col-md-12 mt-2" id="divContra">
        <div class="col-md-4 mt-2">
            <label for="usu_clave">Clave nueva</label>
            <input type="password" name="usu_clavenew" id="clavenewUp" class="form-control claves" placholder="Clave">
        </div>
        <div class="col-md-4 mt-2">
            <label for="usu_clave">Confirmar clave nueva*</label>
            <input type="password" name="usu_clavenewConf" id="clavenewConf" class="form-control claves"
                placholder="Clave">
        </div>
        <div class="col-md-4 mt-2">
            <label for="usu_claveAnt">Contraseña actual</label>
            <input type="password" name="usu_clave" id="clave" class="form-control claves" placholder="Clave"
                data-id="<?php echo $_SESSION['id']; ?>"
                data-url="<?php echo getUrl('Usuarios', 'Usuarios', "ValidarCont", false, "ajax"); ?>">
            <small class="form-text text-muted">Para actualizar sus datos debe igresar su contraseña.</small>
        </div>
    </div>
    <input type="submit" class="btn btn-primary">
</form>

<script>

    $(document).ready(function () {
        const patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;
        claveValida = false;

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

        function agregarError(campo, mensaje) {
            const $campo = $(campo);
            if ($campo.length > 0) {
                $campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
            } else {
                console.error('El campo no se encontró');
            }
        }


        $('#formActContra').submit(function (event) {
            event.preventDefault();
            $('.text-danger').remove();
            $('input, select').removeClass('input-error');

            let valido = true;

            if (!validarCampo($('#clavenewUp'), patronClave, 'la contraseña', 'La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.')) {
                valido = false;
            }
            if (!validarCampo($('#clavenewConf'), patronClave, 'la contraseña', 'La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.')) {
                valido = false;
            }
            if (!claveValida) {
                valido = false;
            }
            if (valido) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Se actualizará la contraseña.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = $(this).serialize();

                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                if (response == "Actualización exitosa") {
                                    Swal.fire({
                                        title: '¡Actualizado!',
                                        text: 'Los contraseña se ha actualizado correctamente.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else if (response == "No se pudo actualizar la contraseña") {
                                    Swal.fire(
                                        'Error',
                                        'Ocurrió un problema al actualizar la contraseña.',
                                        'error'
                                    );
                                } else if (response == "Las contraseñas no coinciden") {
                                    Swal.fire(
                                        'Error',
                                        'Las contraseñas no coinciden.',
                                        'error'
                                    );
                                } else if (response == "La contraseña actual no es la correcta") {
                                    Swal.fire(
                                        'Error',
                                        'La contraseña actual no es la correcta.',
                                        'error'
                                    );
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire(
                                    'Error',
                                    'Ocurrió un problema al actualizar los datos.',
                                    'error'
                                );
                            }
                        });

                    }
                });
            }



        });
        $('#clave').on('blur', function () {
            const clave = $(this).val();
            const idUsuario = $(this).data('id');
            const url = $(this).data('url');

            $('.text-danger').remove();
            $(this).removeClass('input-error');

            if (clave) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { 'clave': clave, 'id': idUsuario },
                    success: function (response) {
                        if (response === "Contraseña válida") {
                            claveValida = true;
                            console.log("Contraseña válida");
                        } else {
                            claveValida = false;
                            agregarError('#clave', response);
                        }
                    },
                    error: function () {
                        claveValida = false;
                    }
                });
            } else {
                claveValida = false;
                agregarError('#clave', 'Por favor, ingrese su contraseña.');
            }
        });
    });

</script>