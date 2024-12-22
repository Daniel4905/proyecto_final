<?php
if (!empty($usuario)) {
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

        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>".
            "<div>".
                 "<h6 class='mb-1 fw-bold'>" . $usu['usu_nombre1'] . " " . $usu['usu_nombre2'] ." ". $usu['usu_apellido1'] . " " . $usu['usu_apellido2'] . "</h6>" .
                "<p class='mb-1 fs-6'>" .
                    "<strong>Documento:</strong>". " " . $usu['usu_documento'] . "<br>".
                    "<strong>Correo:</strong>". " " . $usu['usu_correo'] . "<br>".
                    "<strong>Teléfono:</strong>". " " . $usu['usu_tel'] . "<br>".
                    "<span class='$estadoClass fw-bold' style = 'font-size: 12px;'>" . $estadoText . "</span>".
                "</p>".
            "</div>".
            "<div class='row'>".
                "<div class='col-12 col-md-5 mb-2'>".
                    "<button class='$class btn-sm w-100' id='cambiar_estado' data-url='" . getUrl('Usuarios', 'Usuarios', 'postUpdateStatus', false, 'ajax') . "' data-id='" . $usu['est_id'] . "' data-user='" . $usu['usu_id'] . "' $disabled>".
                        $buttonText.
                    "</button>".
                "</div>".
                "<div class='col-12 col-md-5 mb-2'>".
                    "<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "' class='btn btn-primary btn-sm w-100'>Editar</a>".
                "</div>".
                "<div class='col-12 col-md-10 mb-2'>".
                    "<button class='btn btn-outline-secondary btn-sm w-100 btn-detalles' data-id='" . $usu['usu_id'] . "' data-url='" . getUrl("Usuarios", "Usuarios", "detallesUsuario", false, "ajax") . "'>Ver detalles</button>".
                "</div>".
            "</div>".
        "</li>";

    }
} else {
    echo "<li class='list-group-item text-center fw-bold' style= 'color: #dc3545;'>No se encontraron usuarios que coincidan con la búsqueda.</li>";
}
?>