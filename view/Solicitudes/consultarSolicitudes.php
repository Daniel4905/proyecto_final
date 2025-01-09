<?php
$actualiza = "";
$error = "";

if (isset($_SESSION['auditoria'])) {
    $actualiza = $_SESSION['auditoria'];
    unset($_SESSION['auditoria']); // Limpia los errores después de mostrarlos
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Limpia los errores después de mostrarlos
}
?>

<div class="">
    <h3>Filtre segun la solicitud que desee</h3>
    <form>
        <div class="col-md-3 mb-3">
            <label for="tipo-solicitud" class="form-label">Escoja el tipo de solicitud:</label>
            <select class="form-select" id="tipo_solicitud" name="tipoSolicitud"
                data-url='<?php echo getUrl("Solicitudes", "Solicitudes", "getSolEscogida", false, "ajax") ?>' data-rol = '<?php echo $_SESSION['rol'];?>' data-id='<?php echo $_SESSION['id'];?>'>
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

<script>
        $(document).ready(function () {
            // Mostrar SweetAlert si existe la variable de error
            <?php if (!empty($actualiza)) { ?>
                Swal.fire({
                    title: 'Cambio de estado exitoso! ',
                    html: `<?php echo($actualiza); ?>`,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            <?php } else if (!empty($error)) { ?>
                Swal.fire({
                    title: 'Error al cambiar estado ',
                    html: `<?php echo($error); ?>`,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            <?php } ?>
        });

</script>