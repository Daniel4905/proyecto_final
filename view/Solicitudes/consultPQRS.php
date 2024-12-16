<div class="container container-scroll">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Tipo pqrs</th>
                    <th>Descripcion</th>
                    <th>Solicitante</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($pqrs) && is_array($pqrs) && count($pqrs) > 0) {
                        foreach ($pqrs as $pq) {
                            echo "<tr>";
                            echo "<td>" . $pq['id_pqrs'] . "</td>";
                            echo "<td>" . $pq['desc_tipo_pqrs'] . "</td>";
                            echo "<td>" . $pq['desc_pqrs'] . "</td>";
                            echo "<td>" . $pq['usuario_nombre'] . "</td>";

                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td colspan='8' class='text-center text-danger'>No hay ninguna pqrs registrada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div id="datError" class='alert alert-danger d-none' role='alert'>
                No se encontraron resultados en la búsqueda.
            </div>
        </div>
    </div>
</div>