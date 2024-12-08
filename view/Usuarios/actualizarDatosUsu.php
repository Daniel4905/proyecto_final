<div class="container">
    <?php
    if (isset($_SESSION['mensaje_exito'])) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '" . $_SESSION['mensaje_exito'] . "',
                    confirmButtonText: 'Ok'
                });
            });
        </script>";
        unset($_SESSION['mensaje_exito']);
    }
    ?>
    <div class="mt 3">
        <h3 class="display-4">Actuliza tus datos <?php echo $_SESSION['nombre']; ?></h3>
    </div>
</div>
<div class="container container-scroll">
    <?php
    foreach ($usuarios as $usu) {
        ?>
        <form action="<?php echo getUrl("Usuarios", "Usuarios", "postUpdateUsu"); ?> " method="post" id="formUpdateUsu">
            <div class="row mt-5">
                <?php
                // if (isset($_SESSION['errores'])) {
                //     echo "<script>
                //         document.addEventListener('DOMContentLoaded', function () {
                //             Swal.fire({
                //                 icon: 'error',
                //                 title: 'Errores detectados',
                //                 html: '" . implode("<br>", $_SESSION['errores']) . "',
                //                 confirmButtonText: 'Ok'
                //             });
                //         });
                //     </script>";
                //     unset($_SESSION['errores']);
                // }

                ?>
                <div class="col-md-3">
                    <label for="usu_nombre1">Primer nombre*</label>
                    <input type="text" name="usu_nombre1" id="nombre1" class="form-control validar-nombre"
                        placeholder="Primer nombre" value="<?php echo $usu['usu_nombre1']; ?>">
                </div>
                <div class="col-md-3">
                    <label for="usu_nombre2">Segundo nombre </label>
                    <input type="text" name="usu_nombre2" id="nombre2" class="form-control validar-nombre"
                        placeholder="Segundo nombre" value="<?php echo $usu['usu_nombre2']; ?>">
                </div>
                <div class="col-md-3">
                    <label for="usu_apellido1">Primer Apellido*</label>
                    <input type="text" name="usu_apellido1" id="apellido1" class="form-control validar-nombre"
                        placeholder="Primer apellido" value="<?php echo $usu['usu_apellido1']; ?>">
                </div>
                <div class="col-md-3">
                    <label for="usu_apellido2"> Segundo Apellido</label>
                    <input type="text" name="usu_apellido2" id="apellido2" class="form-control validar-nombre"
                        placeholder="Segundo apellido" value="<?php echo $usu['usu_apellido2']; ?>">
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
                <div class="col-md-2 mt-3">
                    <label for="usu_tel">Nro Documento*</label>
                    <input type="text" name="usu_documento" id="documento" class="form-control validar-num"
                        placeholder="Documento" value="<?php echo $usu['usu_documento']; ?>">
                </div>
                <div class="col-md-2 mt-3">
                    <label for="sex_id">Sexo biologico*</label>
                    <select id="sexo" name="sex_id" class="form-control">
                        <option value="">Seleccione...</option>
                        <?php
                        foreach ($sexo as $sex) {
                            if ($sex['sex_id'] == $usu['sex_id']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value ='" . $sex['sex_id'] . "'$selected>" . $sex['sex_desc'] . "</option>";
                        }
                        ?>

                    </select>
                </div>
                <div class="col-md-4 mt-3">
                    <label for="usu_tel">Telefono*</label>
                    <input type="text" name="usu_tel" id="telefono" class="form-control validar-num" placeholder="Telefono"
                        value="<?php echo $usu['usu_tel']; ?>">
                </div>
                <div class="col-md-12 mt-3">
                    <small class="form-text text-muted">Direccion actual : <?php echo $usu['usu_direccion']; ?>
                    </small><br>
                    <input type="checkbox" name="cambiarDir" id="cambiarDir">
                    <label for="cambiarDir">Actualizar direccion</label>
                </div>

                <div class="row d-none" id="direccionDiv">

                    <div class="col-md-3 mt-3">
                        <label for="tipoVia">Tipo de vía*</label>
                        <select id="tipoVia" name="tipoVia" class="form-control">
                            <option value="">Seleccione...</option>
                            <option value="Calle">Calle</option>
                            <option value="Carrera">Carrera</option>
                            <option value="Avenida">Avenida</option>
                            <option value="Transversal">Transversal</option>
                            <option value="Diagonal">Diagonal</option>
                        </select>
                        <small class="form-text text-muted">Ejemplo: Calle</small>
                    </div>



                    <div class="col-md-2 mt-3">
                        <label for="numeroPrincipal">Número principal*</label>
                        <input type="number" id="numeroPrincipal" name="numeroPrincipal" class="form-control"
                            placeholder="26" min="1" max="300">
                        <small class="form-text text-muted">Ejemplo: 23</small>
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento" name="complemento1" class="form-control" placeholder="J"
                            maxlength="3">
                        <small class="form-text text-muted">Opcional. Ejemplo: J</small>
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="numeroSecundario">Numero 1</label>
                        <input type="number" id="numeroSecundario" name="numeroSecundario" class="form-control"
                            placeholder="" min="1" max="300">
                        <small class="form-text text-muted">Ejemplo: 10</small>
                    </div>

                    <div class="col-md-1 mt-3">
                        <label for="complemento">Complemento</label>
                        <input type="text" id="complemento2" name="complemento2" class="form-control"
                            placeholder="Bis/A/Sur">
                        <small class="form-text text-muted">Opcional. Ejemplo: Bis</small>
                    </div>
                    <div class="col-md-1 mt-3">
                        <label for="numeroTerciario">Numero 2</label>
                        <input type="number" id="numeroTerciario" name="numeroTerciario" class="form-control" placeholder=""
                            min="1" max="300">
                        <small class="form-text text-muted">Ejemplo: 10</small>
                    </div>

                    <div class="col-md-3 mt-3">
                        <label for="referencias">Referencias adicionales</label>
                        <textarea id="referencias" name="referencias" class="form-control" rows="2" maxlength="100"
                            placeholder="Frente al parque o cerca del supermercado"></textarea>
                        <small class="form-text text-muted">Opcional. Máximo 100 caracteres.</small>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <label for="usu_correo">Correo*</label>
                    <input type="text" name="usu_correo" id="correo" class="form-control" placeholder="usuario@dominio.com"
                        value="<?php echo $usu['usu_correo']; ?>">
                </div>
                <div class="col-md-3 mt-2">
                    <label for="usu_claveAnt">Contraseña</label>
                    <input type="password" name="usu_clave" id="clave" class="form-control claves" placholder="Clave"
                        data-id="<?php echo $_SESSION['id']; ?>"
                        data-url="<?php echo getUrl('Usuarios', 'Usuarios', "ValidarCont", false, "ajax"); ?>">
                    <small class="form-text text-muted">Para actualizar sus datos debe igresar su contraseña.</small>
                </div>
                <div class="col-md-12 mt-2">

                    <input type="checkbox" name="cambiarCont" id="cambiarCont">
                    <label for="cambiarCont">Cambiar contraseña</label>
                </div>
                <div class="row col-md-7 mt-2 d-none" id="divContra">
                    <div class="col-md-6 mt-2">
                        <label for="usu_clave">Clave nueva</label>
                        <input type="password" name="usu_clavenew" id="clavenewUp" class="form-control claves"
                            placholder="Clave">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="usu_clave">Confirmar clave nueva*</label>
                        <input type="password" name="usu_clavenewConf" id="clavenewConf" class="form-control claves"
                            placholder="Clave">
                    </div>
                </div>

                <div class="mt-3">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    ?>

