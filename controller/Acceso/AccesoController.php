<?php

include_once '../model/Acceso/AccesoModel.php';

class AccesoController
{
    public function login()
    {

        $obj = new AccesoModel();

        $user = $_POST['numeroId'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE usu_documento = '$user' AND est_id=1";
        $usuario = $obj->consult($sql);

        if ($usuario && count($usuario) > 0) {
            foreach ($usuario as $usu) {
                if (password_verify($password, $usu['usu_clave'])) {
                    $_SESSION['id'] = $usu["usu_id"];
                    $_SESSION['nombre'] = $usu["usu_nombre1"]." ".$usu["nombre2"];
                    $_SESSION['apellido'] = $usu["usu_apellido1"];
                    $_SESSION['correo'] = $usu["usu_correo"];
                    $_SESSION['estado'] = $usu["est_id"];
                    $_SESSION['rol'] = $usu["rol_id"];
                    $_SESSION['sexo'] = $usu["sex_id"];
                    $_SESSION['auth'] = "ok";
                    
                    redirect('index.php');
                } else {
                    $_SESSION['error'] = "Usuario y/o contraseña incorrectos.";
                    redirect('login.php');
                    exit();
                }
            }
        } else {
            $_SESSION['error'] = "Usuario y/o contraseña invalidos";
            redirect('login.php');
            exit();
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('login.php');

    }
    public function getCreate()
    {
        $obj = new AccesoModel();
        $sqldoc = "SELECT * FROM tipo_documento";
        $sqlsex = "SELECT * FROM sexo";

        $docs = $obj->consult($sqldoc);
        $sexo = $obj->consult($sqlsex);

        $docs = $obj->consult($sqldoc);

        include_once '../view/acceso/registrar.php';
    }
    public function postCreate()
    {
        $obj = new AccesoModel();
        $usu_doc = $_POST['usu_documento'];
        $usu_nombre1 = $_POST['usu_nombre1'];
        $usu_nombre2 = $_POST['usu_nombre2'];
        $usu_apellido1 = $_POST['usu_apellido1'];
        $usu_apellido2 = $_POST['usu_apellido2'];

        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_clave'];
        $usu_tel = $_POST['usu_tel'];
        $usu_rol = $_POST['rol_id'];
        $doc_id = $_POST['doc_id'];
        $sex_id = $_POST['sex_id'];

        $tipoV = $_POST['tipoVia'];
        $numeroPr = $_POST['numeroPrincipal'];
        $comp1 = $_POST['complemento1'];
        $comp2 = $_POST['complemento2'];
        $numeroSc = $_POST['numeroSecundario'];
        $numeroTerc = $_POST['numeroTerciario'];
        $referencias = $_POST['referencias'];
        if(!empty($referencias)){
            $ref = "Ref.";
        }else{
            $ref="";
        }

        $direccion = "$tipoV $numeroPr $comp1 $numeroSc $comp2 $numeroTerc $ref $referencias";


        $hash = password_hash($usu_clave, PASSWORD_DEFAULT);


        $id = $obj->autoIncrement("usuarios", "usu_id");
        $sql = "";
        if (empty($usu_apellido2)) {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', '$usu_nombre2', '$usu_apellido1', NULL, '$usu_correo', '$hash', '$usu_tel', '$direccion', $usu_rol, 1, $doc_id, $sex_id)";
        } else if (empty($usu_nombre2)) {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', NULL, '$usu_apellido1', '$usu_apellido2', '$usu_correo', '$hash', '$usu_tel', '$direccion', $usu_rol, 1, $doc_id, $sex_id)";
        } else if (empty($usu_nombre2) && empty($usu_apellido2)) {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', NULL, '$usu_apellido1', NULL, '$usu_correo', '$hash', '$usu_tel','$direccion', $usu_rol, 1, $doc_id)";
        } else {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', '$usu_nombre2', '$usu_apellido1', '$usu_apellido2', '$usu_correo', '$hash', '$usu_tel', '$direccion', $usu_rol, 1, $doc_id, $sex_id)";
        }

        $ejecutar = $obj->insert($sql);

        if ($ejecutar) {
            $_SESSION['RegExitoso'][]="Registro exitoso";
            redirect("index.php");
        } else {
            $_SESSION['ErrorReg'][]="No se pudo realizar el registro";
            redirect(getUrl('Acceso', 'Acceso', 'getCreate', false, "ajax"));
        }
    }

}
?>