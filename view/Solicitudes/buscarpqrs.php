<?php
if (isset($pqrs) && is_array($pqrs) && count($pqrs) > 0) {
    foreach ($pqrs as $index => $pq) {
        echo "<div class='accordion-item'>";
        echo "<h2 class='accordion-header' id='heading$index'>";
        echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$index' aria-expanded='false' aria-controls='collapse$index'>";
        if ($_SESSION['rol'] == 1) {
            echo "ID: " . $pq['id_pqrs'] . " - " . $pq['desc_tipo_pqrs'];
        } else {
            echo $pq['desc_tipo_pqrs'] . " - " . $pq['fecha_hora'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
        }
        echo "</button>";
        echo "</h2>";
        echo "<div id='collapse$index' class='accordion-collapse collapse' aria-labelledby='heading$index' data-bs-parent='#pqrsAccordion'>";
        echo "<div class='accordion-body'>";
        echo "<p><strong>Descripción:</strong> " . $pq['desc_pqrs'] . "</p>";
        if ($_SESSION['rol'] == 1) {
            echo "<p><strong>Solicitante:</strong> " . $pq['usuario_nombre'] . "</p>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>No hay ninguna pqrs registrada</div>";
}
?>