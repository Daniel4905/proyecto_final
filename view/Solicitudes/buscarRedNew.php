<?php
foreach ($reductores as $red) {
    echo "<tr>";
    echo "<td>" . $red['sol_red_new_id'] . "</td>";
    echo "<td>" . $red['reductor'] . "</td>";
    echo "<td>" .
        $red['sol_red_new_fecha'];
    echo "</td>";
    echo "<td>" . $red['usuario_nombre'] . "</td>";
    echo "<td>";
    echo "<select id='' name='estado' class='form-select estado_solicitud' 
                        data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoRedNew", false, "ajax") . "' 
                        data-soli='" . $red['sol_red_new_id'] . "'>";
    foreach ($estados as $est) {
        $selected = "";
        if ($est['est_id'] == $red['est_sol_id']) {
            $selected = "selected";
        }
        echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "<td>" .
        "<button class='btn btn-outline-secondary btn-detalles' data-id='" . $red['sol_red_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesRedNew", false, "ajax") . "'>Ver detalles
                              </button>" .
        "</td>";
    echo "</tr>";
}
?>