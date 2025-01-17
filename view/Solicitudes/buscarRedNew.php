<?php
if (is_array($reductores) && count($reductores) > 0) {
    foreach ($reductores as $red) {
        $redId = $red['sol_red_new_id'];
        echo "<div class='accordion-item'>";
        echo "<h2 class='accordion-header' id='heading$redId'>";
        echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$redId' aria-expanded='false' aria-controls='collapse$redId'>";
        echo "Reductor - nuevo&nbsp; - &nbsp;" . $red['sol_red_new_fecha'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
        echo "</button>";
        echo "</h2>";
        echo "<div id='collapse$redId' class='accordion-collapse collapse' aria-labelledby='heading$redId' data-bs-parent='#accordionReductores'>";
        echo "<div class='accordion-body'>";
        echo "<p><strong><i class='fa fa-car-crash'></i> Tipo:</strong> " . $red['reductor'] . "</p>";
        if ($_SESSION['rol'] == 2) {
            echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> Tú </p>";
        } else {
            echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $red['usuario_nombre'] . "</p>";
        }
        if ($_SESSION['rol'] === 3) {

            echo "<p><strong><i class='fa fa-check-circle'></i> Estado:</strong>";
            echo "<div class='row'>";
            echo "<div class='col-md-2'>";
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
            echo "</div>";
            echo "</div>";
            echo "</p>";
        }

        echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $red['sol_red_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesRedNew", false, "ajax") . "'>Ver detalles</button>";
        if ($_SESSION['rol'] != 2) {
            echo "<button class='btn btn-sm btn-outline-secondary btn-cambios-estado' style = 'margin-left: 10px;' data-id='" . $red['sol_red_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "verAudiRedNew", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver cambios de estado</button>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center' role='alert'>No hay solicitudes de reductores nuevos.</div>";
}
?>