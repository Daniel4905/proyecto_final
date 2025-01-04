<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles de la solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
                <?php
                if (!empty($senialDan)) {
                    foreach ($senialDan as $sen) {
                        if ($sen) {
                            if($_SESSION['rol'] == 2){
                                echo "<p><strong>Fecha y hora:</strong> " . $sen['sol_sen_dan_fecha'] . "</p>" .
                                        "<p><strong>Tipo de señal:</strong> " . $sen['senal'] . "</p>" .
                                        "<p><strong>Descripcion:</strong> " . $sen['desc_sen_dan'] . "</p>" .
                                        "<p><strong>Estado:</strong> " . $sen['est_nombre'] . "</p>";
                            }else{
                                echo "<p><strong>ID:</strong> " . $sen['sol_sen_dan_id'] . "</p>" .
                                "<p><strong>Fecha y hora:</strong> " . $sen['sol_sen_dan_fecha'] . "</p>" .
                                "<p><strong>Solicitante:</strong> " .  $sen['usuario_nombre'] . "</p>" .
                                "<p><strong>Tipo de señal:</strong> " . $sen['senal'] . "</p>" .
                                "<p><strong>Descripcion:</strong> " . $sen['desc_sen_dan'] . "</p>" .
                                "<p><strong>Estado:</strong> " . $sen['est_nombre'] . "</p>";
                            }
                           

                                if (!empty($sen['img_sen_dan'])) {
                                    echo "<p><strong>Evidencia adjunta:</strong></p>";
                                    $rutas = explode(', ',"img/". $sen['img_sen_dan']);
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