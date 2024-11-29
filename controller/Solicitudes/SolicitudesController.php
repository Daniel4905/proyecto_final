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
            include_once '../view/Solicitudes/accidentes.php';
        } elseif ($tipoSolicitud == 2) {
            include_once '../view/Solicitudes/señalesNuevo.php';
        } elseif ($tipoSolicitud == 3) {
            include_once '../view/Solicitudes/señalesDaños.php';
        } elseif ($tipoSolicitud == 4) {
            include_once '../view/Solicitudes/reductoresNuevo.php';
        } elseif ($tipoSolicitud == 5) {
            include_once '../view/Solicitudes/reductoresDaños.php';
        } else if ($tipoSolicitud == 6) {
            include_once '../view/Solicitudes/vias.php';
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

        include_once '../view/Solicitudes/vias.php';
    }

    public function getAccidentes()
    {
        $obj = new SolicitudesModel();

        include_once '../view/Solicitudes/accidentes.php';
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