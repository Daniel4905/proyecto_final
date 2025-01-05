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
<div class="row align-items-stretch mt-4">
    <div class="col-md-6 container container-scroll">
        <div>
            <label class="form-label">Escoja la señal para el trámite</label>
        </div>
        <form id="formSeñalesDan" action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'senialDanio'); ?>"
            method="post" enctype="multipart/form-data">
            <input type="hidden" name="usu_id" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="" id="coordenadas" class="form-control">
            <input type="hidden" name="punto1" id="Coord1">
            <input type="hidden" name="punto2" id="Coord2">

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label class="form-label">Categoría</label>
                        <select name="sen_cate" class="form-select fSen">
                            <option value="" class="form-option">Seleccione...</option>
                            <?php foreach ($senCate as $cat) { ?>
                                <option value="<?php echo $cat['categoria_seniales_id']; ?>" class="form-option">
                                    <?php echo $cat['categoria_seniales_desc']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-2">
                        <label class="form-label">Orientación</label>
                        <select name="orienSen" id="orien" class="form-select fSen">
                            <option value="" class="form-option">Seleccione...</option>
                            <?php foreach ($senOrientacion as $orien) { ?>
                                <option value="<?php echo $orien['orientacion_id']; ?>" class="form-option">
                                    <?php echo $orien['orientacion_desc']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label class="form-label">Tipo</label>
                        <select name="tipoSen" id="tipoSen" class="form-select"
                            data-url="<?php echo getUrl('Solicitudes', 'Solicitudes', 'infoSens', false, 'ajax'); ?>">
                            <option value="" class="form-option">Seleccione...</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="mb-2">
                        <label class="form-label">Tipo de daño</label>
                        <select name="tipoDanio" id="tipoDanio" class="form-select">
                            <option value="" class="form-option">Seleccione...</option>
                            <?php foreach ($danio as $dan) { ?>
                                <option value="<?php echo $dan['tipo_danio_id']; ?>" class="form-option">
                                    <?php echo $dan['tipo_danio_desc']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Adjunte la evidencia</label>
                    <div class="image-upload-wrapper">
                        <label class="image-upload">
                            <input type="file" accept="image/*" onchange="previewImage(this)" name="imagenSD">
                            <div class="upload-placeholder">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <img class="preview-image" style="display: none;" alt="Preview">
                            <button type="button" class="remove-image-btn" onclick="removeImage(this)"
                                style="display: none;">✕</button>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label">Descripción de la solicitud</label>
                    <textarea name="desc_sen_dan" id="desc_sen_dan" placeholder="Detalle su solicitud..."
                        class="form-control" style="height: 100px;"></textarea>
                </div>
            </div>

            <div class="mt-2">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div>

    <div class="col-md-6" id="infoSen">

    </div>
</div>

<script src="assets/js/validacionSenDan.js"></script>
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
<script>
    var valorPunto1 = document.getElementById("punto1").value;
    var valorPunto2 = document.getElementById("punto2").value;

    document.getElementById("Coord1").value = valorPunto1;
    document.getElementById("Coord2").value = valorPunto2;
</script>
<script>

    $(document).ready(function () {
        const patronTexto = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        const patronNumero = /^[0-9]+$/;

        function agregarError(campo, mensaje) {
            const $campo = $(campo);
            if ($campo.length > 0) {
                $campo.addClass('input-error').after(`<p class='text-danger'>${mensaje}</p>`);
            } else {
                console.error('El campo no se encontró');
            }
        }

        $('.fSen').on('change', function () {
            let categoriaId = $('select[name="sen_cate"]').val();
            let orientacionId = $('select[name="orienSen"]').val();

            let url = "ajax.php?modulo=Solicitudes&controlador=Solicitudes&funcion=getSenialF";
            if (categoriaId && orientacionId) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        categoria_id: categoriaId,
                        orientacion_id: orientacionId
                    },
                    success: function (response) {
                        $('select[name="tipoSen"]').html(response);
                    }
                });
            } else {
                $('select[name="tipoSen"]').html('<option value="">Seleccione categoría y orientación primero</option>');
                console.warn('Por favor seleccione categoría y orientación.');
            }
        });

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

        $('input, select').on('focus', function () {
            $(this).removeClass('input-error');
            $(this).next('.text-danger').remove();
        });
        $('input, select').on('click', function () {
            $(this).removeClass('input-error');
            $(this).next('.text-danger').remove();
        });

        $('#formSeñalesDan').submit(function (event) {

            event.preventDefault();

            $('.text-danger').remove();
            $('input, select').removeClass('input-error');

            let valido = true;

            const tipo_sen = $('#tipoSen').val().trim();

            if (tipo_sen === '' || tipo_sen === null) {
                agregarError($('#tipoSen'), "Por favor seleccione un tipo de señal");
                valido = false;
            }

            const desc = $('#desc_sen_dan').val().trim();
            if (desc === '' || desc === null) {
                agregarError($('#desc_sen_dan'), "Por favor ingrese una descripción");
                valido = false;
            } else if (!patronTexto.test(desc) || desc.length > 300) {
                agregarError($('#desc_sen_dan'), "El campo observaciones solo admite letras (máx. 300)");
                valido = false;
            }

            const orien = $('#orien').val().trim();
            if (orien === '' || orien === null) {
                agregarError($('#orien'), "Por seleccion la orientacion de la señal");
                valido = false;
            }

            const archivos = $('input[name="imagenSD"]')[0].files;
            if (archivos.length === 0) {
                agregarError($('input[name="imagenSD"]'), "Por favor seleccione una imagen");
                valido = false;
            }

            const tipoDanio = $('#tipoDanio').val().trim();

            if (tipoDanio === '' || tipoDanio === null) {
                agregarError($('#tipoDanio'), "Por favor seleccione un tipo de daño");
                valido = false;
            }

            if (valido) {
                this.submit();
            }

        });

    });
</script>