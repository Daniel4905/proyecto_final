$(document).ready(function () {
    const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
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
            agregarError($('#tipoChoque'), "Por favor ingrese el tipo de choque");
            valido = false;
        }


        if ($('input[name="vehiculos[]"]:checked').length === 0) {
            agregarError1($('.form-check').first(), "Por favor seleccione al menos un vehículo involucrado");
            valido = false;
        }

        const observaciones = $('#observaciones').val().trim();
        if (observaciones === ! '' && !patronTexto.test(observaciones) || observaciones.length > 300) {
            agregarError($('#observaciones'), "El campo observaciones solo admite letras (máx. 300)");
            valido = false;
        }
        
        if (observaciones === '') {
            agregarError($('#observaciones'), "El campo observaciones es requerido (máx. 300)");
            valido = false;
        }


        const archivos = $('input[name="imagenes[]"]')[0].files;
        if (archivos.length === 0) {
            agregarError($('input[name="imagenes[]"]'), "Por favor seleccione al menos una imagen");
            valido = false;
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
});
