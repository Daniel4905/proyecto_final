
<style>
    .image-upload {
        width: 150px;
        height: 150px;
        border: 2px dashed #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .image-upload input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .image-upload img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .placeholder {
        font-size: 24px;
        color: #aaa;
    }
</style>
<div class="container">
    <div class="container-scroll">
        <h3>Detalle el accidente</h3>
        <form action="" id="formAccidentes">
            <div class="row">
                <div class="col-md-3">
                    <label for="tipoChoque" class="form-label">Tipo de choque:</label>
                    <select id="tipoChoque" name="tipoChoque" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="vehiculos">Colisión entre vehículos</option>
                        <option value="objeto">Colisión con objeto fijo</option>
                        <option value="peaton">Atropello (peatón)</option>
                        <option value="animal">Atropello (animal)</option>
                        <option value="volcamiento">Volcamiento</option>
                        <option value="otro">Otro</option>
                    </select>
                    <small class="form-text text-muted">Seleccione un tipo</small>
                </div>
                <div class="col-md-2">
                    <label for="tipoChoque" class="form-label">Otro</label>
                    <input type="text" id="otroTipoChoque" name="otroTipoChoque" placeholder="Especifique otro tipo"
                        class="form-control">
                    <small class="form-text text-muted">Escriba el otro tipo</small>
                </div>
                <div class="col-md-1">
                    <label for="Lesionados" class="form-label">Lesionados:</label>
                    <input type="number" id="lesionados" name="lesionados" min="0" class="form-control" placeholder="#">
                    <small class="form-text text-muted"># Lesionados</small>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Vehículos involucrados:</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo1" name="vehiculos[]" value="Automóvil"
                                    class="form-check-input">
                                <label for="vehiculo1" class="form-check-label">Automóvil</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo2" name="vehiculos[]" value="Bus"
                                    class="form-check-input">
                                <label for="vehiculo2" class="form-check-label">Bus</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo3" name="vehiculos[]" value="Buseta"
                                    class="form-check-input">
                                <label for="vehiculo3" class="form-check-label">Buseta</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo4" name="vehiculos[]" value="Camión"
                                    class="form-check-input">
                                <label for="vehiculo4" class="form-check-label">Camión</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo5" name="vehiculos[]" value="Camioneta"
                                    class="form-check-input">
                                <label for="vehiculo5" class="form-check-label">Camioneta</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo6" name="vehiculos[]" value="Microbús"
                                    class="form-check-input">
                                <label for="vehiculo6" class="form-check-label">Microbús</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo7" name="vehiculos[]" value="Tractocamión"
                                    class="form-check-input">
                                <label for="vehiculo7" class="form-check-label">Tractocamión</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo8" name="vehiculos[]" value="Volqueta"
                                    class="form-check-input">
                                <label for="vehiculo8" class="form-check-label">Volqueta</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo9" name="vehiculos[]" value="Motocicleta"
                                    class="form-check-input">
                                <label for="vehiculo9" class="form-check-label">Motocicleta</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo10" name="vehiculos[]" value="Bicicleta"
                                    class="form-check-input">
                                <label for="vehiculo10" class="form-check-label">Bicicleta</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo11" name="vehiculos[]" value="Motocarro"
                                    class="form-check-input">
                                <label for="vehiculo11" class="form-check-label">Motocarro</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="vehiculo12" name="vehiculos[]" value="Cuatrimoto"
                                    class="form-check-input">
                                <label for="vehiculo12" class="form-check-label">Cuatrimoto</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones:</label>
                    <textarea id="observaciones" name="observaciones" placeholder="Detalle el accidente..."
                        class="form-control" style="height: 100px;"></textarea>
                </div>

                <h3>Ubicación</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tipoVia" class="form-label">Tipo de Vía:</label>
                        <select id="tipoVia" name="tipoVia" class="form-select">
                            <option value="">Seleccione un tipo de vía</option>
                            <option value="calle">Calle</option>
                            <option value="carrera">Carrera</option>
                            <option value="avenida">Avenida</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numeroVia" class="form-label">Número de la Vía:</label>
                        <input type="text" id="numeroVia" name="numeroVia" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="numeroBis" class="form-label">Número Bis (si aplica):</label>
                        <input type="text" id="numeroBis" name="numeroBis" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="departamento" class="form-label">Departamento:</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <option value="">Seleccione un departamento</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="municipio" class="form-label">Municipio:</label>
                        <select id="municipio" name="municipio" class="form-select">
                            <option value="">Seleccione un municipio</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="localidad" class="form-label">Localidad o Barrio:</label>
                        <select id="localidad" name="localidad" class="form-select">
                            <option value="">Seleccione una localidad o barrio</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="image-upload">
                        <span class="placeholder">+</span>
                        <input type="file" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="image-upload">
                        <span class="placeholder">+</span>
                        <input type="file" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="image-upload">
                        <span class="placeholder">+</span>
                        <input type="file" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="image-upload">
                        <span class="placeholder">+</span>
                        <input type="file" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
    function previewImage(input) {
        const file = input.files[0];
        const parent = input.closest(".image-upload");

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                let img = parent.querySelector("img");
                if (!img) {
                    img = document.createElement("img");
                    parent.appendChild(img);
                }
                img.src = e.target.result;
                parent.querySelector(".placeholder").style.display = "none";
            };

            reader.readAsDataURL(file);
        }
    }
</script>