<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles de la solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
                <?php
                if (!empty($redNew)) {
                    foreach ($redNew as $red) {
                        if ($red) {
                            echo "<p><strong>ID:</strong> " . $red['sol_red_new_id'] . "</p>" .
                                "<p><strong>Fecha y hora:</strong> " . $red['sol_red_new_fecha'] . "</p>" .
                                "<p><strong>Solicitante:</strong> " .  $red['usuario_nombre'] . "</p>" .
                                "<p><strong>Tipo de Reductor:</strong> " . $red['nombre_tipo_red'] . "</p>" .
                                "<p><strong>Descripcion:</strong> " . $red['desc_red_new'] . "</p>" .
                                "<p><strong>Estado:</strong> " . $red['est_nombre'] . "</p>";

                        } else {
                            echo "<p class='text-danger'>No se encontraron detalles para este accidente.</p>";
                        }
                    }
                }else{
                    echo "<h3 class='text-danger'>No hay ningun accidente registrado en este lugar.</h3>";
                }

                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>