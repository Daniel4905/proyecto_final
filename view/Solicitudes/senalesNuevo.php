<div class="container">
    <div class="row align-items-stretch mt-4">
        <div class="col container-scroll ">
            <div>
                <h3>Registro para nueva señal de transito</h3>
            </div>
            <form id="formSeñalesReporte" action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'senialNew'); ?>"
                method="post">
                <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="" id="coordenadas" class="form-control">
                <input type="hidden" name="punto1" id="Coord1">
                <input type="hidden" name="punto2" id="Coord2">
                <label>Describa la señal</label>
                <div class="row mt-3">
                    <div class="col-md-4 ">
                        <div class="mb-2">
                            <label for="" class="form-label">Categoria*</label>
                            <select name="sen_cate" id="categoria" class="form-select fSen" data-bs-toggle="tooltip"
                                title="Seleccione una categoria, obligatorio.">
                                <option value="" class="form-option">Seleccione...</option>
                                <?php
                                foreach ($senCate as $cat) {
                                    echo '<option value="' . $cat['categoria_seniales_id'] . '" class="form-option"> ' . $cat['categoria_seniales_desc'] . '</option>';
                                }
                                ?>
                            </select>
                            <small class="form-text text-muted">Obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Orientacion*</label>
                            <select name="orienSen" id="" class="form-select fSen" data-bs-toggle="tooltip"
                                title="Seleccione una orientación, obligatorio.">
                                <option value="" class="form-option">Seleccione...</option>
                                <?php
                                foreach ($senOrientacion as $orien) {
                                    echo '<option value="' . $orien['orientacion_id'] . '" class="form-option"> ' . $orien['orientacion_desc'] . '</option>';
                                }
                                ?>
                            </select>
                            <small class="form-text text-muted">Obligatorio.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Tipo*</label>
                            <select name="tipoSen" id="tipoSen" class="form-select"
                                data-url="<?php echo getUrl("Solicitudes", "Solicitudes", "infoSens", false, "ajax") ?>"
                                data-bs-toggle="tooltip" title="Seleccione un tipo, obligatorio.">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                            <small class="form-text text-muted">Obligatorio.</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-2">
                        <label for="" class="form-label">Descripcion de la solicitud*</label>
                        <textarea name="sen_desc" id="desc" placeholder="Detalle su solicitud...." class="form-control"
                            style="height: 100px;" data-bs-toggle="tooltip"
                            title="Ingrese una descripción, obligatorio."></textarea>
                        <small class="form-text text-muted">Obligatorio.</small>
                    </div>
                </div>

                <div class="mt-2 col-md-4">
                    <input type="submit" value="Enviar" class="btn btn-primary">
                </div>
            </form>

        </div>
        <div class="col" id="infoSen">

        </div>
    </div>
</div>

<script>
    var valorPunto1 = document.getElementById("punto1").value;
    var valorPunto2 = document.getElementById("punto2").value;

    document.getElementById("Coord1").value = valorPunto1;
    document.getElementById("Coord2").value = valorPunto2;
</script>
<script>
    $(document).on('change', "#tipoSen", function () {
        let url = $(this).attr('data-url');
        let id = $(this).val();

        if (id) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { id: id },
                success: function (data) {
                    $('#infoSen').html(data);
                },
                error: function () {
                    $('#infoSen').html('<div class="alert alert-danger">Error al cargar la información del reductor.</div>');
                }
            });
        }
    });
</script>
<script src="assets/js/validacionesSeniales.js"></script>