

<style>
    .image-upload-wrapper {
        position: relative;
        width: 50%;
        padding-top: 50%;
        border: 2px dashed #ddd;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-upload {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .image-upload input[type="file"] {
        opacity: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        cursor: pointer;
    }

    .upload-placeholder {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        color: #aaa;
        font-weight: bold;
        text-align: center;
        z-index: 1;
    }

    .preview-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    .remove-image-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        line-height: 18px;
        text-align: center;
        cursor: pointer;
        z-index: 3;
    }
</style>

<div class="container">
    <div class="row align-items-stretch mt-4">
            <h2>Registro para reductor de velocidad dañado</h2>
            
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
            <div>
                <label>Escoja el reductor de velocidad para el tramite</label>
            </div>
            <form id="formReductorDan" action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'reductorDan2');?>"  method="post" enctype="multipart/form-data">
            <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="" id="coordenad  as" class="form-control">
                <input type="hidden" name="punto1" id="Coord1">
                <input type="hidden" name="punto2" id="Coord2">
                <div class="row md-3">
                    <div class="col-md-6">
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label for="" class="form-label">Tipo Reductor</label>
                            <select name="tipoRedu" id="tipoRedu" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-1">
                            <label for="" class="form-label">Tipo Daño</label>
                            <select name="tipoRedDanio" id="tipoRedDanio" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                                <?php
                                foreach ($danio as $dan) {
                                    echo '<option value="' . $dan['tipo_danio_id'] . '" class="form-option"> ' . $dan['tipo_danio_desc'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label for="" class="form-label">Adjunte la evidencia</label>
                    <div class="image-upload-wrapper">
                        <label class="image-upload">
                            <input type="file" accept="image/*" onchange="previewImage(this)" name="imagenRD">
                            <div class="upload-placeholder">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <img class="preview-image" style="display: none;" alt="Preview">
                            <button type="button" class="remove-image-btn" onclick="removeImage(this)"
                                style="display: none;">✕</button>
                        </label>
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

<script src="assets/js/validacionesReductorDan.js"></script>



