<div class="container container-scroll">
    <div class="mt 3">
        <h3 class="display-4">Actualizar Usuarios</h3>
    </div>
    <?php
    $rol_final=0;
    foreach ($usuarios as $usu) {
        ?>
        <form action="<?php echo getUrl("Usuarios", "Usuarios", "postUpdate"); ?> " method="post" id="formUpdate">
            <input type="hidden" name="usu_id" value="<?php echo $usu['usu_id']; ?>">
            <div class="row mt-5">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    foreach ($_SESSION['error'] as $error) {
                        echo $error . "<br>";
                    }
                    echo "</div>";
                    unset($_SESSION['error']);
                }
                ?>
                <div class="col-md-6 mt-3">
                    <label for="usu_nombre1">Primer nombre*</label>
                    <input type="text" name="usu_nombre1" id="nombre1" class="form-control" placholder="Nombre"
                        value="<?php echo $usu['usu_nombre1']; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="usu_nombre2">Segundo nombre</label>
                    <input type="text" name="usu_nombre2" id="nombre2" class="form-control" placholder="Nombre"
                        value="<?php echo $usu['usu_nombre2']; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="usu_apellido1">Primer Apellido*</label>
                    <input type="text" name="usu_apellido1" id="apellido1" class="form-control" placholder="Apellido"
                        value="<?php echo $usu['usu_apellido1']; ?>">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="usu_apellido2"> Segundo Apellido</label>
                    <input type="text" name="usu_apellido2" id="apellido2" class="form-control" placholder="Apellido"
                        value="<?php echo $usu['usu_apellido2']; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="doc_id">Tipo de documento*</label>
                    <select name="doc_id" id="doc" class="form-control">
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($docs as $doc) {
                            if ($doc['doc_id'] == $usu['doc_id']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }

                            echo "<option value='" . $doc['doc_id'] . "' $selected>" . $doc['nombre_tipo'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_tel">Documento*</label>
                    <input type="text" name="usu_documento" id="documento" class="form-control" placholder="Documento"
                        value="<?php echo $usu['usu_documento']; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_tel">Telefono*</label>
                    <input type="text" name="usu_tel" id="telefono" class="form-control" placholder="Telefono"
                        value="<?php echo $usu['usu_tel']; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_correo">Correo*</label>
                    <input type="email" name="usu_correo" id="correo" class="form-control" placholder="Correo"
                        value="<?php echo $usu['usu_correo']; ?>">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_clave">Clave</label>
                    <input type="password" name="usu_clave" id="clave" class="form-control" placholder="Clave">
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_clave">Nueva clave (Si desea cambiarla)</label>
                    <input type="password" name="usu_clavenew" id="clavenew" class="form-control" placholder="Clave">
                </div>

                <div class="col-md-4 mt-3">
                    <label for="rol_id">Rol*</label>
                    <?php
                    if ($usu['rol_id'] == 1) {
                        $disabled = "disabled";
                    } else {
                        $disabled = "";
                    }

                    ?>
                    <select name="rol_id" id="rol" class="form-control" <?php echo $disabled; ?>>
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($roles as $rol) {
                            if ($rol['rol_id'] == $usu['rol_id']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }

                            if(!empty($disabled)){
                                $rol_final= 1;
                                echo "<option value='" . $rol_final. "' $selected>" . $rol['rol_nombre'] . "</option>";
                            }else{
                                echo "<option value='" . $rol['rol_id'] . "' $selected>" . $rol['rol_nombre'] . "</option>";
                            }

                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="mt-5">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>

        </form>
    </div>
    <?php
    }
    ?>