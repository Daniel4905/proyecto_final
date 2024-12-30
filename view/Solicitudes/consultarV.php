<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles de la solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
                <?php
                if (!empty($vias)) {
                    foreach ($vias as $via) {
                        if ($via) {
                            $evidencia = !empty($via['imagenes']) ? explode(', ', $via['imagenes']) : array();

                            echo "<p><strong>ID:</strong> " . $via['sol_via_dan_id'] . "</p>" .
                                "<p><strong>Fecha y hora:</strong> " . $via['fecha_hora'] . "</p>" .
                                "<p><strong>Tipo via:</strong> " . $via['desc_via'] . "</p>" .
                                "<p><strong>Solicitante:</strong> " . $via['usuario_nombre'] . "</p>" .
                                "<p><strong>Descripción:</strong> " . $via['descripcion_via'] . "</p>" .
                                "<p><strong>Tipo de daño:</strong> " . $via['tipo_danio'] . "</p>" .
                                "<p><strong>Estado:</strong> " . $via['est_nombre'] . "</p>";


                            if (!empty($evidencia)) {
                                echo "<p><strong>Evidencia adjunta:</strong></p>";
                                foreach ($evidencia as $ruta) {
                                    $rutasinEs = trim($ruta);
                                    if (!empty($rutasinEs) && file_exists($rutasinEs)) {
                                        echo "<div style='border: 5px solid; max-width: 200px;'>";
                                        echo "<img src='" . $ruta . "' alt='Evidencia' style='max-width: 150px; margin: 10px;'>";
                                        echo "</div>";
                                    } elseif (!empty($rutasinEs)) {
                                        echo "<p>No se pudo cargar la imagen: $ruta</p>";
                                    }
                                }
                            } else {
                                echo "<p><strong>Evidencia adjunta:</strong> No hay evidencia disponible.</p>";
                            }
                        } else {
                            echo "<p class='text-danger'>No se encontraron detalles para esta solicitud.</p>";
                        }
                    }
                } else {
                    echo "<h3 class='text-danger'>No hay ninguna solicitud registrada en este lugar.</h3>";
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>