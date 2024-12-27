<div class="container container-scroll">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Solicitante</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($reductores as $red) {
                        echo "<tr>";
                        echo "<td>" . $red['sol_red_dan_id'] . "</td>";
                        echo "<td>" . $red['reductor'] .  "</td>";
                        echo "<td>".
                        $red['sol_red_dan_fecha'];
                        echo "</td>";
                        echo "<td>" . $red['usuario_nombre'] . "</td>";
                        echo "<td>";
                        echo "<select id='' name='estado' class='form-select estado_solicitud' 
                        data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoRedDan", false, "ajax") . "' 
                        data-soli='" . $red['sol_red_dan_id'] . "'>";
                            foreach ($estados as $est) {
                                $selected = "";
                                if ($est['est_id'] == $red['est_sol_id']) {
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
                </tbody>
            </table>
            <div id="datError" class='alert alert-danger d-none' role='alert'>
                No se encontraron resultados en la búsqueda.
            </div>
        </div>
    </div>


</div>
<div class="container mt-4">
    <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 5), 'ajax'); ?>" class="btn btn-secondary">
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