<div class="container">
<div class="mt-3">
    <h3 class="display-4">
        Consultar Usuarios
    </h3>
</div>
</div>
<div class="container container-scroll">
    <div class="row">
        <div class="col-md-3">
            <input type="text" name="buscar" placeholder="Buscar por nombre o por documento" id="buscar"
                class="form-control mt-3 mb-3"
                data-url='<?php echo getUrl("Usuarios", "Usuarios", "buscar", false, "ajax") ?>'>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Editar</th>
                </thead>
                <tbody>

                    <?php
                    foreach ($usuario as $usu) {
                        $clase = "";
                        $text = "";
                        $disabled = "";
                        echo "<tr>";
                        echo "<td>" . $usu['doc_abrev'] . ' ' . $usu['usu_documento'] . "</td>";
                        echo "<td>" . $usu['usu_nombre1'] . " " . $usu['usu_nombre2'] . "</td>";
                        echo "<td>" . $usu['usu_apellido1'] . " " . $usu['usu_apellido2'] . "</td>";
                        echo "<td>" . $usu['usu_correo'] . "</td>";
                        echo "<td>" . $usu['usu_tel'] . "</td>";
                        echo "<td>" . $usu['usu_direccion'] . "</td>";
                        echo "<td>" . $usu['rol_nombre'] . "</td>";
                        if ($_SESSION['id'] == $usu['usu_id'] || stristr($usu['rol_nombre'], "Admin")) {
                            $disabled = "disabled";
                        } else {
                            $disabled = "";
                        }

                        if ($usu['est_id'] == 1) {
                            $class = "btn btn-danger";
                            $text = "Inhabilitar";
                        } else if ($usu['est_id'] == 2) {
                            $class = "btn btn-success";
                            $text = "Habilitar";
                        }
                        echo "<td>";
                        if (!empty($class))
                            echo "<button class='" . $class . "' id='cambiar_estado' data-url='" . getUrl("Usuarios", "Usuarios", "postUpdateStatus", false, "ajax") . "' data-id = '" . $usu['est_id'] . "' data-user='" . $usu['usu_id'] . "' $disabled>" . $text . "</button>" .
                                "</td>";
                        echo "<td>" .
                            "<a href='" . getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu['usu_id'])) . "'>" .
                            "<button class='btn btn-primary'>Editar" .
                            "</button>" .
                            "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>


                </tbody>
            </table>
            <div id="datError" class='alert alert-danger d-none' role='alert'>
                No se encontraron resultados en la busqueda
            </div>
        </div>
    </div>
</div>
