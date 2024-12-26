
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

        let url = "ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getSenialDaña";
        if (categoriaId && orientacionId) {
            $.ajax({
                url: url, 
                type: 'POST', 
                data: {
                    categoria_id: categoriaId,
                    orientacion_id: orientacionId
                },
                success: function (response) {
                    $('select[name="tipoSenDan"]').html(response);
                }
            });
        } else {
            $('select[name="tipoSenDan"]').html('<option value="">Seleccione categoría y orientación primero</option>');
            console.warn('Por favor seleccione categoría y orientación.');
        }
    });

});


