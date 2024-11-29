<form>
    <div class="col-md-4 mb-3">
        <label for="tipo-solicitud" class="form-label">Escoja el tipo de solicitud:</label>
        <select class="form-select" id="tipo-solicitud" name="tipoSolicitud" data-url='<?php echo getUrl("Solicitudes", "Solicitudes", "getSolicitudEscogida", false, "ajax") ?>'>
            <option value="" selected>Seleccione una opción</option>
            <option value="1">Reportar accidente</option>
            <option value="2">Señalización vial - Nuevo</option>
            <option value="3">Señalización vial - Reparación</option>
            <option value="4">Reductores - Nuevo</option>
            <option value="5">Reductores - Reparación</option>
            <option value="6">Reportar daño en la via</option>
        </select>
    </div>
</form> 
<div id="form-dinamico">

</div>