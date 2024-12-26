<div class="modal fade" id="modalSolicitud" tabindex="-1" aria-labelledby="modalSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitudLabel">Formulario de Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form>
                        <div class="col-md-8 mb-3">
                            <label for="tipo-solicitud" class="form-label">Escoja el tipo de solicitud:</label>
                            <select class="form-select" id="tipo-solicitud" name="tipoSolicitud"
                                data-url='<?php echo getUrl("Solicitudes", "Solicitudes", "getSolicitudEscogida", false, "ajax") ?>'>
                                <option value="" selected>Seleccione una opción</option>
                                <option value="1">Reportar accidente</option>
                                <option value="2">Señalización vial - Nuevo</option>
                                <option value="3">Señalización vial - Reparación</option>
                                <option value="4">Reductores - Reparación</option>
                                <option value="5">Reductores - Nuevo</option>
                                <option value="6">Reportar daño en la via</option>
                            </select>
                            <input type="hidden" name="punto1" id="punto1">
                            <input type="hidden" name="punto2" id="punto2">
                        </div>
                    </form>
                </div>
                <div id="form-dinamico"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>