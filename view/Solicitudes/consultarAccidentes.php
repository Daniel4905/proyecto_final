<div class="container container-scroll">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Lesionados</th>
                    <th>Solicitante</th>
                    <th>Detalles</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($accidentes as $acc) {
                        echo "<tr>";
                        echo "<td>" . $acc['reg_acc_id'] . "</td>";
                        echo "<td>" . $acc['tipo_choque']." - ".$acc['detalles_accidente']  . "</td>";
                        echo "<td>" . $acc['reg_acc_fecha_hora'] . "</td>";
                        echo "<td>";
                        if ($acc['reg_acc_lesionados']  === 't') {
                            echo "Sí";
                        } else {
                            echo "No";
                        }
                        echo "</td>";
                        echo "<td>" . $acc['usuario_nombre'] .  "</td>";
                        echo "<td>" .
                            "<button class='btn btn-outline-secondary btn-detalles' data-id='" . $acc['reg_acc_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesAccidente", false, "ajax") . "'>Ver detalles
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