<?php
include_once '../model/Solicitudes/SolicitudesModel.php';
class SolicitudesController
{
    //Metodo que incluye el select-option que trae el tipo de solicitud que se desea hacer
    public function getSolicitud()
    {

        include_once '../view/Solicitudes/solicitudes.php';
    }


    //Metodo que trae incluye el formulario de acuerdo al tipo de solicitud que se escogió
    public function getSolicitudEscogida()
    {
        $tipoSolicitud = $_POST['tipoSolicitud'];
        if ($tipoSolicitud == 1) {
            $this->getAccidentes();
        } elseif ($tipoSolicitud == 2) {
            $this->getSenalesNuevo();
        } elseif ($tipoSolicitud == 3) {
            $this->getSenalesDaño();
        } elseif ($tipoSolicitud == 4) {
            $this->getReductoresNuevo();
        } elseif ($tipoSolicitud == 5) {
            $this->getReductoresDaño();
        } else if ($tipoSolicitud == 6) {
            $this->getVias();
        }

    }

    public function getInfo()
    {
        $obj = new SolicitudesModel();

        $punto1 = $_GET['x'];
        $punto2 = $_GET['y'];

        //La función ST_DWithin verifica si los dos puntos estan dentro de una distancia 
        //La función ST_MakePoint combina las coordenadas (longitud, latitud) para crear un punto geo.
        // grados = 20 metros/ 111,132 metros por grado = 0.0001798 grados
        // 0.0001798 es la distancia dada en grados de latitud
        // Son aproximadamente 50 metros de distancia
        // Cada grado de latitud equivale a 111,132 metros


        $sql = "SELECT ra.*, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS img_rutas,  STRING_AGG(DISTINCT v.vehiculo_descripcion, ', ') AS vehiculos, 
                STRING_AGG(DISTINCT dta.descripcion, ', ') AS detalles_accidente, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
                STRING_AGG(DISTINCT tc.tipo_choque_desc, ', ') AS tipo_choque,pa.geom AS punto_geom FROM registro_accidente ra
                LEFT JOIN imagenes_accidente ia ON ra.reg_acc_id = ia.reg_acc_id
                LEFT JOIN reg_acc_vehi rav ON ra.reg_acc_id = rav.reg_acc_id
                LEFT JOIN vehiculo v ON rav.vehiculo_id = v.vehiculo_id
                LEFT JOIN usuarios u ON ra.usu_id = u.usu_id
                LEFT JOIN registro_detalle_accidente rda ON ra.reg_acc_id = rda.reg_acc_id
                LEFT JOIN choque_detalle dta ON rda.choque_detalle_id = dta.choq_detal_id
                LEFT JOIN tipo_choque tc ON dta.id_perteneciente = tc.tipo_choque_id
                LEFT JOIN punto_accidente pa ON ra.reg_acc_id = pa.id_accidente
                WHERE 
                    ST_DWithin(pa.geom, ST_SetSRID(ST_MakePoint($punto1, $punto2), 4326), 0.0001798)
                GROUP BY 
                    ra.reg_acc_id, pa.geom
                ORDER BY 
                    ST_Distance(pa.geom, ST_SetSRID(ST_MakePoint($punto1, $punto2), 4326)) ASC
                    LIMIT 1";

        $accidentes = $obj->consult($sql);
        if (!empty($accidentes)) {
            include_once '../view/Solicitudes/consultarAcc.php';
            return;
        }

        $sql2 = "SELECT svd.*, td.tipo_danio_desc AS tipo_danio, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS imagenes, 
                STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, pv.geom AS punto_geom, est.est_nombre
                FROM solicitud_via_dan svd
                LEFT JOIN imagenes_vias ia ON svd.sol_via_dan_id = ia.reg_via_id
                LEFT JOIN tipo_danio td ON svd.tipo_dano_via_id = td.tipo_danio_id
                LEFT JOIN estados est ON svd.est_sol_id = est.est_id
                LEFT JOIN usuarios u ON svd.usu_id = u.usu_id
                LEFT JOIN punto_via pv ON svd.sol_via_dan_id = pv.id_via
                WHERE ST_DWithin(pv.geom, ST_SetSRID(ST_MakePoint($punto1, $punto2), 4326), 0.0001798)
                GROUP BY svd.sol_via_dan_id, td.tipo_danio_desc, u.usu_nombre1, pv.geom, est.est_nombre
                ORDER BY ST_Distance(pv.geom, ST_SetSRID(ST_MakePoint($punto1, $punto2), 4326)) ASC
                LIMIT 1";

        $vias = $obj->consult($sql2);
        if (!empty($vias)) {
            include_once '../view/Solicitudes/consultarV.php';
            return;
        }

        $sql3 = "SELECT snew.*, tp.tipo_sen_desc AS senal, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
               ps.geom AS punto_geom, est.est_nombre FROM solicitud_seniales_new snew
               LEFT JOIN estados est ON snew.est_sol_id = est.est_id
               LEFT JOIN usuarios u ON snew.usu_id = u.usu_id
               LEFT JOIN punto_senialnew ps ON snew.sol_sen_new_id = ps.id_senialnew
               LEFT JOIN tipo_seniales tp ON tp.tipo_senial_id = snew.tipo_sen_id
               WHERE ST_DWithin(ps.geom, ST_SetSRID(ST_MakePoint($punto1, $punto2), 4326), 0.0001798)
               GROUP BY snew.sol_sen_new_id,  tp.tipo_sen_desc, ps.geom, est.est_nombre
               ORDER BY ST_Distance(ps.geom, ST_SetSRID(ST_MakePoint($punto1, $punto2), 4326)) ASC
               LIMIT 1 ";

        $senialNew = $obj->consult($sql3);
        if (!empty($senialNew)) {
            include_once '../view/Solicitudes/consultarSenNew.php';
            return;
        }

    }
    //VISTAS-FORMULARIOS
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
    public function getSenalesNuevo()
    {
        $obj = new SolicitudesModel();
        $sql = 'SELECT * FROM categoria_seniales';
        $senCate = $obj->consult($sql);

        $sql2 = 'SELECT * FROM orientacion_seniales';
        $senOrientacion = $obj->consult($sql2);

        $sql3 = 'SELECT * FROM tipo_seniales';
        $senTipo = $obj->consult($sql3);

        include_once '../view/Solicitudes/senalesNuevo.php';
    }


