<div class="dropdown pqrs-btn dropup">
    <button class="btn rounded-circle dropdown-toggle" type="button" id="pqrsDropdown" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" style="background-color: #6f42c1; color: white;">
        <i class="fas fa-question"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="pqrsDropdown">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#pqrsModal"
                data-bs-id="1">Petición</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#pqrsModal"
                data-bs-id="2">Queja</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#pqrsModal"
                data-bs-id="3">Reclamo</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#pqrsModal"
                data-bs-id="4">Sugerencia</a></li>
    </ul>
</div>
<div class="modal fade" id="pqrsModal" tabindex="-1" aria-labelledby="pqrsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pqrsModalLabel">Formulario de PQRS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo getUrl('PQRS', 'PQRS', 'postCreate'); ?>" method="post">
                    <input type="hidden" id="pqrsId" name="pqrsId">
                    <input type="hidden" name="usu_id" id="usu_id" value="<?php echo $_SESSION['id']; ?>">

                    <div class="mb-3">
                        <label for="pqrsTextarea" class="form-label">Escribe tu mensaje (Petición, Queja, Reclamo o
                            Sugerencia)</label>
                        <textarea class="form-control" id="pqrsTextarea" rows="4" placeholder="Escribe aquí..."
                            name="texto"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>