$(document).ready(function () {
    $(document).on('click', ".btn-detalles", function () {
        let usu_id = $(this).data("id");
        let url = $(this).data("url");
    
        $.ajax({
            url: url,
            type: 'POST',
            data: { 'usu_id': usu_id },
            success: function (data) {
                $('#contenidoDetalles').html(data);
                $('#detallesModal').modal('show'); 
            }
        });
    });
    
    
});
