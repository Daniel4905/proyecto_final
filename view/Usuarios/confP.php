<style>
    .list-group-item.active {
        background: #6861ce !important;
        border-color: #6861ce !important;
        color: white !important;
    }
</style>

<div class="row">
    <div class="col-md-3 mb-2">
        <div class="list-group" id="sidebarPerf">
            <a href="" class="list-group-item list-group-item-action" id="perfil"
                data-id="<?php echo $_SESSION['id']; ?>"
                data-url="<?php echo getUrl('Usuarios', 'Usuarios', 'viewProfile2', false, "ajax"); ?>">
                Mi perfil
            </a>
            <a href="" id="actualizar" class="list-group-item list-group-item-action"
                data-url="<?php echo getUrl('Usuarios', 'Usuarios', 'getUpdateUsu', false, "ajax"); ?>"
                data-id="<?php echo $_SESSION['id']; ?>">
                Actualizar datos
            </a>
            <a href="contra" class="list-group-item list-group-item-action"
                data-url="<?php echo getUrl('Usuarios', 'Usuarios', 'getActualizarContra', false, "ajax"); ?>"
                data-id="<?php echo $_SESSION['id']; ?>">
                Cambiar contraseña
            </a>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-body" id="conf">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        var perfilLink = $('#actualizar');
        perfilLink.addClass('active');

        let id = perfilLink.data("id");
        let url = perfilLink.data("url");

        if (url && id) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { 'id': id },
                success: function (data) {
                    $('#conf').html(data);
                }
            });
        }

        $('#sidebarPerf .list-group-item').on('click', function (e) {
            e.preventDefault();
            $('#sidebarPerf .list-group-item').removeClass('active');
            $(this).addClass('active');

            let id = $(this).data("id");
            let url = $(this).data("url");

            if (url && id) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { 'id': id },
                    success: function (data) {
                        $('#conf').html(data);
                    }
                });
            }
        });
    });
</script>