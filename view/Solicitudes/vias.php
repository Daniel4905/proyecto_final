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

<div class="container container-scroll ">
    <form action="<?php echo getUrl("Solicitudes", "Solicitudes", "regVias"); ?>" method="POST"
        enctype="multipart/form-data" id="formVias">
        <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
        <input type="hidden" name="punto1" id="Coord1">
        <input type="hidden" name="punto2" id="Coord2">
        <h3>Descripción del Daño</h3>
        <div class="col-md-6">
            <div class="mb-2">
                <label for="tipoDanio" class="form-label">Tipo de daño:</label>
                <select id="tipoDanio" name="tipoDanio" class="form-select">
                    <option value="">Seleccione..</option>
                    <?php
                    foreach ($danos as $danio) {
                        echo "<option value='" . $danio['tipo_danio_id'] . "'>" . $danio['tipo_danio_desc'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-2">
                <label for="" class="form-label">Descripcion de la solicitud</label>
                <textarea name="detalles" id="observaciones" placeholder="Detalle su solicitud...." class="form-control"
                    style="height: 100px;"></textarea>
            </div>
        </div>
        <h3>Subir Evidencia Fotográfica</h3>
        <div class="row">
            <div class="col-12 col-md-4 mb-3">
                <div class="image-upload-wrapper">
                    <label class="image-upload">
                        <input type="file" accept="image/*" onchange="previewImage(this)" name="imagenes[]">
                        <div class="upload-placeholder">
                            +
                        </div>
                        <img class="preview-image" style="display: none;" alt="Preview">
                        <button type="button" class="remove-image-btn" onclick="removeImage(this)"
                            style="display: none;">✕</button>
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="image-upload-wrapper">
                    <label class="image-upload">
                        <input type="file" accept="image/*" onchange="previewImage(this)" name="imagenes[]">
                        <div class="upload-placeholder">
                            +
                        </div>
                        <img class="preview-image" style="display: none;" alt="Preview">
                        <button type="button" class="remove-image-btn" onclick="removeImage(this)"
                            style="display: none;">✕</button>
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="image-upload-wrapper">
                    <label class="image-upload">
                        <input type="file" accept="image/*" onchange="previewImage(this)" name="imagenes[]">
                        <div class="upload-placeholder">
                            +
                        </div>
                        <img class="preview-image" style="display: none;" alt="Preview">
                        <button type="button" class="remove-image-btn" onclick="removeImage(this)"
                            style="display: none;">✕</button>
                    </label>
                </div>
            </div>
            <div class="mt-3">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        </div>
    </form>
</div>
<script>
    var valorPunto1 = document.getElementById("punto1").value; 
    var valorPunto2 = document.getElementById("punto2").value; 

    document.getElementById("Coord1").value = valorPunto1;
    document.getElementById("Coord2").value = valorPunto2;
</script>

<script>
    $(document).ready(function () {
        $('.image-upload input[type="file"]').on('change', function () {
            const input = $(this);
            const file = input[0].files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrapper = input.parent();
                    const preview = wrapper.find('.preview-image');
                    const placeholder = wrapper.find('.upload-placeholder');
                    const removeBtn = wrapper.find('.remove-image-btn');

                    preview.attr('src', e.target.result).show();
                    placeholder.hide();
                    removeBtn.show();
                };
                reader.readAsDataURL(file);
            }
        });
        $('.remove-image-btn').on('click', function () {
            const button = $(this);
            const wrapper = button.parent();
            const input = wrapper.find('input[type="file"]');
            const preview = wrapper.find('.preview-image');
            const placeholder = wrapper.find('.upload-placeholder');

            input.val('');
            preview.attr('src', '').hide();
            placeholder.show();
            button.hide();
        });
    });
</script>
<script src="assets/js/validacionesVia.js"></script>
