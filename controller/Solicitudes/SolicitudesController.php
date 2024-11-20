<?php
include_once '../model/Solicitudes/SolicitudesModel.php';
     class SolicitudesController{
        public function getSeñalesDaño(){
            $obj = new SolicitudesModel();
            
            include_once '../view/Solicitudes/señalesDaños.php';
        }
        public function getSeñalesNuevo(){
            $obj = new SolicitudesModel();
            
            include_once '../view/Solicitudes/señalesNuevo.php';
        }
        public function reporteDano(){
         echo"Funciona";
        }
        public function solicitarSenal(){
            echo"Funciona 2";
        }

        public function getVias(){
            $obj = new SolicitudesModel();
            
            include_once '../view/Solicitudes/vias.php';
        }

        public function getAccidentes(){
            $obj = new SolicitudesModel();
            
            include_once '../view/Solicitudes/accidentes.php';
        }

        public function getReductoresNuevo(){
            $obj = new SolicitudesModel();
            
            include_once '../view/Solicitudes/reductoresDaños.php';
        }
        public function getReductoresDaño(){
            $obj = new SolicitudesModel();
            
            include_once '../view/Solicitudes/reductoresNuevo.php';
        }
    }
?>