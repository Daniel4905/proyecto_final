$(document).ready(function () {
    const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\.,;:¿?¡!]+$/;
    const patronNumero = /^[0-9]+$/;

    function agregarError(campo, mensaje) {
        const $campo = $(campo);
        if ($campo.length > 0) {
            $campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
        } else {
            console.error('El campo no se encontró');
        }
    }

    $('.fSen').on('change', function () {
        let categoriaId = $('select[name="sen_cate"]').val();
        let orientacionId = $('select[name="orienSen"]').val();

        let url = "ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getSenialF";
        if (categoriaId && orientacionId) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    categoria_id: categoriaId,
                    orientacion_id: orientacionId
                },
                success: function (response) {
                    $('select[name="tipoSen"]').html(response);
                }
            });
        } else {
            $('select[name="tipoSen"]').html('<option value="">Seleccione categoría y orientación primero</option>');
            console.warn('Por favor seleccione categoría y orientación.');
        }
    });

    $('.image-upload input[type="file"]').on('change', function () {
        const input = $(this);
        const file = input[0].files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = input.parent();
                const preview = wrapper.find('.preview-image');
                const placeholder = wrapper.find('.upload-placeholder');
                const removeBtn = wrapper.find('.remove-image-btn');

                preview.attr('src', e.target.result).show();
                placeholder.hide();
                removeBtn.show();
            };
            reader.readAsDataURL(file);
        }
    });
    $('.remove-image-btn').on('click', function () {
        const button = $(this);
        const wrapper = button.parent();
        const input = wrapper.find('input[type="file"]');
        const preview = wrapper.find('.preview-image');
        const placeholder = wrapper.find('.upload-placeholder');

        input.val('');
        preview.attr('src', '').hide();
        placeholder.show();
        button.hide();
    });

    $('input, select').on('focus', function () {
        $(this).removeClass('input-error');
        $(this).next('.text-danger').remove();
    });
    $('input, select').on('click', function () {
        $(this).removeClass('input-error');
        $(this).next('.text-danger').remove();
    });

    $('#formSeñalesDan').submit(function (event) {

        event.preventDefault();

        $('.text-danger').remove();
        $('input, select').removeClass('input-error');

        let valido = true;

        const tipo_sen = $('#tipoSen').val().trim();

        if (tipo_sen === '' || tipo_sen === null) {
            agregarError($('#tipoSen'), "Por favor seleccione un tipo de señal");
            valido = false;
        }

        const desc = $('#desc_sen_dan').val().trim();

        if (desc === '' || desc === null) {
            agregarError($('#desc_sen_dan'), "Por favor ingrese una descripción");
            valido = false;
        } else if (!patronTexto.test(desc) || desc.length > 300 || desc.length <= 30) {
            agregarError($('#desc_sen_dan'), "El campo observaciones solo admite letras (30mín, 300máx.)");
            valido = false;
        }

        const orien = $('#orien').val().trim();
        if (orien === '' || orien === null) {
            agregarError($('#orien'), "Por seleccion la orientacion de la señal");
            valido = false;
        }

        const archivos = $('input[name="imagenSD"]')[0].files;
        if (archivos.length === 0) {
            agregarError($('input[name="imagenSD"]'), "Por favor seleccione una imagen");
            valido = false;
        } else {
            const extensionesPermitidas = ['png', 'jpg', 'jpeg'];
            for (let i = 0; i < archivos.length; i++) {
                const extension = archivos[i].name.split('.').pop().toLowerCase();
                if (!extensionesPermitidas.includes(extension)) {
                    agregarError($('input[name="imagenSD"]').first(), "Solo se permiten imágenes en formato PNG, JPG o JPEG");
                    valido = false;
                    break;
                }
            }
        }

        const tipoDanio = $('#tipoDanio').val().trim();

        if (tipoDanio === '' || tipoDanio === null) {
            agregarError($('#tipoDanio'), "Por favor seleccione un tipo de daño");
            valido = false;
        }

        if (valido) {
            this.submit();
        }

    });

});