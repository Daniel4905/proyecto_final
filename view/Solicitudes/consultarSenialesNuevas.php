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
    <div class="accordion" id="accordionSeniales">
        <?php
        if (is_array($senial) && count($senial) > 0) {
            foreach ($senial as $sen) {
                $senId = $sen['sol_sen_new_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$senId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$senId' aria-expanded='false' aria-controls='collapse$senId'>";
                echo "Señal - nueva &nbsp; - &nbsp;" . $sen['sol_sen_new_fecha'] . " &nbsp; <i class='fa-regular fa-calendar'></i>";
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$senId' class='accordion-collapse collapse' aria-labelledby='heading$senId' data-bs-parent='#accordionSeniales'>";
                echo "<div class='accordion-body'>";
                echo "<p><strong><i class='fa fa-traffic-light'></i> Tipo de Señal:</strong> " . $sen['senal'] . "</p>";
                echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $sen['usuario_nombre'] . "</p>";
                if ($_SESSION['rol'] != 2) {
                    echo "<p><strong><i class='fa fa-check-circle'></i> Estado:</strong>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-2'>";
                    echo "<select id='estado_solicitud' class='form-select estado_solicitud' 
                                                data-soli='" . $sen['sol_sen_new_id'] . "'>";
                    foreach ($estados as $est) {
                        $selected = "";
                        if ($est['est_id'] == $sen['est_sol_id']) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";
                    echo "</p>";
                }
                echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $sen['sol_sen_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesSenNew", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver detalles</button>";
                if ($_SESSION['rol'] != 2) {
                    echo "<button class='btn btn-sm btn-outline-secondary btn-cambios-estado' style = 'margin-left: 10px;' data-id='" . $sen['sol_sen_new_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "verAudiSenNew", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver cambios de estado</button>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>No hay solicitudes de señales nuevas registradas.</div>";
        }
        ?>
    </div>
    <div id="datError" class="alert alert-danger d-none" role="alert">
        No se encontraron resultados en la búsqueda.
    </div>
</div>
<?php
if (is_array($senial) && count($senial) > 0) {
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {

        ?>
        <div class="mt-4">
            <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 3), 'ajax'); ?>"
                class="btn btn-secondary" id="descargar">
                <i class="fas fa-file-excel"></i>
                Descargar reporte formato XLSX
            </a>
        </div>
        <?php
    }
}
?>
<div class="modal fade" id="auditoriaModal" tabindex="-1" aria-labelledby="auditoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="auditoriaModalLabel">Registrar Auditoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="auditoriaForm"
                    action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'auditoriaSenNew', false, "ajax") ?>"
                    method="POST">
                    <input type="hidden" id="auditoriaSolicitudId" name="solicitudId">
                    <div class="mb-3 d-none">
                        <label for="estado1" class="form-label">Estado Anterior</label>
                        <input type="text" class="form-control" id="estado1" name="id_estado1" value="" readonly>
                    </div>
                    <div class="mb-3 d-none">
                        <label for="estado2" class="form-label">Nuevo Estado</label>
                        <input type="text" class="form-control" id="estado2" value="" name="id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="auditoriaDescripcion" class="form-label">Descripción del cambio</label>
                        <textarea class="form-control" id="auditoriaDescripcion" name="descripcion" rows="3"
                            required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cerrar_modal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="guardarAuditoria">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles de la solicitud</h5>
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


<div class="modal fade" id="verAudiSenNew" tabindex="-1" aria-labelledby="verAudiSenNew" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verAudiSenNew">Historial de cambios de estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="contenidoDetalles" style="max-height: 600px; overflow-y: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-cambios-estado', function () {
            const solicitudId = $(this).data('id');
            const url = $(this).data('url');

            $('#verAudiSenNew .modal-body').html('<p>Cargando...</p>');

            $.ajax({
                url: url,
                type: "POST",
                data: { solicitudId: solicitudId },
                success: function (response) {
                    $('#verAudiSenNew .modal-body').html(response);

                    $('#verAudiSenNew').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error("Error al cargar los cambios de estado:", error);
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudieron cargar los cambios de estado. Intenta de nuevo más tarde.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });


        $('#consultar').click(function (event) {
            var fecha1 = $('#fecha1').val();
            var fecha2 = $('#fecha2').val();
            var num = 2;

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
                        $('#accordionSeniales').html(resp);

                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud AJAX:", error);
                    }
                });
            }

        });
        });

    $(document).ready(function () {
        $('#descargar').click(function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: "POST",
                success: function (resp) {
                    if (resp.trim() === "No se encontraron datos para generar el archivo Excel.") {
                        Swal.fire({
                            title: 'Error!',
                            text: 'No se encontraron datos para generar el archivo Excel',
                            icon: 'error',
                            confirmButtonText: 'Intentar de nuevo'
                        });
                    } else {
                        window.location.href = url;
                    }

                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        });
    });
</script>