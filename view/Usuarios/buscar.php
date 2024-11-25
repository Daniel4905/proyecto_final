<?php
foreach ($usuario as $usu) {
    $clase = "";
    $text = "";
    $disabled = "";
    echo "<tr>";
    echo "<td>" . $usu['doc_abrev'] . ' ' . $usu['usu_documento'] . "</td>";
    echo "<td>" . $usu['usu_nombre1'] . " " . $usu['usu_nombre2'] . "</td>";
    echo "<td>" . $usu['usu_apellido1'] . " " . $usu['usu_apellido2'] . "</td>";
    echo "<td>" . $usu['usu_correo'] . "</td>";
    echo "<td>" . $usu['usu_tel'] . "</td>";
    echo "<td>" . $usu['usu_direccion'] . "</td>";
    echo "<td>" . $usu['rol_nombre'] . "</td>";
    if ($_SESSION['id'] == $usu['usu_id'] || stristr($usu['rol_nombre'], "Admin")) {
        $disabled = "disabled";
    } else {
        $disabled = "";
    }

    if ($usu['est_id'] == 1) {
        $class = "btn btn-danger";
        $text = "Inhabilitar";
    } else if ($usu['est_id'] == 2) {
        $class = "btn btn-success";
        $text = "Habilitar";
    }
    echo "<td>";
    if (!empty($class))
        echo "<button class='" . $class . "' id='cambiar_estado' data-url='" . getUrl("Usuarios", "Usuarios", "postUpdateStatus", false, "ajax") . "' data-id = '" . $usu['est_id'] . "' data-user='" . $usu['usu_id'] . "' $disabled>" . $text . "</button>" .
            "</td>";
    echo "<td>" .
        "<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "'>" .
        "<button class='btn btn-primary'>Editar" .
        "</button>" .
        "</a>";
    echo "</td>";
    echo "<td>" . "<button class='btn btn-outline-secondary btn-detalles' data-id='" . $usu['usu_id'] . "' data-url='" . getUrl("Usuarios", "Usuarios", "detallesUsuario", false, "ajax") . "'>Ver detalles
                        </button>" .
        "</td>";
    echo "</tr>";
}
?>