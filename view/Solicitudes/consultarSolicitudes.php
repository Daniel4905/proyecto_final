<div class="">
    <h3>Aquí puedes consultar todo sobre las solicitudes</h3>
    <p>Utiliza el selector para filtrar el tipo de reporte que deseas consultar.</p>
    <form>
        <div class="col-md-3 mb-3">
            <label for="tipo-solicitud" class="form-label">Escoja el tipo de solicitud:</label>
            <select class="form-select" id="tipo_solicitud" name="tipoSolicitud"
                data-url='<?php echo getUrl("Solicitudes", "Solicitudes", "getSolEscogida", false, "ajax") ?>' data-rol = '<?php echo $_SESSION['rol'];?>' data-id='<?php echo $_SESSION['id'];?>'>
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Reporte de accidentes</option>
                <option value="2">Reporte de señalización vial - Nuevo</option>
                <option value="3">Reporte de señalización vial - Reparación</option>
                <option value="4">Reporte de reductores de velocidad - Reparación</option>
                <option value="5">Reporte de reductores de velocidad - Nuevo</option>
                <option value="6">Reporte de daños en la via</option>
            </select>
        </div>
    </form>
    <div class="container-scroll">
        <div id="div_dinamico">

        </div>
    </div>
</div>
