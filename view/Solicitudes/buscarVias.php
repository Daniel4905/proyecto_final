<?php
        if (isset($vias)) {
            foreach ($vias as $via) {
                $viaId = $via['sol_via_dan_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$viaId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$viaId' aria-expanded='false' aria-controls='collapse$viaId'>";
                echo "Via ID: " . $via['sol_via_dan_id'] . " - " . $via['fecha_hora']. "&nbsp; <i class='fa-regular fa-calendar'></i>";
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$viaId' class='accordion-collapse collapse' aria-labelledby='heading$viaId' data-bs-parent='#accordionVias'>";
                echo "<div class='accordion-body'>";
                echo "<p><strong>Tipo de Daño:</strong> " . $via['tipo_danio'] . "</p>";
                echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $via['usuario_nombre'] . "</p>";
                echo "<p><strong><i class='fa fa-check-circle'></i> Estado:</strong>";
                echo "<div class='row'>"; 
                echo "<div class='col-md-2'>";  
                echo "<select id='' name='estado' class='form-select estado_solicitud' 
                data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoVias", false, "ajax") . "' 
                data-soli='" . $via['sol_via_dan_id'] . "'>";
                foreach ($estados as $est) {
                    $selected = "";
                    if ($est['est_id'] == $via['est_sol_id']) {
                        $selected = "selected";
                    }
                    echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "</div>";
                echo "</p>";
                echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $via['sol_via_dan_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesVia", false, "ajax") . "'>Ver detalles</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>No se encontraron resultados.</div>";
        }
        ?>