<div class="container">
    <div class="row align-items-stretch mt-4">
        <div class="col">
            <h2>Info reductor seleccionado</h2>
            <!-- AJAX -->
            <div class="row">
                <div class="" id="tipoReductor">

                </div>
                <div id="reductor">

                </div>
            </div>
        </div>

        <div class="col container-scroll ">
            
        
            <form id="formReductores" action="">
                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="" class="form-label">Categoria</label>
                            <select name="" id="" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label for="" class="form-label">Reductor</label>
                            <select name="" id="" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="" id="imagenSenal">
                    <!-- Reporte de daño se crea el input para la imagen -->
                    <!-- AJAX -->
                    <label for="" class="form-label">Adjunte la foto</label>
                    <input type="file" name="" id="" class="form-control mb-2 ">
                </div>

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

                <h3>Ubicacion</h3>
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
                <div class="row">
                    <div class="mb-2">
                        <label for="" class="form-label">Descripcion de la solicitud</label>
                        <textarea name="" id="" placeholder="Detalle su solicitud...." class="form-control"
                            style="height: 100px;"></textarea>
                    </div>
                </div>

                <div class="mt-2 col-md-4">
                    <input type="submit" value="Enviar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>