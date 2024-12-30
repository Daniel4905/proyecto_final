<div class="row g-3 mb-3">
    <div class="col-md-3">
        <label for="startDate" class="form-label">Fecha de inicio</label>
        <input type="date" class="form-control" id="startDate" name="startDate">
    </div>
    <div class="col-md-3">
        <label for="endDate" class="form-label">Fecha de fin</label>
        <input type="date" class="form-control" id="endDate" name="endDate">
    </div>
</div>
<div class="container-scroll-sols">
    <div class="accordion" id="accordionVias">
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
                echo "<p><strong><i class='fas fa-road'></i>Tipo de via:</strong> " . $via['desc_via'] . "</p>";
                echo "<p><strong><i class='fas fa-exclamation-triangle'></i>Tipo de Daño:</strong> " . $via['tipo_danio'] . "</p>";
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
    </div>
</div>


<div class="mt-4">
    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 2), 'ajax'); ?>" class="btn btn-secondary">    
    <i class="fas fa-file-excel"></i>
      Descargar reporte completo en formato XLSX
    </a>
</div>
<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles del accidente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>