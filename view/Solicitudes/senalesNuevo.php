<div class="container">
    <div class="row align-items-stretch mt-4">
        <div class="col">
            <h2>Info señal seleccionada</h2>
            <!-- AJAX -->
            <div class="row">
                <div class="" id="categoria">

                </div>
                <div id="señal">

                </div>
            </div>
        </div>

        <div class="col container-scroll ">
            <div>
                <h3>Escoja la señal para el tramite</h3>
            </div>
            <form id="formSeñalesReporte" action="<?php echo getUrl('Solicitudes', 'Solicitudes', 'reporteDano');?>" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Categoria</label>
                            <select name="" id="" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Tipo</label>
                            <select name="" id="" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label for="" class="form-label">Señal</label>
                            <select name="" id="" class="form-select">
                                <option value="" class="form-option">Seleccione...</option>
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
