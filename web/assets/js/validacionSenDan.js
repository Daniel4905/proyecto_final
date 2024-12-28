
$(document).ready(function () {

    
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


