<div class="container">
    <div class="row align-items-stretch mt-4">
        <div class="col">
            <h2>Info via</h2>
            <!-- AJAX -->
            <div class="row">
                <div class="" id="tipoVia">

                </div>
               
            </div>
        </div>
        <div class="col container-scroll ">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <h3>Información del solicitante</h3>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="" class="form-label">Documento</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="" class="form-label">Telefono</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="" class="form-label">Correo electronico</label>
                            <input type="email" name="" id="" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- Información de la Ubicación del Daño -->
                <h3>Ubicación del Daño</h3>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="tipoVia" class="form-label">Tipo de Vía:</label>
                            <select id="tipoVia" name="tipoVia" required class="form-select">
                                <option value="">Seleccione un tipo de vía</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="numeroVia" class="form-label">Número de la Vía:</label>
                            <input type="text" id="numeroVia" name="numeroVia" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="numeroBis" class="form-label">Número Bis (si aplica):</label>
                            <input type="text" id="numeroBis" name="numeroBis" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="departamento" class="form-label">Departamento:</label>
                            <select id="departamento" name="departamento" class="form-select" required>
                                <option value="">Seleccione un departamento</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="municipio" class="form-label">Municipio:</label>
                            <select id="municipio" name="municipio" required class="form-select">
                                <option value="">Seleccione un municipio</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="localidad" class="form-label">Localidad o Barrio:</label>
                            <select id="localidad" name="localidad" required class="form-select">
                                <option value="">Seleccione una localidad o barrio</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h3>Descripción del Daño</h3>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="tipoDanio" class="form-label">Tipo de Daño:</label>
                        <select id="tipoDanio" name="tipoDanio" required class="form-select">
                            <option value="">Seleccione el tipo de daño</option>
                            <option value="Bache">Bache</option>
                            <option value="Hundimiento">Hundimiento</option>
                            <option value="Grieta">Grieta</option>
                            <option value="Señalización Caída">Señalización Caída</option>
                            <option value="Obstáculo en la Vía">Obstáculo en la Vía</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-2">
                        <label for="" class="form-label">Descripcion de la solicitud</label>
                        <textarea name="" id="" placeholder="Detalle su solicitud...." class="form-control"
                            style="height: 100px;"></textarea>
                    </div>
                </div>
                <h3>Subir Evidencia Fotográfica</h3>
                <label for="foto">Adjuntar Foto (opcional):</label>
                <input type="file" id="" name="" class="form-control mb-2">
                <button type="submit" class="btn btn-success">Enviar</button>

            </form>
        </div>
    </div>
</div>