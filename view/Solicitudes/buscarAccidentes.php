<?php
if (count($accidentes) > 0) {
    foreach ($accidentes as $acc) {
        $accId = $acc['reg_acc_id'];
        echo "<div class='accordion-item'>";
        echo "<h2 class='accordion-header' id='heading$accId'>";
        echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$accId' aria-expanded='false' aria-controls='collapse$accId'>";
        echo "Accidente ID: " . $acc['reg_acc_id'] . " &nbsp; - &nbsp;" . $acc['reg_acc_fecha_hora'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
        echo "</button>";
        echo "</h2>";
        echo "<div id='collapse$accId' class='accordion-collapse collapse' aria-labelledby='heading$accId' data-bs-parent='#accordionAccidentes'>";
        echo "<div class='accordion-body'>";
        echo "<p><strong><i class='fa fa-car-crash'></i> Tipo:</strong> " . $acc['tipo_choque'] . " - " . $acc['detalles_accidente'] . "</p>";
        echo "<p><strong><i class='fa fa-user-injured'></i> Lesionados:</strong> " . ($acc['reg_acc_lesionados'] === 't' ? "Sí" : "No") . "</p>";
        echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $acc['usuario_nombre'] . "</p>";
        echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $acc['reg_acc_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesAccidente", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver detalles</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

} else {
    echo "<div class='alert alert-danger text-center' role='alert'>No se encontraron resultados.</div>";
}
?>