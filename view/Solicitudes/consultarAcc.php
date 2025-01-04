<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles del accidente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
                <?php
                if (!empty($accidentes)) {
                    foreach ($accidentes as $acc) {
                        if ($acc) {
                            if (empty($acc['vehiculos'])) {
                                $vehiculos = "No hay vehiculos involucrados al accidente";
                            } else {
                                $vehiculos = $acc['vehiculos'];
                            }
                            if ($acc['reg_acc_lesionados'] === 't') {
                                $texto = "Sí";
                            } else {
                                $texto = "No";
                            }

                            if ($_SESSION['rol'] == 2) {
                                echo "<p><strong>Fecha y hora:</strong> " . $acc['reg_acc_fecha_hora'] . "</p>" .
                                    "<p><strong>Lesionados:</strong> " . $texto . "</p>" .
                                    "<p><strong>Detalles adicionales:</strong> " . $acc['reg_acc_observaciones'] . "</p>" .
                                    "<p><strong>Tipo de accidente:</strong> " . $acc['tipo_choque'] . " - " . $acc['detalles_accidente'] . "</p>" .
                                    "<p><strong>Vehículos involucrados:</strong> " . $vehiculos . "</p>";
                            } else {
                                echo "<p><strong>ID:</strong> " . $acc['reg_acc_id'] . "</p>" .
                                    "<p><strong>Fecha y hora:</strong> " . $acc['reg_acc_fecha_hora'] . "</p>" .
                                    "<p><strong>Solicitante:</strong> " . $acc['usuario_nombre'] . "</p>" .
                                    "<p><strong>Lesionados:</strong> " . $texto . "</p>" .
                                    "<p><strong>Detalles adicionales:</strong> " . $acc['reg_acc_observaciones'] . "</p>" .
                                    "<p><strong>Tipo de accidente:</strong> " . $acc['tipo_choque'] . " - " . $acc['detalles_accidente'] . "</p>" .
                                    "<p><strong>Vehículos involucrados:</strong> " . $vehiculos . "</p>";
                            }
                            if (!empty($acc['img_rutas'])) {
                                echo "<p><strong>Evidencia adjunta:</strong></p>";
                                $rutas = explode(', ', $acc['img_rutas']);
                                foreach ($rutas as $ruta) {
                                    $rutasinEs = trim($ruta);
                                    if (!empty($rutasinEs) && file_exists($rutasinEs)) {
                                        echo "<div style='border: 5px solid; max-width: 200px;'>";
                                        echo "<img src='" . $ruta . "' alt='Evidencia' style='max-width: 150px; margin: 10px;'>";
                                        echo "</div>";
                                    } elseif (!empty($rutasinEs)) {
                                        echo "<p>No se pudo cargar la imagen </p>";
                                    }
                                }
                            } else {
                                echo "<p><strong>Evidencia adjunta:</strong> No hay evidencia disponible.</p>";
                            }

                        } else {
                            echo "<p class='text-danger'>No se encontraron detalles para este accidente.</p>";
                        }
                    }
                } else {
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