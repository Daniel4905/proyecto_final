<div class="container">
    <h3>Filtre segun la solicitud que desee</h3>
    <form>
        <div class="col-md-4 mb-3">
            <label for="tipo-solicitud" class="form-label">Escoja el tipo de solicitud:</label>
            <select class="form-select" id="tipo_solicitud" name="tipoSolicitud"
                data-url='<?php echo getUrl("Solicitudes", "Solicitudes", "getSolEscogida", false, "ajax") ?>'>
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Reporte de accidentes</option>
                <option value="2">Reporte de señalización vial - Nuevo</option>
                <option value="3">Reporte de señalización vial - Reparación</option>
                <option value="4">Reporte de reductores - Reparación</option>
                <option value="5">Reporte de reductores - Nuevo</option>
                <option value="6">Reporte de daños en la via</option>
            </select>
        </div>
    </form>
    <div class="container-scroll">
        <div id="div_dinamico">

        </div>
    </div>
</div>