$(document).ready(function () {
    $(document).on('click', ".btn-detalles", function () {
        let id = $(this).data("id");
        let url = $(this).data("url");

        $.ajax({
            url: url,
            type: 'POST',
            data: { 'id': id },
            success: function (data) {
                $('#contenidoDetalles').html(data);
                $('#detallesModal').modal('show');
            }
        });
    });
});
