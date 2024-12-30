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
    <div class="accordion" id="accordionAccidentes">
        <?php
        if (count($accidentes) > 0) {
            foreach ($accidentes as $acc) {
                $accId = $acc['reg_acc_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$accId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$accId' aria-expanded='false' aria-controls='collapse$accId'>";
                echo "Accidente ID: " . $acc['reg_acc_id'] . " &nbsp; - &nbsp;"  . $acc['reg_acc_fecha_hora'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
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
    </div>
</div>
<div class="mt-4">
    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 1), 'ajax'); ?>" class="btn btn-secondary">
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