<div class="container">
    <div class="row align-items-stretch mt-4">
        <div class="col container-scroll ">
            <div>
                <h3>Escoja la señal para el tramite</h3>
            </div>
            <form id="formSeñalesReporte" action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'senialNew'); ?>"
                method="post">
                <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="" id="coordenadas" class="form-control">
                <input type="hidden" name="punto1" id="Coord1">
                <input type="hidden" name="punto2" id="Coord2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Categoria</label>
                            <select name="sen_cate" id="" class="form-select fSen">
                                <option value="" class="form-option">Seleccione...</option>
                                <?php
                                foreach ($senCate as $cat) {
                                    echo '<option value="' . $cat['categoria_seniales_id'] . '" class="form-option"> ' . $cat['categoria_seniales_desc'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Orientacion</label>
                            <select name="orienSen" id="" class="form-select fSen">
                                <option value="" class="form-option">Seleccione...</option>
                                <?php
                                foreach ($senOrientacion as $orien) {
                                    echo '<option value="' . $orien['orientacion_id'] . '" class="form-option"> ' . $orien['orientacion_desc'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Tipo</label>
                            <select name="tipoSen" id="" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-2">
                        <label for="" class="form-label">Descripcion de la solicitud</label>
                        <textarea name="sen_desc" id="" placeholder="Detalle su solicitud...." class="form-control"
                            style="height: 100px;"></textarea>
                    </div>
                </div>

                <div class="mt-2 col-md-4">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </form>

        </div>
        <div class="col">
            <h2>Info señal seleccionada</h2>
            <!-- AJAX -->

            <div class="row">
                <div class="" id="categoria">

                </div>
                <div id="señal">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var valorPunto1 = document.getElementById("punto1").value;
    var valorPunto2 = document.getElementById("punto2").value;

    document.getElementById("Coord1").value = valorPunto1;
    document.getElementById("Coord2").value = valorPunto2;
</script>

<script src="assets/js/validacionesSeniales.js"></script>