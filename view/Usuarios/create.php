<div class="container">
    <div class="mt 3">
        <h3 class="display-4">Registrar Usuarios</h3>
    </div>
</div>
<div class="container container-scroll">

    <form action="<?php echo getUrl("Usuarios", "Usuarios", "postCreate"); ?> " method="post" id="formRegistro">
        <div class="row mt-5">
            <div class='alert alert-danger d-none' role='alert' id="error">

            </div>
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

            <div class="col-md-3">
                <label for="usu_nombre1">Primer nombre*</label>
                <input type="text" name="usu_nombre1" id="nombre1" class="form-control validar-nombre"
                    placeholder="Primer nombre">
            </div>
            <div class="col-md-3">
                <label for="usu_nombre2">Segundo nombre </label>
                <input type="text" name="usu_nombre2" id="nombre2" class="form-control validar-nombre"
                    placeholder="Segundo nombre">
            </div>
            <div class="col-md-3">
                <label for="usu_apellido1">Primer Apellido*</label>
                <input type="text" name="usu_apellido1" id="apellido1" class="form-control validar-nombre"
                    placeholder="Primer apellido">
            </div>
            <div class="col-md-3">
                <label for="usu_apellido2"> Segundo Apellido</label>
                <input type="text" name="usu_apellido2" id="apellido2" class="form-control validar-nombre"
                    placeholder="Segundo apellido">
            </div>
            <div class="col-md-4 mt-3 ">
                <label for="doc_id">Tipo de documento*</label>
                <select name="doc_id" id="doc" class="form-control">
                    <option value="">Seleccione...</option>
                    <?php
                    foreach ($docs as $doc) {
                        echo "<option value ='" . $doc['doc_id'] . "'>" . $doc['nombre_tipo'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2 mt-3">
                <label for="usu_tel">Nro Documento*</label>
                <input type="text" name="usu_documento" id="documento" class="form-control validar-num"
                    placeholder="Documento">
            </div>
            <div class="col-md-2 mt-3">
                <label for="sex_id">Sexo biologico*</label>
                <select id="sexo" name="sex_id" class="form-control">
                    <option value="">Seleccione...</option>
                    <?php
                    foreach ($sexo as $sex) {
                        echo "<option value ='" . $sex['sex_id'] . "'>" . $sex['sex_desc'] . "</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="col-md-4 mt-3">
                <label for="usu_tel">Telefono*</label>
                <input type="text" name="usu_tel" id="telefono" class="form-control validar-num" placeholder="Telefono">
            </div>

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
                <input type="number" id="numeroPrincipal" name="numeroPrincipal" class="form-control" placeholder="26"
                    min="1" max="300" required>
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
                <input type="number" id="numeroSecundario" name="numeroSecundario" class="form-control" placeholder=""
                    min="1" max="300" required>
                <small class="form-text text-muted">Ejemplo: 10</small>
            </div>

            <div class="col-md-1 mt-3">
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento2" class="form-control" placeholder="Bis/A/Sur">
                <small class="form-text text-muted">Opcional. Ejemplo: Bis</small>
            </div>
            <div class="col-md-1 mt-3">
                <label for="numeroSecundario">Numero 2</label>
                <input type="number" id="numeroTerciario" name="numeroTerciario" class="form-control" placeholder=""
                    min="1" max="300" required>
                <small class="form-text text-muted">Ejemplo: 10</small>
            </div>

            <div class="col-md-3 mt-3">
                <label for="referencias">Referencias adicionales</label>
                <textarea id="referencias" name="referencias" class="form-control" rows="2" maxlength="100"
                    placeholder="Frente al parque o cerca del supermercado"></textarea>
                <small class="form-text text-muted">Opcional. Máximo 100 caracteres.</small>
            </div>
            <div class="col-md-3 mt-3">
                <label for="usu_correo">Correo*</label>
                <input type="text" name="usu_correo" id="correo" class="form-control" placeholder="usuario@dominio.com">
            </div>
            <div class="col-md-3 mt-3">
                <label for="rol_id">Rol*</label>
                <select name="rol_id" id="rol" class="form-control">
                    <option value="">Seleccione...</option>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<option value ='" . $rol['rol_id'] . "'>" . $rol['rol_nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mt-2">
                <label for="usu_clave">Clave*</label>
                <input type="password" name="usu_clave" id="clave" class="form-control claves" placholder="Clave">
            </div>
            <div class="col-md-3 mt-2">
                <label for="usu_clave">Confirmar clave*</label>
                <input type="password" name="usu_clavenew" id="clavenew" class="form-control claves" placholder="Clave">
            </div>
            <div class="mt-3">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        </div>
    </form>
</div>