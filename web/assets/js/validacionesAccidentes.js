$(document).ready(function () {
    const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.,;:¡!]+$/;
    const patronNumero = /^[0-9]+$/;

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

    $


    $('input, select').on('focus', function () {
        $(this).removeClass('input-error');
        $(this).next('.text-danger').remove();
    });

    $('#formAccidentes').submit(function (event) {
        event.preventDefault();

        $('.text-danger').remove();
        $('input, select').removeClass('input-error');

        let valido = true;


        const tipoChoque = $('#tipoChoque').val().trim();
        if (tipoChoque === '' || tipoChoque === null) {
            agregarError($('#tipoChoque'), "Por favor seleccione el tipo de choque");
            valido = false;
        }


        const detalleChoque = $('#detalleChoque').val().trim();

        if (detalleChoque === '' || detalleChoque === null) {
            agregarError($('#detalleChoque'), "Por favor seleccione el detalle de choque");
            valido = false;
        }

        if (tipoChoque == 1 && $('input[name="vehiculos[]"]:checked').length !== 2) {
            agregarError1($('.vehi').first(), "Por favor seleccione los dos vehículos involucrados");
            valido = false;
        } else if ($('input[name="vehiculos[]"]:checked').length === 0) {
            agregarError1($('.vehi').first(), "Por favor seleccione al menos un vehículo involucrado");
            valido = false;
        }


        let errorMostrado = false;

        const observaciones = $('#observaciones').val().trim();

        if (observaciones === '') {
            agregarError($('#observaciones'), "El campo observaciones es requerido (30mín, 300máx.)");
            valido = false;
            errorMostrado = true;
        }


        if (!errorMostrado) {
            if (!patronTexto.test(observaciones)) {
                agregarError($('#observaciones'), "El campo observaciones solo admite letras.");
                valido = false;
                errorMostrado = true;
            }

            if (observaciones.length > 300 || observaciones.length < 30) {
                agregarError($('#observaciones'), "El campo observaciones debe tener entre 30 y 300 caracteres.");
                valido = false;
            }
        }


        const archivos = $('input[name="imagenes[]"]')[0].files;
        if (archivos.length === 0) {
            agregarError($('input[name="imagenes[]"]').first(), "Por favor seleccione al menos una imagen");
            valido = false;
        } else {
            const extensionesPermitidas = ['png', 'jpg', 'jpeg'];
            for (let i = 0; i < archivos.length; i++) {
                const extension = archivos[i].name.split('.').pop().toLowerCase();
                if (!extensionesPermitidas.includes(extension)) {
                    agregarError($('input[name="imagenes[]"]').first(), "Solo se permiten imágenes en formato PNG, JPG o JPEG");
                    valido = false;
                    break; 
                }
            }
        }

        if (valido) {
            this.submit();
        }
    });
    $('#tipoChoque').on('change', function () {
        const tipoId = $(this).val();
        const url = $(this).data('url');

        if (tipoId) {
            $.ajax({
                url: url,
                method: 'POST',
                data: { 'id_tipo_accidente': tipoId },
                success: function (response) {
                    $('#detalleChoque').html(response);
                }
            });
        } else {
            $('#detalleChoque').html('<option value="">Seleccione un tipo de choque primero...</option>');
        }
    });

    $('#tipoChoque').on('change', function () {
        let valor = $(this).val();
        let todosVeh = $('input[name="vehiculos[]"]');
        todosVeh.prop('checked', false).prop('disabled', false);
        if (valor == 4 || valor == 3 || valor == 2) {
            todosVeh.off('change').on('change', function () {
                if ($(this).prop('checked')) {
                    todosVeh.not(this).prop('disabled', true);
                } else {
                    todosVeh.prop('disabled', false);
                }
            });
            $('#detalleChoque').off('change');
        } else if (valor == 1) {
            todosVeh.off('change');
            $('#detalleChoque').off('change').on('change', function () {
                let valorDetalle = $(this).val();

                todosVeh.prop('checked', false).prop('disabled', true);

                const choquesVehiculos = {
                    1: [1, 2],
                    2: [1, 3],
                    3: [1, 4],
                    4: [1, 5],
                    5: [1, 6],
                    6: [1, 7],
                    7: [1, 8],
                    8: [1, 9],
                    9: [1, 10],
                    10: [1, 11],
                    11: [1, 12],
                    12: [2, 3],
                    13: [2, 4],
                    14: [2, 5],
                    15: [2, 6],
                    16: [2, 7],
                    17: [2, 8],
                    18: [2, 9],
                    19: [2, 10],
                    20: [2, 11],
                    21: [2, 12],
                    22: [3, 4],
                    23: [3, 5],
                    24: [3, 6],
                    25: [3, 7],
                    26: [3, 8],
                    27: [3, 9],
                    28: [3, 10],
                    29: [3, 11],
                    30: [3, 12],
                    31: [4, 5],
                    32: [4, 6],
                    33: [4, 7],
                    34: [4, 8],
                    35: [4, 9],
                    36: [4, 10],
                    37: [4, 11],
                    38: [4, 12],
                    39: [5, 6],
                    40: [5, 7],
                    41: [5, 8],
                    42: [5, 9],
                    43: [5, 10],
                    44: [5, 11],
                    45: [5, 12],
                    46: [6, 7],
                    47: [6, 8],
                    48: [6, 9],
                    49: [6, 10],
                    50: [6, 11],
                    51: [6, 12],
                    52: [7, 8],
                    53: [7, 9],
                    54: [7, 10],
                    55: [7, 11],
                    56: [7, 12],
                    57: [8, 9],
                    58: [8, 10],
                    59: [8, 11],
                    60: [8, 12],
                    61: [9, 10],
                    62: [9, 11],
                    63: [9, 12],
                    64: [10, 11],
                    65: [10, 12],
                    66: [11, 12]
                };

                if (choquesVehiculos[valorDetalle]) {
                    choquesVehiculos[valorDetalle].forEach(function (vehiculo) {
                        $('#vehiculo' + vehiculo).prop('checked', true).prop('disabled', false);
                    });
                }
            });
        }
    });
});
