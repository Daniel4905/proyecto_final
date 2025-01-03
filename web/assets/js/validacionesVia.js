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
    $('input, select').on('click', function () {
        $(this).removeClass('input-error');
        $(this).next('.text-danger').remove();
    });

    $('#formVias').submit(function (event) {
        event.preventDefault();

        $('.text-danger').remove();
        $('input, select').removeClass('input-error');

        let valido = true;

        const tipoVia= $('#tipoVia').val().trim();
        if (tipoVia === '' || tipoVia === null) {
            agregarError($('#tipoVia'), "Por favor ingrese el tipo de via");
            valido = false;
        }
        const tipoDanio = $('#tipoDanio').val().trim();
        if (tipoDanio === '' || tipoDanio === null) {
            agregarError($('#tipoDanio'), "Por favor ingrese el tipo de daño");
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
});