    public function senialNew()
    {
        $obj = new SolicitudesModel();

        $cateSen = $_POST['sen_cate'];
        $tipoSen = $_POST['tipoSen'];
        $orienSen = $_POST['orienSen'];

        $descSen = $_POST['sen_desc'];
        $punto1 = $_POST['punto1'];
        $punto2 = $_POST['punto2'];
        $usu_id = $_POST['usu_id'];

        $punto1Procesado = eliminarSegundoPunto($punto1);
        $punto2rocesado = eliminarSegundoPunto($punto2);
        $idSen = $obj->autoIncrement("solicitud_seniales_new", "sol_sen_new_id");

        $sql1 = "INSERT INTO solicitud_seniales_new VALUES($idSen,$tipoSen,'$descSen', date_trunc('second', NOW()),3,$usu_id)";
        $ejecutar = $obj->insert($sql1);
        if ($ejecutar) {

            $sql2 = "INSERT INTO punto_senialNew (id_senialNew, geom) VALUES ($idSen, ST_SetSRID(ST_GeomFromText('POINT($punto1Procesado  $punto2rocesado)'),4326))";
            $punto = $obj->insert($sql2);
            if ($punto) {
                $_SESSION['senNewM'] = "Registro Exitoso";
                redirect("index.php");

            }
        }

    }


