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
    <div class="accordion" id="accordionSeniales">
        <?php
        if (count($senial) > 0) {
            foreach ($senial as $sen) {
                $senId = $sen['sol_sen_dan_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$senId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$senId' aria-expanded='false' aria-controls='collapse$senId'>";
                echo "Señal ID: " . $sen['sol_sen_dan_id'] . " &nbsp; - &nbsp;" . $sen['sol_sen_dan_fecha'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
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
                        data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoSenDan", false, "ajax") . "' 
                        data-soli='" . $sen['sol_sen_dan_id'] . "'>";
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

                echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $sen['sol_sen_dan_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesSenDan", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver detalles</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>No se encontraron resultados.</div>";
        }
        ?>
    </div>
    <div id="datError" class="alert alert-danger d-none" role="alert">
        No se encontraron resultados en la búsqueda.
    </div>
</div>

<div class="mt-4">
    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 4), 'ajax'); ?>" class="btn btn-secondary">
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