$(document).ready(function () {
   const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    const patronNumero = /^[0-9]+$/;

    function agregarError(campo, mensaje) {
        const $campo = $(campo);
        if ($campo.length > 0) {
            $campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
        } else {
            console.error('El campo no se encontró');
        }
    }
    $('#categoria').on('change', function () {
        const tipoId = $(this).val();
        const url = $(this).data('url');

        if (tipoId) {
            $.ajax({
                url: url,
                method: 'POST',
                data: { 'id_cate_red': tipoId },
                success: function (response) {
                    $('#tipoRedu').html(response);
                }
            });
        } else {
            $('#tipoRedu').html('<option value="">Seleccione un tipo de choque primero...</option>');
        }
    });


    //imagen 
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

    $('#formReductorDan').submit(function (event) {

            event.preventDefault();
            $('.text-danger').remove();
            $('input, select').removeClass('input-error');
        
            let valido = true;
        
            const tipo_red= $('#tipoRedu').val().trim();
        
            if (tipo_red === '' || tipo_red=== null ) {
                agregarError($('#tipoRedu'), "Por favor seleccione un tipo de reductor");
                valido = false;
            }
        
            const desc_red=$('#desc_red').val().trim();
            if (desc_red==='' || desc_red===null) {
                agregarError($('#desc_red'),"Por favor ingrese una descripción");
                valido = false;
            }else if ( !patronTexto.test(desc_red) || desc_red.length > 300) {
                agregarError($('#desc_red'), "El campo observaciones solo admite letras (máx. 300)");
                valido = false;
            }

            const archivos = $('input[name="imagenRD"]')[0].files;
            if (archivos.length === 0) {
                agregarError($('input[name="imagenRD"]'), "Por favor seleccione una imagen");
                valido = false;
            }

            const tipoDanio= $('#tipoRedDanio').val().trim();

            if (tipoDanio===''|| tipoDanio===null) {
                agregarError($('#tipoRedDanio'), "Por favor seleccione un tipo de daño");
                valido = false;
            }
            
            if (valido) {
                this.submit();
            }
        
    });

});

