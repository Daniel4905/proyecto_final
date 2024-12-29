<form action="<?php echo getUrl('Acceso', 'Acceso', 'restContra', false, "ajax"); ?>" method="POST" class="myform"
    id="restContra">
    <h3 class="form-label">Para recuperar su contraseña ingrese los siguientes campos: </h3>
    <div class="form-group">
        <label for="numeroId" class="form-label">Número de Identificación:</label>
        <input type="text" id="numeroId" name="numeroId" class="form-control">
    </div>

    <div class="form-group">
        <label for="correo" class="form-label">Correo electronico</label>
        <input type="text" id="correoRest" name="correoRest" class="form-control">
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary" id="enviarCor">Enviar correo electronico</button>
    </div>
    <div class="enviar p-4">
        <div class="mt-2">
            <span id="pregunta">¿Ya tienes cuenta? <a href="index.php" id="link">Ingresar</a></span>
        </div>
    </div>
</form>