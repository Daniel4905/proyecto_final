<div class="pqrs-btn" id="pqrs-specific">
    <button class="btn redN" type="button" id="pqrsDropdown" 
        aria-haspopup="true" aria-expanded="false" 
        style="background-color: #202434; color: #c2bfbf; size: 50px;" 
        title="Haga sus peticiones, quejas, reclamos y sugerencias">
        <i class="fa-solid fa-comment"></i>
    </button>
    <div class="dropdown-menu">
        <a href="<?php echo getUrl('PQRS', 'PQRS', 'getPQRS'); ?>" class="dropdown-item">Ver mis PQRS</a>
        <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#pqrsModal">Enviar PQRS</a>
    </div>
</div>

<div class="modal fade" id="pqrsModal" tabindex="-1" aria-labelledby="pqrsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pqrsModalLabel">Formulario de PQRS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo getUrl('PQRS', 'PQRS', 'postCreate'); ?>" method="post" id="formPQRS">

                    <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $_SESSION['id']; ?>">

                    <div class="col-md-3">
                        <label for="pqrsId" class="form-label">Seleccione el tipo de PQRS:</label>
                        <select id="pqrsId" name="pqrsId" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="1">Petición</option>
                            <option value="2">Queja</option>
                            <option value="3">Reclamo</option>
                            <option value="4">Sugerencia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pqrsTextarea" class="form-label">Escribe tu mensaje (Petición, Queja, Reclamo o
                            Sugerencia)</label>
                        <textarea class="form-control" id="observaciones" rows="4" placeholder="Escribe aquí..."
                            name="texto"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/validacionesPQRS.js"></script>

