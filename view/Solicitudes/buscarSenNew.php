<?php
if (count($senial) > 0) {
    foreach ($senial as $sen) {
        $senId = $sen['sol_sen_new_id'];
        echo "<div class='accordion-item'>";
        echo "<h2 class='accordion-header' id='heading$senId'>";
        echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$senId' aria-expanded='false' aria-controls='collapse$senId'>";
        echo "Señal ID: " . $sen['sol_sen_new_id'] . " &nbsp; - &nbsp;" . $sen['sol_sen_new_fecha'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
        echo "</button>";
        echo "</h2>";
        echo "<div id='collapse$senId' class='accordion-collapse collapse' aria-labelledby='heading$senId' data-bs-parent='#accordionSeniales'>";
        echo "<div class='accordion-body'>";

        echo "<p><strong><i class='fa fa-traffic-light'></i> Tipo de Señal:</strong> " . $sen['senal'] . "</p>";
        echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $sen['usuario_nombre'] . "</p>";

        echo "<p><strong><i class='fa fa-check-circle'></i> Estado:</strong>";
        echo "<div class='row'>";
        echo "<div class='col-md-2'>";
        echo "<select class='form-select estado_solicitud' 
                        data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoSenNew", false, "ajax") . "' 
                        data-soli='" . $sen['sol_sen_new_id'] . "'>";
        foreach ($estados as $est) {
            $selected = "";
            if ($est['est_id'] == $sen['est_sol_id']) {
                $selected = "selected";
            }
            echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "</div>";
        echo "</p>";

        echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $sen['sol_sen_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesSenNew", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver detalles</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center' role='alert'>No se encontraron resultados.</div>";
}
?>