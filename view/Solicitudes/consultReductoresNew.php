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
    <div class="accordion" id="accordionReductores">
        <?php
        if (count($reductores) > 0) {
            foreach ($reductores as $red) {
                $redId = $red['sol_red_new_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$redId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$redId' aria-expanded='false' aria-controls='collapse$redId'>";
                echo "Reductor ID: " . $red['sol_red_new_id'] . " &nbsp; - &nbsp;" . $red['sol_red_new_fecha'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$redId' class='accordion-collapse collapse' aria-labelledby='heading$redId' data-bs-parent='#accordionReductores'>";
                echo "<div class='accordion-body'>";
                echo "<p><strong><i class='fa fa-car-crash'></i> Tipo:</strong> " . $red['reductor'] . "</p>";
                echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $red['usuario_nombre'] . "</p>";
                
                
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

                echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $red['sol_red_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesRedNew", false, "ajax") . "'>Ver detalles</button>";
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
    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 6), 'ajax'); ?>" class="btn btn-secondary">
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