    public function getSenalesDaño()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/senalesDanos.php';
    }
    public function getReductoresNuevo()
    {
        $obj = new SolicitudesModel();


        include_once '../view/Solicitudes/reductoresDanos.php';
    }
    public function getReductoresDaño()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/reductoresNuevo.php';
    }


    //Metodo que llena input de detalle del cohque como: Bus con bicicleta, carro con moto, etc.
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

    // Metodo que registra accidentes
    public function regAccidentes()
    {
        $obj = new SolicitudesModel();
        $usu_id = $_POST['usu_id'];
        $tipoChoque = $_POST['tipoChoque'];
        $vehiculos = $_POST['vehiculos'];

        $punto1 = $_POST['punto1'];
        $punto2 = $_POST['punto2'];



        $punto1Procesado = eliminarSegundoPunto($punto1);
        $punto2rocesado = eliminarSegundoPunto($punto2);


        if (!empty($_POST['lesionados'])) {
            $lesionados = "TRUE";
        } else {
            $lesionados = "FALSE";
        }
        $observaciones = $_POST['observaciones'];

        $iddetalleAcc = $_POST['detalleChoque'];

        $idAcc = $obj->autoIncrement("registro_accidente", "reg_acc_id");

        $sqlAcc = "INSERT INTO registro_accidente VALUES($idAcc, date_trunc('second', NOW()), $tipoChoque, $lesionados, '$observaciones', $usu_id)";
        $ejecutar = $obj->insert($sqlAcc);

        if ($ejecutar) {
            $sqlPuntos = "INSERT INTO punto_accidente (id_accidente, geom) VALUES ($idAcc, ST_SetSRID(ST_GeomFromText('POINT($punto1Procesado  $punto2rocesado)'),4326))";
            $punto = $obj->insert($sqlPuntos);
            if (!$punto) {
                return;
            }
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

            $_SESSION['regAcc'][] = 'Registro exitoso';
            redirect("index.php");
        } else {
            echo $sqlAcc;
        }
    }

    //Metodo que consulta los accidentes
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
                $evidencia = !empty($via['imagenes']) ? explode(', ', $via['imagenes']) : array();

                echo "<p><strong>ID:</strong> " . $via['sol_via_dan_id'] . "</p>" .
                    "<p><strong>Fecha y hora:</strong> " . $via['fecha_hora'] . "</p>" .
                    "<p><strong>Solicitante:</strong> " . $via['usuario_nombre'] . "</p>" .
                    "<p><strong>Descripción:</strong> " . $via['descripcion_via'] . "</p>" .
                    "<p><strong>Tipo de daño:</strong> " . $via['tipo_danio'] . "</p>" .
                    "<p><strong>Estado:</strong> " . $via['est_nombre'] . "</p>";


                if (!empty($evidencia)) {
                    echo "<p><strong>Evidencia adjunta:</strong></p>";
                    foreach ($evidencia as $ruta) {
                        $rutasinEs = trim($ruta);
                        if (!empty($rutasinEs) && file_exists($rutasinEs)) {
                            echo "<div style='border: 5px solid; max-width: 200px;'>";
                            echo "<img src='" . $ruta . "' alt='Evidencia' style='max-width: 150px; margin: 10px;'>";
                            echo "</div>";
                        } elseif (!empty($rutasinEs)) {
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
                    "<p><strong>Detalles adicionales:</strong> " . $acc['reg_acc_observaciones'] . "</p>" .
                    "<p><strong>Tipo de accidente:</strong> " . $acc['tipo_choque'] . " - " . $acc['detalles_accidente'] . "</p>" .
                    "<p><strong>Vehículos involucrados:</strong> " . $vehiculos . "</p>";


                if (!empty($acc['img_rutas'])) {
                    echo "<p><strong>Evidencia adjunta:</strong></p>";
                    $rutas = explode(', ', $acc['img_rutas']);
                    foreach ($rutas as $ruta) {
                        $rutasinEs = trim($ruta);
                        if (!empty($rutasinEs) && file_exists($rutasinEs)) {
                            echo "<div style='border: 5px solid; max-width: 200px;'>";
                            echo "<img src='" . $ruta . "' alt='Evidencia' style='max-width: 150px; margin: 10px;'>";
                            echo "</div>";
                        } elseif (!empty($rutasinEs)) {
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
        $punto1 = $_POST['punto1'];
        $punto2 = $_POST['punto2'];
        $detalles = $_POST['detalles'];
        $estado = 3;
        $punto1Procesado = eliminarSegundoPunto($punto1);
        $punto2rocesado = eliminarSegundoPunto($punto2);

        $id = $obj->autoIncrement("solicitud_via_dan", "sol_via_dan_id");

        $sql = "INSERT INTO solicitud_via_dan VALUES($id, $tipoDaño, '$detalles', date_trunc('second', NOW()),  $estado, $usu_id)";
        $ejecutar = $obj->insert($sql);

        if ($ejecutar) {
            $sqlPuntos = "INSERT INTO punto_via (id_via, geom) VALUES ($id, ST_SetSRID(ST_GeomFromText('POINT($punto1Procesado  $punto2rocesado)'),4326))";
            $punto = $obj->insert($sqlPuntos);
            if (!$punto) {
                return;
            }
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
            $_SESSION['regVia'][] = 'Registro exitoso';
            redirect("index.php");
        }
    }
    public function getSolicitudConsult()
    {
        include_once '../view/Solicitudes/consultarSolicitudes.php';
    }
    public function updateEstadoVias()
    {
        $obj = new SolicitudesModel();

        $sol_id = $_POST['solicitud'];
        $est_id = $_POST['id'];



        if ($est_id !== null) {
            $sql = "UPDATE solicitud_via_dan SET est_sol_id = $est_id WHERE sol_via_dan_id = $sol_id";
            $ejecutar = $obj->update($sql);

            if ($ejecutar) {
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

                include_once "../view/solicitudes/buscarVias.php";
            }
        }

    }



    public function descargarExcel()
    {
        $solicitud = $_GET['solicitud'];
        require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

        //var_dump($solicitud);

        $obj = new SolicitudesModel();
        if ($solicitud == 1) {
            $sql = "SELECT ra.*, 
            STRING_AGG(DISTINCT ia.img_ruta, ', ') AS img_rutas, 
            STRING_AGG(DISTINCT v.vehiculo_descripcion, ', ') AS vehiculos, 
            STRING_AGG(DISTINCT dta.descripcion, ', ') AS detalles_accidente, 
            STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
            STRING_AGG(DISTINCT tc.tipo_choque_desc, ', ') AS tipo_choque FROM registro_accidente ra
            LEFT JOIN imagenes_accidente ia ON ra.reg_acc_id = ia.reg_acc_id
            LEFT JOIN reg_acc_vehi rav ON ra.reg_acc_id = rav.reg_acc_id
            LEFT JOIN vehiculo v ON rav.vehiculo_id = v.vehiculo_id
            LEFT JOIN usuarios u ON ra.usu_id = u.usu_id
            LEFT JOIN registro_detalle_accidente rda ON ra.reg_acc_id = rda.reg_acc_id
            LEFT JOIN choque_detalle dta ON rda.choque_detalle_id = dta.choq_detal_id
            LEFT JOIN tipo_choque tc ON dta.id_perteneciente = tc.tipo_choque_id
            GROUP BY ra.reg_acc_id";

            $accidentes = $obj->consult($sql);

            if (!empty($accidentes)) {
                $excel = new PHPExcel();
                $excel->setActiveSheetIndex(0);
                $sheet = $excel->getActiveSheet();
                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'Tipo de Choque');
                $sheet->setCellValue('C1', 'Fecha y hora');
                $sheet->setCellValue('D1', 'Lesionados');
                $sheet->setCellValue('E1', 'Solicitante');
                $sheet->setCellValue('F1', 'Vehiculos');

                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                $row = 2;
                foreach ($accidentes as $acc) {
                    $lesionados = ($acc['reg_acc_lesionados'] === 't') ? 'Sí' : 'No';
                    $tipo_choque = isset($acc['tipo_choque']) ? $acc['tipo_choque'] : 'Desconocido';
                    $detalles_accidente = isset($acc['detalles_accidente']) ? $acc['detalles_accidente'] : 'No disponible';
                    $fecha_accidente = isset($acc['reg_acc_fecha_hora']) ? date('d-m-Y H:i:s', strtotime($acc['reg_acc_fecha_hora'])) : 'Fecha no disponible';
                    $usuario_nombre = isset($acc['usuario_nombre']) ? $acc['usuario_nombre'] : 'Usuario desconocido';
                    $imagenes = isset($acc['img_rutas']) ? $acc['img_rutas'] : 'No disponibles';
                    $vehiculos = isset($acc['vehiculos']) ? $acc['vehiculos'] : 'No disponibles';

                    $sheet->setCellValue("A{$row}", $acc['reg_acc_id']);
                    $sheet->setCellValue("B{$row}", $tipo_choque . ' - ' . $detalles_accidente);
                    $sheet->setCellValue("C{$row}", $fecha_accidente);
                    $sheet->setCellValue("D{$row}", $lesionados);
                    $sheet->setCellValue("E{$row}", $usuario_nombre);
                    $sheet->setCellValue("F{$row}", $vehiculos);
                    $row++;
                }
                $filename = 'Accidentes_' . date('Ymd_His') . '.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $filename . '"');
                header('Cache-Control: max-age=0');

                $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                $writer->save('php://output');
                exit;
            } else {
                echo "No se encontraron datos para generar el archivo Excel.";
            }
        } else if ($solicitud == 2) {

            $sql = " SELECT svd.*, td.tipo_danio_desc AS tipo_danio, u.usu_nombre1 AS solicitante, STRING_AGG(DISTINCT ia.img_ruta, ', ') AS imagenes, 
            STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, est.est_nombre
            FROM solicitud_via_dan svd
            LEFT JOIN imagenes_vias ia ON svd.sol_via_dan_id = ia.reg_via_id
            LEFT JOIN tipo_danio td ON svd.tipo_dano_via_id = td.tipo_danio_id
            LEFT JOIN estados est ON svd.est_sol_id = est.est_id
            LEFT JOIN usuarios u ON svd.usu_id = u.usu_id GROUP BY svd.sol_via_dan_id, td.tipo_danio_desc, u.usu_nombre1, est.est_nombre";

            $vias = $obj->consult($sql);

            if (!empty($vias)) {
                $excel = new PHPExcel();
                $excel->setActiveSheetIndex(0);
                $sheet = $excel->getActiveSheet();
                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'Tipo de daño');
                $sheet->setCellValue('C1', 'Fecha y hora');
                $sheet->setCellValue('D1', 'Solicitante');
                $sheet->setCellValue('E1', 'Estado');


                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                $row = 2;
                foreach ($vias as $via) {

                    $sheet->setCellValue("A{$row}", $via['sol_via_dan_id']);
                    $sheet->setCellValue("B{$row}", $via['tipo_danio']);
                    $sheet->setCellValue("C{$row}", $via['fecha_hora']);
                    $sheet->setCellValue("D{$row}", $via['usuario_nombre']);
                    $sheet->setCellValue("E{$row}", $via['est_nombre']);
                    $row++;
                }
                $filename = 'Daños_via_' . date('Ymd_His') . '.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $filename . '"');
                header('Cache-Control: max-age=0');

                $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                $writer->save('php://output');
                exit;
            } else {
                echo "No se encontraron datos para generar el archivo Excel.";
            }
        } else if ($solicitud = 3) {
            $sql = "SELECT snew.*, tp.tipo_sen_desc AS senal, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
            est.est_nombre FROM solicitud_seniales_new snew
            LEFT JOIN estados est ON snew.est_sol_id = est.est_id
            LEFT JOIN usuarios u ON snew.usu_id = u.usu_id
            LEFT JOIN tipo_seniales tp ON tp.tipo_senial_id = snew.tipo_sen_id
            GROUP BY snew.sol_sen_new_id, tp.tipo_sen_desc, est.est_nombre";
            $senial = $obj->consult($sql);

            if (!empty($senial)) {
                $excel = new PHPExcel();
                $excel->setActiveSheetIndex(0);
                $sheet = $excel->getActiveSheet();
                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'Señal');
                $sheet->setCellValue('C1', 'Fecha y hora');
                $sheet->setCellValue('D1', 'Solicitante');
                $sheet->setCellValue('E1', 'Estado');


                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                $row = 2;
                foreach ($senial as $sen) {

                    $sheet->setCellValue("A{$row}", $sen['sol_sen_new_id']);
                    $sheet->setCellValue("B{$row}", $sen['senal']);
                    $sheet->setCellValue("C{$row}", $sen['sol_sen_new_fecha']);
                    $sheet->setCellValue("D{$row}", $sen['usuario_nombre']);
                    $sheet->setCellValue("E{$row}", $sen['est_nombre']);
                    $row++;
                }
                $filename = 'Señales_new_' . date('Ymd_His') . '.xlsx';
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $filename . '"');
                header('Cache-Control: max-age=0');

                $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                $writer->save('php://output');
                exit;
            } else {
                echo "No se encontraron datos para generar el archivo Excel.";
            }
        }

    }

    function consultSen()
    {
        $obj = new SolicitudesModel();
        $sql = "SELECT snew.*, tp.tipo_sen_desc AS senal, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
               est.est_nombre FROM solicitud_seniales_new snew
               LEFT JOIN estados est ON snew.est_sol_id = est.est_id
               LEFT JOIN usuarios u ON snew.usu_id = u.usu_id
               LEFT JOIN tipo_seniales tp ON tp.tipo_senial_id = snew.tipo_sen_id
               GROUP BY snew.sol_sen_new_id, tp.tipo_sen_desc, est.est_nombre";
        $senial = $obj->consult($sql);

        $sqlEst = "SELECT e. est_id, e.est_nombre from tipo_estado t
                   JOIN estados e ON e.est_id = t.id_estado WHERE t.id_perteneciente = 2 ";
        $estados = $obj->consult($sqlEst);

        include_once '../view/Solicitudes/consultarSeniales.php';
    }

    public function updateEstadoSenNew()
    {
        $obj = new SolicitudesModel();

        $sol_id = $_POST['solicitud'];
        $est_id = $_POST['id'];



        if ($est_id !== null) {
            $sql = "UPDATE solicitud_seniales_new SET est_sol_id = $est_id WHERE sol_sen_new_id = $sol_id";
            $ejecutar = $obj->update($sql);

            if ($ejecutar) {
                $sql = "SELECT snew.*, tp.tipo_sen_desc AS senal, STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, 
                est.est_nombre FROM solicitud_seniales_new snew
                LEFT JOIN estados est ON snew.est_sol_id = est.est_id
                LEFT JOIN usuarios u ON snew.usu_id = u.usu_id
                LEFT JOIN tipo_seniales tp ON tp.tipo_senial_id = snew.tipo_sen_id
                GROUP BY snew.sol_sen_new_id, tp.tipo_sen_desc, est.est_nombre";
                $senial = $obj->consult($sql);

                $sqlEst = "SELECT e. est_id, e.est_nombre from tipo_estado t
                    JOIN estados e ON e.est_id = t.id_estado WHERE t.id_perteneciente = 2 ";
                $estados = $obj->consult($sqlEst);

                include_once "../view/solicitudes/buscarSen.php";
            }
        }

    }

    function getSenialF()
    {
        $categoria = $_POST['categoria_id'];
        $orientacion = $_POST['orientacion_id'];
        $obj = new SolicitudesModel();

        $sql = "SELECT tp.* FROM tipo_seniales tp WHERE orientacion_id = $orientacion AND cat_id = $categoria";
        $tipoSen = $obj->consult($sql);

        if (!empty($tipoSen)) {
            foreach ($tipoSen as $ts) {
                echo '<option value="' . $ts['tipo_senial_id'] . '">' . $ts['tipo_sen_desc'] . '</option>';
            }
        } else {
            echo '<option value="">No hay señales con ese criterio</option>';
        }

    }

    function getNumReportes()
    {
        $obj = new SolicitudesModel();

        $sql = "SELECT
                    (SELECT COUNT(*) FROM registro_accidente) AS accidentes,
                    (SELECT COUNT(*) FROM solicitud_via_dan) AS vias,
                    (SELECT COUNT(*) FROM solicitud_seniales_new) AS sennew";

        $reportes = $obj->consult($sql);

        if (!$reportes || empty($reportes[0])) {
            echo "0,0,0";
        } else {
            $accidentes = 0;
            $vias = 0;
            $sennew = 0;

            if (isset($reportes[0]['accidentes'])) {
                $accidentes = $reportes[0]['accidentes'];
            }

            if (isset($reportes[0]['vias'])) {
                $vias = $reportes[0]['vias'];
            }

            if (isset($reportes[0]['sennew'])) {
                $sennew = $reportes[0]['sennew'];
            }

            echo "$accidentes,$vias,$sennew";
        }
    }






}







?>