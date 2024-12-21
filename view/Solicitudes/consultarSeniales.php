<div class="container container-scroll">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Solicitante</th>
                    <th>Detalles</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($senial as $sen) {
                        echo "<tr>";
                        echo "<td>" . $sen['sol_sen_new_id'] . "</td>";
                        echo "<td>" . $sen['tipo_sen_desc'] .  "</td>";
                     //   echo "<td>" . $sen['reg_acc_fecha_hora'] . "</td>";
                        echo "<td>";
                        if ($acc['reg_acc_lesionados'] === 't') {
                            echo "Sí";
                        } else {
                            echo "No";
                        }
                        echo "</td>";
                        echo "<td>" . $sen['usuario_nombre'] . "</td>";
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