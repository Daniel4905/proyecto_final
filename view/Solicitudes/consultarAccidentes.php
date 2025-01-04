<div class="row mb-3">
    <div class="col-md-4">
        <label for="startDate" class="form-label">Fecha de inicio</label>
        <input type="date" class="form-control" id="fecha1" name="startDate">
    </div>
    <div class="col-md-4">
        <label for="endDate" class="form-label">Fecha de fin</label>
        <input type="date" class="form-control" id="fecha2" name="endDate">
    </div>
    <div class="col-md-4 d-flex align-items-end mt-1">
        <button type="button" class="btn btn-primary" id="consultar"
            data-url="<?= getUrl('Solicitudes', 'Solicitudes', 'filtroFecha', false, 'ajax'); ?>">Buscar</button>
    </div>
</div>
<div class="container-scroll-sols">
    <div class="accordion" id="accordionAccidentes">
        <?php
        if (is_array($accidentes) && count($accidentes) > 0) {
            foreach ($accidentes as $acc) {
                $accId = $acc['reg_acc_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$accId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$accId' aria-expanded='false' aria-controls='collapse$accId'>";
                if ($_SESSION['rol'] == 2) {
                    echo "Accidente  &nbsp; - &nbsp;" . $acc['reg_acc_fecha_hora'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
                } else {
                    echo "Accidente ID: " . $acc['reg_acc_id'] . " &nbsp; - &nbsp;" . $acc['reg_acc_fecha_hora'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
                }
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$accId' class='accordion-collapse collapse' aria-labelledby='heading$accId' data-bs-parent='#accordionAccidentes'>";
                echo "<div class='accordion-body'>";
                echo "<p><strong><i class='fa fa-car-crash'></i> Tipo:</strong> " . $acc['tipo_choque'] . " - " . $acc['detalles_accidente'] . "</p>";
                echo "<p><strong><i class='fa fa-user-injured'></i> Lesionados:</strong> " . ($acc['reg_acc_lesionados'] === 't' ? "Sí" : "No") . "</p>";
                if ($_SESSION['rol'] == 2) {
                    echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> Tú </p>";
                } else {
                    echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $acc['usuario_nombre'] . "</p>";
                }
                echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $acc['reg_acc_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesAccidente", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver detalles</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>No hay accidentes registrados.</div>";
        }
        ?>
    </div>
</div>
<?php
if (is_array($accidentes) && count($accidentes) > 0) {
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {

        ?>
        <div class="mt-4">
            <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 1), 'ajax'); ?>"
                class="btn btn-secondary">
                <i class="fas fa-file-excel"></i>
                Descargar reporte formato XLSX
            </a>
        </div>
        <?php
    }
}
?>
<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles del accidente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#consultar').click(function (event) {
            var fecha1 = $('#fecha1').val();
            var fecha2 = $('#fecha2').val();
            var num = 1;

            if (fecha1 === "" || fecha2 === "") {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ninguna de las dos fechas pueden estar vacias",
                    confirmButtonText: 'Ok'
                });
            } else {
                let url = $(this).attr('data-url');
                $.ajax({
                    url: url,
                    data: "fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&num=" + num,
                    type: "POST",
                    success: function (resp) {
                        $('#accordionAccidentes').html(resp);

                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud AJAX:", error);
                    }
                });
            }

        })
    });
</script>