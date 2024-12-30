<?php
if (isset($_SESSION['RegEx'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Usuario registrado exitosamente',
                    confirmButtonText: 'Ok'
                });
            });
          </script>";
    unset($_SESSION['RegEx']);
}

if (isset($_SESSION['ActEx'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Usuario actualizado exitosamente',
                    confirmButtonText: 'Ok'
                });
            });
          </script>";
    unset($_SESSION['ActEx']);
}
?>

<div class="mt-3">
    <h3 class="display-4">Consultar Usuarios</h3>
</div>
<div class="row">
    <div class="col-md-3">
        <input type="text" name="buscar" placeholder="Buscar por nombre o por documento" id="buscar"
            class="form-control mt-3 mb-3"
            data-url='<?php echo getUrl("Usuarios", "Usuarios", "buscar", false, "ajax") ?>'>
    </div>
    <div class="col-md-2 ">
        Filtrar por orden alfabetico
        <select name="" id="orden" class="form-select"
            data-url='<?php echo getUrl("Usuarios", "Usuarios", "ordenarAlf", false, "ajax") ?>'>
            <option value="">Seleccione</option>
            <option value="1" class="form-option">A-Z</option>
            <option value="2" class="form-option">Z-A</option>
        </select>
    </div>
</div>


<div class="container-scroll">
    <ul class="list-group" id="userList">
        <?php
        foreach ($usuario as $usu) {
            if ($_SESSION['id'] == $usu['usu_id']) {
                $disabled = "disabled";
            } else {
                $disabled = "";
            }

            if ($usu['est_id'] == 1) {
                $estadoClass = "text-success";
                $class = "btn btn-danger";
                $buttonText = "Inhabilitar";
                $estadoText = "Habilitado";
            } else {
                $estadoClass = "text-danger";
                $class = "btn btn-success";
                $buttonText = "Habilitar";
                $estadoText = "Inhabilitado";
            }

            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>" .
                "<div>" .
                "<h6 class='mb-1 fw-bold'>" . $usu['usu_nombre1'] . " " . $usu['usu_nombre2'] . " " . $usu['usu_apellido1'] . " " . $usu['usu_apellido2'] . "</h6>" .
                "<p class='mb-1 fs-6'>" .
                "<strong>Documento:</strong>" . " " . $usu['usu_documento'] . "<br>" .
                "<strong>Correo:</strong>" . " " . $usu['usu_correo'] . "<br>" .
                "<strong>Teléfono:</strong>" . " " . $usu['usu_tel'] . "<br>" .
                "<span class='$estadoClass fw-bold' style = 'font-size: 12px;'>" . $estadoText . "</span>" .
                "</p>" .
                "</div>" .
                "<div class='row'>" .
                "<div class='col-12 col-md-5 mb-2'>" .
                "<button class='$class btn-sm w-100' id='cambiar_estado' data-url='" . getUrl('Usuarios', 'Usuarios', 'postUpdateStatus', false, 'ajax') . "' data-id='" . $usu['est_id'] . "' data-user='" . $usu['usu_id'] . "' $disabled>" .
                $buttonText .
                "</button>" .
                "</div>" .
                "<div class='col-12 col-md-5 mb-2'>" .
                "<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "' class='btn btn-primary btn-sm w-100'>Editar</a>" .
                "</div>" .
                "<div class='col-12 col-md-10 mb-2'>" .
                "<button class='btn btn-outline-secondary btn-sm w-100 btn-detalles' data-id='" . $usu['usu_id'] . "' data-url='" . getUrl("Usuarios", "Usuarios", "detallesUsuario", false, "ajax") . "'>Ver detalles</button>" .
                "</div>" .
                "</div>" .
                "</li>";

        }
        ?>
    </ul>
</div>

<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles del Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>