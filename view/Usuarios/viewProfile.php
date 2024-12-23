<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Encabezado de saludo -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h2| class="display-6">Hola <strong><?= $_SESSION['nombre'] ?></strong><img src="img/saludo.gif"
                            alt="" style="width:8%; margin-top:-10px" class="px-3"></h2>
                        <p class="card-text">Bienvenido a AccidentEye</p>
                </div>
            </div>

            <!-- Sección del perfil del paciente -->
            <?php foreach ($perfil as $p) { ?>
                <div class="container-scroll">
                    <div class="card mb-4  p-3">
                        <div class="row g-0">
                            <!-- Imagen de perfil -->

                            <!-- Información del perfil -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Tipo Documento:</strong>
                                                <?php echo ($p['nombre_tipo']) ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Numero Documento:</strong>
                                                <?php echo ($p['usu_documento']); ?></p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Nombres:</strong>
                                                <?php echo ($p['usu_nombre1'] . ' ' . $p['usu_nombre2']); ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Apellidos:</strong>
                                                <?php echo ($p['usu_apellido1'] . ' ' . $p['usu_apellido2']); ?></p>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Telefono:</strong> <?php echo ($p['usu_tel']); ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Email:</strong> <?php echo ($p['usu_correo']); ?>
                                            </p>
                                        </div>

                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Sexo Biologico:</strong>
                                                <?php echo ($p['sex_desc']); ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                                            <p class="card-text"><strong>Direccion:</strong>
                                                <?php echo ($p['usu_direccion']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Botón de volver -->
            <div class="text-center">
                <a class="btn btn-outline-primary" href="../web/index.php">Volver</a>
            </div>
        </div>
    </div>
</div>