<?php
foreach ($senial as $sen) {
    echo "<tr>";
    echo "<td>" . $sen['sol_sen_dan_id'] . "</td>";
    echo "<td>" . $sen['senal'] . "</td>";
    echo "<td>" .
        $sen['sol_sen_dan_fecha'];
    echo "</td>";
    echo "<td>" . $sen['usuario_nombre'] . "</td>";
    echo "<td>";
    echo "<select id='' name='estado' class='form-select estado_solicitud' 
                        data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoSenNew", false, "ajax") . "' 
                        data-soli='" . $sen['sol_sen_dan_id'] . "'>";
    foreach ($estados as $est) {
        $selected = "";
        if ($est['est_id'] == $sen['est_sol_id']) {
            $selected = "selected";
        }
        echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "<td>" .
        "<button class='btn btn-outline-secondary btn-detalles' data-id='" . $sen['reg_acc_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesAccidente", false, "ajax") . "'>Ver detalles
                              </button>" .
        "</td>";
    echo "</tr>";
}
?>