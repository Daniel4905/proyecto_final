<?php
foreach ($vias as $via) {
    echo "<tr>";
    echo "<td>" . $via['sol_via_dan_id'] . "</td>";
    echo "<td>" . $via['tipo_danio'] . "</td>";
    echo "<td>" . $via['fecha_hora'] . "</td>";
    echo "<td>" . $via['usuario_nombre'] . "</td>";
    echo "<td>";
    echo "<select id='' name='estado' class='form-select estado_solicitud' 
                        data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoVias", false, "ajax") . "' 
                        data-soli='" . $via['sol_via_dan_id'] . "'>";
    echo "<option value=''>Seleccione...</option>";
    foreach ($estados as $est) {
        $selected = "";
        if ($est['est_id'] == $via['est_sol_id']) {
            $selected = "selected";
        }
        echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
    }
    echo "</select>";


    echo "</td>";
    echo "<td>" .
        "<button class='btn btn-outline-secondary btn-detalles' data-id='" . $via['sol_via_dan_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesVia", false, "ajax") . "'>Ver detalles
                              </button>" .
        "</td>";
    echo "</tr>";
}
?>