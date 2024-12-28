$(document).ready(function () {

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

    

    $('input, select').on('focus', function () {
        $(this).removeClass('input-error');
        $(this).next('.text-danger').remove();
    });
    $('input, select').on('click', function () {
        $(this).removeClass('input-error');
        $(this).next('.text-danger').remove();
    });

    $('#formSeñalesReporte').submit(function (event) {

            event.preventDefault();
            $('.text-danger').remove();
            $('input, select').removeClass('input-error');
        
            let valido = true;
        
            const tipoSen= $('#tipoSen').val().trim();
        
            if (tipoSen === '' || tipoSen=== null ) {
                agregarError($('#tipoSen'), "Por favor seleccione un tipo de señal");
                valido = false;
            }
        
            const desc=$('#desc').val().trim();
            if (desc==='' || desc===null) {
                agregarError($('#desc'),"Por favor ingrese una descripción");
                valido = false;
            }else if ( !patronTexto.test(desc) || desc.length > 300) {
                agregarError($('#desc_red'), "El campo observaciones solo admite letras (máx. 300)");
                valido = false;
            }
            
            if (valido) {
                this.submit();
            }
        
    });

});





