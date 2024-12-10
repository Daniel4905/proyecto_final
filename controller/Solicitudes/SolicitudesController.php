<?php
include_once '../model/Solicitudes/SolicitudesModel.php';
class SolicitudesController
{
    public function getSolicitud()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/solicitudes.php';
    }

    public function getSolicitudEscogida()
    {
        $tipoSolicitud = $_POST['tipoSolicitud'];
        if ($tipoSolicitud == 1) {
            $this->getAccidentes();
        } elseif ($tipoSolicitud == 2) {
            include_once '../view/Solicitudes/señalesNuevo.php';
        } elseif ($tipoSolicitud == 3) {
            include_once '../view/Solicitudes/señalesDaños.php';
        } elseif ($tipoSolicitud == 4) {
            include_once '../view/Solicitudes/reductoresNuevo.php';
        } elseif ($tipoSolicitud == 5) {
            include_once '../view/Solicitudes/reductoresDaños.php';
        } else if ($tipoSolicitud == 6) {
            $this->getVias();
        }

    }
    public function getSeñalesNuevo()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/señalesNuevo.php';
    }
    public function reporteDano()
    {
        echo "Funciona";
    }
    public function solicitarSenal()
    {
        echo "Funciona 2";
    }

    public function getVias()
    {
        $obj = new SolicitudesModel();

        $sql = "SELECT td.tipo_danio_id, td.tipo_danio_desc FROM  danio cd  
        JOIN tipo_danio td ON td.tipo_danio_id = cd.danio_id
        WHERE cd.solicitud_id = 1";

        $danos = $obj->consult($sql);

        include_once '../view/Solicitudes/vias.php';
    }

    public function getAccidentes()
    {
        $obj = new SolicitudesModel();
        $sqlT = "SELECT * FROM tipo_choque";
        $tipoAc = $obj->consult($sqlT);
        include_once '../view/Solicitudes/accidentes.php';
    }

    public function getDetalleAc()
    {
        if (isset($_POST['id_tipo_accidente'])) {
            $obj = new SolicitudesModel();
            $idTipo = $_POST['id_tipo_accidente'];


            $sqlTip = "SELECT cd.*, tp.tipo_choque_id  FROM choque_detalle cd
                       JOIN tipo_choque tp ON tp.tipo_choque_id = cd.id_perteneciente
                       WHERE tp.tipo_choque_id  = $idTipo";

            $tip = $obj->consult($sqlTip);

            foreach ($tip as $t) {
                echo "<option value='" . $t['choq_detal_id'] . "'>" . $t['descripcion'] . "</option>";
            }
        } else {
            echo "<option value=''>No se recibieron datos válidos...</option>";
        }
    }

    public function regAccidentes()
    {
        $obj = new SolicitudesModel();
        $usu_id = $_POST['usu_id'];
        $tipoChoque = $_POST['tipoChoque'];
        $vehiculos = $_POST['vehiculos'];
        if (!empty($_POST['lesionados'])) {
            $lesionados = "TRUE";
        } else {
            $lesionados = "FALSE";
        }
        $observaciones = $_POST['observaciones'];
        $tipoV = $_POST['tipoVia'];
        $numeroPr = $_POST['numeroPrincipal'];
        $comp1 = $_POST['complemento1'];
        $comp2 = $_POST['complemento2'];
        $numeroSc = $_POST['numeroSecundario'];
        $numeroTerc = $_POST['numeroTerciario'];
        $referencias = $_POST['referencias'];

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        if (!empty($referencias)) {
            $ref = "Ref.";
        } else {
            $ref = "";
        }
        $iddetalleAcc = $_POST['detalleChoque'];



        $direccion = "$tipoV $numeroPr $comp1 $numeroSc $comp2 $numeroTerc $ref $referencias";

        $idAcc = $obj->autoIncrement("registro_accidente", "reg_acc_id");

        $sqlAcc = "INSERT INTO registro_accidente VALUES($idAcc, '$direccion', '$fechaActual', $tipoChoque, $lesionados, '$observaciones', $usu_id)";
        $ejecutar = $obj->insert($sqlAcc);

        if ($ejecutar) {
            echo $sqlAcc;
            foreach ($_FILES['imagenes']['name'] as $index => $nombreArchivo) {

                $nombreArchivoSinEspacios = str_replace(' ', '', $nombreArchivo);

                $rutaDestino = "img/$nombreArchivoSinEspacios";

                if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$index], $rutaDestino)) {
                    $imgid = $obj->autoIncrement("imagenes_accidente", "img_id");
                    $sql = "INSERT INTO imagenes_accidente VALUES($imgid, $idAcc, '$rutaDestino')";
                    $ejecutar = $obj->insert($sql);
                    if ($ejecutar) {
                        echo "Funciona";
                    } 

                } else {

                }
            }

            foreach ($vehiculos as $vehiculo) {
                $reg_acc_vehi_id = $obj->autoIncrement("reg_acc_vehi", "reg_acc_vehi_id");
                $sqlVehi = "INSERT INTO reg_acc_vehi VALUES($reg_acc_vehi_id, $idAcc, $vehiculo)";
                $ejecutar = $obj->insert($sqlVehi);
                if ($ejecutar) {
                    echo "Funciona vehiculos";
                } 
            }
            $idDet = $obj->autoIncrement("registro_detalle_accidente", " reg_det_acc_id");
            $sqlDet = "INSERT INTO registro_detalle_accidente VALUES($idDet, $idAcc,  $iddetalleAcc)";
            $ejecutar = $obj->insert($sqlDet);
            if ($ejecutar) {
                echo "Funciona detalles";
            } 

            $_SESSION['regAcc'][]='Registro exitoso';
            redirect(getUrl('Solicitudes', 'Solicitudes', 'getSolicitud'));
        } else {
            echo $sqlAcc;
        }
    }

    public function acConsult()
    {
        $obj = new SolicitudesModel();
        // $usu_id=$_POST['usu_id'];

        $sql = "SELECT ra.*, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS img_rutas, STRING_AGG(DISTINCT v.vehiculo_descripcion, ', ') AS vehiculos, 
            STRING_AGG(DISTINCT dta.descripcion, ', ') AS detalles_accidente, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
            STRING_AGG(DISTINCT tc.tipo_choque_desc, ', ') AS tipo_choque FROM registro_accidente ra
            LEFT JOIN imagenes_accidente ia ON ra.reg_acc_id = ia.reg_acc_id
            LEFT JOIN reg_acc_vehi rav ON ra.reg_acc_id = rav.reg_acc_id
            LEFT JOIN vehiculo v ON rav.vehiculo_id = v.vehiculo_id
            LEFT JOIN usuarios u ON ra.usu_id = u.usu_id
            LEFT JOIN registro_detalle_accidente rda ON ra.reg_acc_id = rda.reg_acc_id
            LEFT JOIN choque_detalle dta ON rda.choque_detalle_id = dta.choq_detal_id
            LEFT JOIN tipo_choque tc ON dta.id_perteneciente = tc.tipo_choque_id
            GROUP BY  ra.reg_acc_id";





        $accidentes = $obj->consult($sql);



        include_once "../view/solicitudes/consultarAccidentes.php";


    }
    public function viaConsult()
    {
        $obj = new SolicitudesModel();
        // $usu_id=$_POST['usu_id'];

        $sql = " SELECT svd.*, td.tipo_danio_desc AS tipo_danio, u.usu_nombre1 AS solicitante, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS imagenes, 
        STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre
        FROM solicitud_via_dan svd
        LEFT JOIN imagenes_vias ia ON svd.sol_via_dan_id = ia.reg_via_id
        LEFT JOIN tipo_danio td ON svd.tipo_dano_via_id = td.tipo_danio_id
        LEFT JOIN estados est ON svd.est_sol_id = est.est_id
        LEFT JOIN usuarios u ON svd.usu_id = u.usu_id GROUP BY svd.sol_via_dan_id, td.tipo_danio_desc, u.usu_nombre1";



        $sqlEst = "SELECT e. est_id, e.est_nombre from tipo_estado t
                   JOIN estados e ON e.est_id = t.id_estado WHERE t.id_perteneciente = 2 ";
        $vias = $obj->consult($sql);
        $estados = $obj->consult($sqlEst);




        include_once "../view/solicitudes/consultarVias.php";


    }
   
    public function detallesVia()
    {
        $obj = new SolicitudesModel();
        $id = $_POST['id'];

        $sql = "SELECT svd.*, td.tipo_danio_desc AS tipo_danio,  u.usu_nombre1 AS solicitante, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS imagenes, 
        STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, est.est_nombre FROM solicitud_via_dan svd
        LEFT JOIN imagenes_vias ia ON svd.sol_via_dan_id = ia.reg_via_id
        LEFT JOIN tipo_danio td ON svd.tipo_dano_via_id = td.tipo_danio_id
        LEFT JOIN usuarios u ON svd.usu_id = u.usu_id
        LEFT JOIN estados est ON svd.est_sol_id = est.est_id
        WHERE svd.sol_via_dan_id = $id 
        GROUP BY svd.sol_via_dan_id, td.tipo_danio_desc, u.usu_nombre1, est.est_nombre";


        $vias = $obj->consult($sql);

        foreach ($vias as $via) {
            if ($via) {
                $evidencia = !empty($via['imagenes']) ? explode(', ', $via['imagenes']) : [];

                echo "<p><strong>ID:</strong> " . $via['sol_via_dan_id'] . "</p>" .
                    "<p><strong>Fecha y hora:</strong> " . $via['fecha_hora'] . "</p>" .
                    "<p><strong>Solicitante:</strong> " . $via['usuario_nombre'] . "</p>" .
                    "<p><strong>Ubicacion:</strong> " . $via['direccion_via'] . "</p>" .
                    "<p><strong>Descripción:</strong> " . $via['descripcion_via'] . "</p>" .
                    "<p><strong>Tipo de daño:</strong> " . $via['tipo_danio'] . "</p>" .
                    "<p><strong>Estado:</strong> " . $via['est_nombre'] . "</p>";


                if (!empty($evidencia)) {
                    echo "<p><strong>Evidencia adjunta:</strong></p>";
                    foreach ($evidencia as $ruta) {
                        if (!empty(trim($ruta)) && file_exists($ruta)) {
                            echo "<div style='border: 5px solid; max-width: 200px;'>";
                            echo "<img src='" . $ruta . "' alt='Evidencia' style='max-width: 150px; margin: 10px;'>";
                            echo "</div>";
                        } elseif (!empty(trim($ruta))) {
                            echo "<p>No se pudo cargar la imagen: $ruta</p>";
                        }
                    }
                } else {
                    echo "<p><strong>Evidencia adjunta:</strong> No hay evidencia disponible.</p>";
                }
            } else {
                echo "<p class='text-danger'>No se encontraron detalles para esta solicitud.</p>";
            }
        }
    }

    public function detallesAccidente()
    {
        $obj = new SolicitudesModel();
        $acc_id = $_POST['id'];
        $sql = "SELECT ra.*, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS img_rutas, STRING_AGG(DISTINCT v.vehiculo_descripcion, ', ') AS vehiculos, 
            STRING_AGG(DISTINCT dta.descripcion, ', ') AS detalles_accidente, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
            STRING_AGG(DISTINCT tc.tipo_choque_desc, ', ') AS tipo_choque FROM registro_accidente ra
            LEFT JOIN imagenes_accidente ia ON ra.reg_acc_id = ia.reg_acc_id
            LEFT JOIN reg_acc_vehi rav ON ra.reg_acc_id = rav.reg_acc_id
            LEFT JOIN vehiculo v ON rav.vehiculo_id = v.vehiculo_id
            LEFT JOIN usuarios u ON ra.usu_id = u.usu_id
            LEFT JOIN registro_detalle_accidente rda ON ra.reg_acc_id = rda.reg_acc_id
            LEFT JOIN choque_detalle dta ON rda.choque_detalle_id = dta.choq_detal_id
            LEFT JOIN tipo_choque tc ON dta.id_perteneciente = tc.tipo_choque_id
            WHERE ra.reg_acc_id = $acc_id GROUP BY ra.reg_acc_id";

        $accidentes = $obj->consult($sql);

        foreach ($accidentes as $acc) {
            if ($acc) {
                if (empty($acc['vehiculos'])) {
                    $vehiculos = "No hay vehiculos involucrados al accidente";
                } else {
                    $vehiculos = $acc['vehiculos'];
                }
                $texto = ($acc['reg_acc_lesionados'] === 't') ? "Sí" : "No";

                echo "<p><strong>ID:</strong> " . $acc['reg_acc_id'] . "</p>" .
                    "<p><strong>Fecha y hora:</strong> " . $acc['reg_acc_fecha_hora'] . "</p>" .
                    "<p><strong>Solicitante:</strong> " . $acc['usuario_nombre'] . "</p>" .
                    "<p><strong>Lesionados:</strong> " . $texto . "</p>" .
                    "<p><strong>Dirección:</strong> " . $acc['reg_acc_direccion_accidente'] . "</p>" .
                    "<p><strong>Detalles adicionales:</strong> " . $acc['reg_acc_observaciones'] . "</p>" .
                    "<p><strong>Tipo de accidente:</strong> " . $acc['tipo_choque'] . " - " . $acc['detalles_accidente'] . "</p>" .
                    "<p><strong>Vehículos involucrados:</strong> " . $vehiculos . "</p>";


                if (!empty($acc['img_rutas'])) {
                    echo "<p><strong>Evidencia adjunta:</strong></p>";
                    $rutas = explode(', ', $acc['img_rutas']);
                    foreach ($rutas as $ruta) {
                        if (!empty(trim($ruta)) && file_exists($ruta)) {
                            echo "<div style = 'border: 5px solid; max-width: 200px;'>";
                            echo "<img src='" . $ruta . "' alt='Evidencia' style='max-width: 150px; margin: 10px;'>";
                            echo "</div>";
                        } elseif (!empty(trim($ruta))) {
                            echo "<p>No se pudo cargar la imagen: $ruta</p>";
                        }
                    }
                } else {
                    echo "<p><strong>Evidencia adjunta:</strong> No hay evidencia disponible.</p>";
                }

            } else {
                echo "<p class='text-danger'>No se encontraron detalles para este accidente.</p>";
            }
        }




    }

    public function regVias()
    {
        $obj = new SolicitudesModel();
        $usu_id = $_POST['usu_id'];
        $tipoDaño = $_POST['tipoDanio'];

        $detalles = $_POST['detalles'];
        $tipoV = $_POST['tipoVia'];
        $numeroPr = $_POST['numeroPrincipal'];
        $comp1 = $_POST['complemento1'];
        $comp2 = $_POST['complemento2'];
        $numeroSc = $_POST['numeroSecundario'];
        $numeroTerc = $_POST['numeroTerciario'];
        $referencias = $_POST['referencias'];
        $estado = 3;

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        if (!empty($referencias)) {
            $ref = "Ref.";
        } else {
            $ref = "";
        }

        $direccion = "$tipoV $numeroPr $comp1 $numeroSc $comp2 $numeroTerc $ref $referencias";

        $id = $obj->autoIncrement("solicitud_via_dan", "sol_via_dan_id");

        $sql = "INSERT INTO solicitud_via_dan VALUES($id, $tipoDaño, '$detalles','$direccion', '$fechaActual',  $estado, $usu_id)";
        $ejecutar = $obj->insert($sql);

        if ($ejecutar) {
            echo $sql;

            foreach ($_FILES['imagenes']['name'] as $index => $nombreArchivo) {

                $nombreArchivoSinEspacios = str_replace(' ', '', $nombreArchivo);

                $rutaDestino = "img/$nombreArchivoSinEspacios";

                if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$index], $rutaDestino)) {
                    $imgid = $obj->autoIncrement("imagenes_vias", "img_id");
                    $sql = "INSERT INTO imagenes_vias VALUES($imgid, $id, '$rutaDestino')";
                    $ejecutar = $obj->insert($sql);
                    if ($ejecutar) {
                        echo "Funciona";
                    } else {
                        echo "No FIN";
                    }

                } else {
                    echo "No se movio el archivo";
                }
            }
            $_SESSION['regVia'][]='Registro exitoso';
            redirect(getUrl('Solicitudes', 'Solicitudes', 'getSolicitud'));
        }
    }


    public function getReductoresNuevo()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/reductoresDaños.php';
    }
    public function getReductoresDaño()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/reductoresNuevo.php';
    }
}
?>