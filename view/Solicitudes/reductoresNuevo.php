
<div class="container">
    <div class="row align-items-stretch mt-4">
            <h2>Registro para reductor de velocidad nuevo</h2>
            
            <?php
            if (isset($_SESSION['errores'])) {
                echo "<div class='alert alert-danger' role='alert'>";
                foreach ($_SESSION['errores'] as $error) {
                    echo $error . "<br>";
                }
                echo "</div>";
                unset($_SESSION['errores']);
            }

            ?>

        <div class="col container-scroll ">
            
            <form id="formReductorNew" action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'reductorNew2');?>"  method="post">
                <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="" id="coordenad  as" class="form-control">
                <input type="hidden" name="punto1" id="Coord1">
                <input type="hidden" name="punto2" id="Coord2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select name="categoria" id="categoria" class="form-select" data-url='<?php echo getUrl("Solicitudes", "Solicitudes", "getTipoReduc", false, "ajax") ?>'>
                                <option value="" class="form-option">Seleccione...</option>
                                <?php
                                foreach ($redCate as $cate) {
                                    echo '<option value="' . $cate['categoria_red_id'] . '" class="form-option"> ' .  $cate['nombre_red_categoria'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="tipoRedu" class="form-label">Tipo Reductor</label>
                            <select name="tipoRedu" id="tipoRedu" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2">
                        <label for="" class="form-label">Descripcion de la solicitud</label>
                        <textarea name="desc_red" id="desc_red" placeholder="Detalle su solicitud...." class="form-control"
                            style="height: 100px;"></textarea>
                    </div>
                </div>

                <div class="mt-2 col-md-4">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var valorPunto1 = document.getElementById("punto1").value;
    var valorPunto2 = document.getElementById("punto2").value;

    document.getElementById("Coord1").value = valorPunto1;
    document.getElementById("Coord2").value = valorPunto2;
</script>

<script src="assets/js/validacionesReductorNew.js"></script>