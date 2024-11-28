<?php
    include_once '../model/PQRS/PQRSModel.php';
    class PQRSController{
        public function postCreate() {
            $obj = new PQRSModel();

            $idTipo = $_POST['pqrsId'];
            $texto = $_POST['texto'];
            $usu_id = $_POST['usu_id']; 

            $id = $obj->autoIncrement("pqrs", "id_pqrs");

            $sql = "INSERT INTO pqrs VALUES($id, '$texto', $idTipo, $usu_id)";

            $ejecutar = $obj->insert($sql);
            if($ejecutar){
                $_SESSION['pqrs'][]="Registro exitoso";
                redirect("index.php");
            }else{
                echo"Registro fallido";
                echo $sql;
            }
        }
    }

?>