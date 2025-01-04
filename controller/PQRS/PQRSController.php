<?php
include_once '../model/PQRS/PQRSModel.php';
class PQRSController
{
    public function postCreate()
    {
        $obj = new PQRSModel();

        if (!isset($_POST['pqrsId'], $_POST['texto'], $_POST['usu_id'])) {
            die("Faltan datos en el formulario.");
        }

        $idTipo = $_POST['pqrsId'];
        $texto = $_POST['texto'];
        $usu_id = $_POST['usu_id'];

        if (empty($idTipo) || empty($texto) || empty($usu_id)) {
            die("Los campos no pueden estar vacíos.");
        }

        $id = $obj->autoIncrement("pqrs", "id_pqrs");

        $sql = "INSERT INTO pqrs (id_pqrs, desc_pqrs, tipo_pqrs, usu_id, fecha_hora) VALUES ($id, '$texto', $idTipo, $usu_id, date_trunc('second', NOW()))";

        $ejecutar = $obj->insert($sql);
        if ($ejecutar) {
            $_SESSION['pqrs'][] = "Registro exitoso";
            redirect("index.php");
        } else {
            echo "Registro fallido";
            echo $sql;
        }
    }


    public function getPQRS()
    {
        $obj = new PQRSModel();
        $usu_id = $_SESSION['id'];
        if ($_SESSION['rol'] != 1) {
            $sql = "SELECT p.*,  STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, tp.desc_tipo_pqrs FROM PQRS p
                JOIN usuarios u ON  p.usu_id = u.usu_id
                JOIN tipo_pqrs tp ON tp.id_tipo_pqrs= p.tipo_pqrs
                WHERE u.usu_id = $usu_id
                GROUP BY p.id_pqrs, tp.desc_tipo_pqrs, p.desc_pqrs, p.tipo_pqrs, p.usu_id, p.fecha_hora";
        } else {
            $sql = "SELECT p.*,  STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, tp.desc_tipo_pqrs FROM PQRS p
                JOIN usuarios u ON  p.usu_id = u.usu_id
                JOIN tipo_pqrs tp ON tp.id_tipo_pqrs= p.tipo_pqrs
                GROUP BY p.id_pqrs, tp.desc_tipo_pqrs, p.desc_pqrs, p.tipo_pqrs, p.usu_id, p.fecha_hora";
        }

        $pqrs = $obj->consult($sql);

        include_once '../view/Solicitudes/consultPQRS.php';
    }

    public function filtroFecha()
    {
        $obj = new PQRSModel();
        $fecha1 = $_POST['fecha1'];
        $fecha2 = $_POST['fecha2'];
        $num = $_POST['num'];
        $usu_id = $_SESSION['id'];

        if ($_SESSION['rol'] != 1) {
            $sql = "SELECT p.*,  STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, tp.desc_tipo_pqrs FROM PQRS p
                JOIN usuarios u ON  p.usu_id = u.usu_id
                JOIN tipo_pqrs tp ON tp.id_tipo_pqrs= p.tipo_pqrs
                WHERE p.fecha_hora >= '$fecha1' AND p.fecha_hora < '$fecha2' AND u.usu_id = $usu_id

                GROUP BY p.id_pqrs, tp.desc_tipo_pqrs, p.desc_pqrs, p.tipo_pqrs, p.usu_id, p.fecha_hora";
        } else {
            $sql = "SELECT p.*,  STRING_AGG(DISTINCT CONCAT_WS(' ', u.usu_nombre1, u.usu_nombre2, u.usu_apellido1), ', ') AS usuario_nombre, tp.desc_tipo_pqrs FROM PQRS p
                JOIN usuarios u ON  p.usu_id = u.usu_id
                JOIN tipo_pqrs tp ON tp.id_tipo_pqrs= p.tipo_pqrs
                WHERE p.fecha_hora >= '$fecha1' AND p.fecha_hora < '$fecha2'
                GROUP BY p.id_pqrs, tp.desc_tipo_pqrs, p.desc_pqrs, p.tipo_pqrs, p.usu_id, p.fecha_hora";
        }

        $pqrs = $obj->consult($sql);
        include_once '../view/Solicitudes/buscarPQRS.php';
        


    }
}

?>