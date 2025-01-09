<div class="row mb-3">
    <div class="col-md-4">
        <label for="startDate" class="form-label">Fecha de inicio</label>
        <input type="date" class="form-control" id="fecha1" name="startDate">
    </div>
    <div class="col-md-4">
        <label for="endDate" class="form-label">Fecha de fin</label>
        <input type="date" class="form-control" id="fecha2" name="endDate">
    </div>
    <div class="col-md-2 d-flex align-items-end mt-1">
        <button type="button" class="btn btn-primary" id="consultar"
            data-url="<?= getUrl('Solicitudes', 'Solicitudes', 'filtroFecha', false, 'ajax'); ?>">Buscar</button>
    </div>
</div>
<div class="container-scroll-sols">
    <div class="accordion" id="accordionVias">
        <?php
        if (is_array($vias) && count($vias) > 0) {
            foreach ($vias as $via) {
                $viaId = $via['sol_via_dan_id'];
                echo "<div class='accordion-item'>";
                echo "<h2 class='accordion-header' id='heading$viaId'>";
                echo "<button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$viaId' aria-expanded='false' aria-controls='collapse$viaId'>";
                if ($_SESSION['rol'] == 2) {
                    echo "Via " . " -  " . $via['fecha_hora'] . "&nbsp; <i class='fa-regular fa-calendar'></i>";
                } else {
                    echo "Via ID: " . $via['sol_via_dan_id'] . " - " . $via['fecha_hora'] . "&nbsp; <i class='fa-regular fa-calendar'></i>";
                }
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$viaId' class='accordion-collapse collapse' aria-labelledby='heading$viaId' data-bs-parent='#accordionVias'>";
                echo "<div class='accordion-body'>";
                echo "<p><strong><i class='fas fa-road'></i>Tipo de via:</strong> " . $via['desc_via'] . "</p>";
                echo "<p><strong><i class='fas fa-exclamation-triangle'></i>Tipo de Daño:</strong> " . $via['tipo_danio'] . "</p>";
                if ($_SESSION['rol'] == 2) {
                    echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> Tú </p>";
                } else {
                    echo "<p><strong><i class='fa-solid fa-user'></i> Solicitante:</strong> " . $via['usuario_nombre'] . "</p>";
                }
                if ($_SESSION['rol'] != 2) {
                    echo "<p><strong><i class='fa fa-check-circle'></i> Estado:</strong>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-2'>";

                    echo "<select id='' name='estado' class='form-select estado_solicitud' 
                    data-url='" . getUrl("Solicitudes", "Solicitudes", "updateEstadoVias", false, "ajax") . "' 
                    data-soli='" . $via['sol_via_dan_id'] . "'>";
                    foreach ($estados as $est) {
                        $selected = "";
                        if ($est['est_id'] == $via['est_sol_id']) {
                            $selected = "selected";
                        }
                        echo "<option value='" . $est['est_id'] . "' $selected>" . $est['est_nombre'] . "</option>";
                    }
                    echo "</select>";
                    echo "</div>";
                    echo "</div>";
                    echo "</p>";
                }
                echo "<button class='btn btn-sm btn-outline-secondary btn-detalles' data-id='" . $via['sol_via_dan_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "detallesVia", false, "ajax") . "'>Ver detalles</button>";
                if ($_SESSION['rol'] != 2) {
                    echo "<button class='btn btn-sm btn-outline-secondary btn-cambios-estado' style = 'margin-left: 10px;' data-id='" . $via['sol_via_dan_id'] . "' data-url='" . getUrl("Solicitudes", "Solicitudes", "verAudiVias", false, "ajax") . "'><i class='bi bi-info-circle'></i> Ver cambios de estado</button>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>No hay solicitudes de vias a reparar registradas.</div>";
        }
        ?>
    </div>
</div>
<?php if (is_array($vias) && count($vias) > 0) {
    if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {
        ?>
        <div class="mt-4">
            <a href="<?php echo getUrl('Solicitudes', 'Solicitudes', 'descargarExcel', array('type' => 'xlsx', 'solicitud' => 2), 'ajax'); ?>"
                class="btn btn-secondary" id="descargar">
                <i class="fas fa-file-excel"></i>
                Descargar reporte completo en formato XLSX
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
                    action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'auditoriaVia', false, "ajax") ?>"
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

<div class="modal fade" id="verAudiVias" tabindex="-1" aria-labelledby="verAudiVias" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verAudiVias">Historial de cambios de estado</h5>
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
            var num = 6;

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
                        $('#accordionVias').html(resp);

                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud AJAX:", error);
                    }
                });
            }

        });
        $(document).off('change', '.estado_solicitud'); // Limpia eventos anterior

        //optener el estado actual
        $(document).on('focus', '.estado_solicitud', function () {
            estadoInicial = $(this).val();  // Guarda el estado inicial del select
        });

        $(document).on('change', '.estado_solicitud', function () {
            const solicitudId = $(this).data('soli');
            const estadoFinal = $(this).val();
            $('#auditoriaSolicitudId').val(solicitudId);
            $('#estado2').val(estadoFinal);
            $('#estado1').val(estadoInicial);
            $('#auditoriaModal').modal('show');
        });


        $(document).on('submit', '#auditoriaForm', function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                success: function (resp) {
                    console.log("Respuesta del servidor:", resp.trim());
                    if (resp.trim() === "Se realizo el cambio de estado de la solicitud con exito") {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Se realizó el cambio de estado de la solicitud con éxito',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            $('#auditoriaModal').modal('hide');
                            $('#auditoriaForm')[0].reset();

                            $('#auditoriaSolicitudId').val('');
                            $('#estado1').val('');
                            $('#estado2').val('');
                        });
                    } else if (resp.trim() === "Error al cambio de estado") {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo realizar el cambio de estado',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Ocurrió un error al realizar la solicitud.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });

        $(document).on('click', '.btn-cambios-estado', function () {
            const solicitudId = $(this).data('id');
            const url = $(this).data('url');

            $('#verAudiVias.modal-body').html('<p>Cargando...</p>');

            $.ajax({
                url: url,
                type: "POST",
                data: { solicitudId: solicitudId },
                success: function (response) {
                    $('#verAudiVias .modal-body').html(response);

                    $('#verAudiVias').modal('show');
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



        $('#cerrar_modal').click(function (event) {
            Swal.fire({
                title: 'Se canceló el cambio de estado!',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            $('.estado_solicitud').val(estadoInicial).change();  // Restaurar el valor inicial
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