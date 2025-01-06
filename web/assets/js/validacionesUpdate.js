
$(document).ready(function () {

    const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const patronNumero = /^[0-9]+$/;
    const patronCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const patronClave = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/;
    let claveValida = false;

    function agregarError1(campo, mensaje) {
        const $campo = $(campo);
        if ($campo.length > 0) {
            $campo.after(`<p class='text-danger'>${mensaje}</p>`);
        } else {
            console.error('El campo no se encontró');
        }
    }
    function agregarError(campo, mensaje) {
        const $campo = $(campo);
        if ($campo.length > 0) {
            $campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
        } else {
            console.error('El campo no se encontró');
        }
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

    $('#formUpdateUsu').submit(function (event) {
        event.preventDefault();

        $('.text-danger').remove();
        $('input, select').removeClass('input-error');

        let valido = true;


        if (!validarCampo($('#nombre1'), patronTexto, 'el primer nombre', 'El primer nombre solo debe contener letras y espacios.')) {
            valido = false;
        }
        if ($('#nombre2').val().trim() !== '' && !validarCampo($('#nombre2'), patronTexto, 'el segundo nombre (opcional)', 'El segundo nombre solo debe contener letras y espacios.')) {
            valido = false;
        }
        if (!validarCampo($('#apellido1'), patronTexto, 'el primer apellido', 'El primer apellido solo debe contener letras y espacios.')) {
            valido = false;
        }
        if ($('#apellido2').val().trim() !== '' && !validarCampo($('#apellido2'), patronTexto, 'el segundo apellido (opcional)', 'El segundo apellido solo debe contener letras y espacios.')) {
            valido = false;
        }

        const tipoDoc = $('#doc').val().trim();
        if (tipoDoc === '') {
            agregarError($('#doc'), 'Por favor, seleccione un tipo de documento.');
            valido = false;
        }

        if (!validarCampo($('#documento'), patronNumero, 'el número de documento', 'El número de documento solo debe contener dígitos mín(8) y máx(10).')) {
            valido = false;
        }
        const documento = $('#documento').val().trim();

        if (documento !== '' && documento.length < 8) {
            agregarError($('#documento'), 'El campo documento debe contener mín(8) y máx(10) dígitos');
        }

        if (documento !== '' && documento.length > 10) {
            agregarError($('#documento'), 'El campo documento debe contener mín(8) y máx(10) dígitos');
        }


        const telefono = $('#telefono').val().trim();
        if (telefono !== '' && telefono.length != 10) {
            agregarError($('#telefono'), 'El campo telefono debe contener (10) digitos');
        }

        const sexo = $('#sexo').val().trim();
        if (sexo === '') {
            agregarError($('#sexo'), 'Por favor, seleccione su sexo biológico.');
            valido = false;
        }


        if (!validarCampo($('#telefono'), patronNumero, 'el número de teléfono', 'El número de teléfono solo debe contener dígitos.')) {
            valido = false;
        }
        const checkbox = $('#cambiarDir').is(':checked');

        if (checkbox) {
            const tipoVia = $('#tipoVia').val().trim();
            if (tipoVia === '') {
                agregarError($('#tipoVia'), 'Por favor, seleccione un tipo de vía.');
                valido = false;
            }


            if (!validarCampo($('#numeroPrincipal'), patronNumero, 'el número principal', 'El número principal solo debe contener dígitos.')) {
                valido = false;
            }
            if (!validarCampo($('#numeroSecundario'), patronNumero, 'el número secundario', 'El número secundario solo debe contener dígitos.')) {
                valido = false;
            }
            if (!validarCampo($('#numeroTerciario'), patronNumero, 'el número terciario', 'El número terciario solo debe contener dígitos.')) {
                valido = false;
            }


            const complemento1 = $('#complemento').val().trim();
            if (complemento1 !== '' && !patronTexto.test(complemento1)) {
                agregarError($('#complemento'), 'El complemento solo debe contener letras y espacios.');
                valido = false;
            }

            const complemento2 = $('#complemento2').val().trim();
            if (complemento2 !== '' && !patronTexto.test(complemento2)) {
                agregarError($('#complemento2'), 'El complemento solo debe contener letras y espacios.');
                valido = false;
            }
        }


        if (!validarCampo($('#correo'), patronCorreo, 'el correo electrónico', 'El correo electrónico debe seguir el formato "usuario@dominio.com".')) {
            valido = false;
        }


        if (!validarCampo($('#clave'), patronClave, 'la contraseña', 'La contraseña debe tener al menos 8 caracteres, incluir una mayúscula, una minúscula, un número y un carácter especial.')) {
            valido = false;
        }

        if (!claveValida) {
            agregarError('#clave', 'La contraseña no ha sido validada correctamente.');
            valido = false;
        }

        if (valido) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Se actualizarán los datos del usuario.',
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

                            if (response === 'Actualización exitosa') {
                                Swal.fire({
                                    title: '¡Actualizado!',
                                    text: 'Los datos se han actualizado correctamente.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Ocurrió un problema al actualizar los datos',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
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





});
