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

        $docs = $obj->consult($sqldoc);

        include_once '../view/acceso/registrar.php';
    }
    public function postCreate()
    {
        $obj = new AccesoModel();

        $usu_nombre = $_POST['usu_nombre'];
        $usu_apellido = $_POST['usu_apellido'];
        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_clave'];


        $hash = password_hash($usu_clave, PASSWORD_DEFAULT);

        $validacion = true;
        if (empty($usu_nombre)) {
            $_SESSION['errores'][] = "El campo nombre es requerido";
            $validacion = false;

        }
        if (empty($usu_apellido)) {
            $_SESSION['errores'][] = "El campo apellido es requerido";
            $validacion = false;
        }
        if (empty($usu_correo)) {
            $_SESSION['errores'][] = "El campo correo es requerido";
            $validacion = false;
        }

        if (empty($usu_clave)) {
            $_SESSION['errores'][] = "El campo clave es requerido";
            $validacion = false;
        }


        if (!validarCampos($usu_nombre, $usu_apellido, $usu_correo, $usu_clave)) {
            $validacion = false;
        }

        $id = $obj->autoIncrement("usuario", "usu_id");

        $sql = "INSERT INTO usuario VALUES($id, '$usu_nombre', '$usu_apellido', '$usu_correo', '$hash', 3, 1)";

        if ($validacion) {
            $ejecutar = $obj->insert($sql);

            if ($ejecutar) {
                echo "<script> alert('Registro exitoso'); </script>";
                redirect("login.php");

            } else {
                echo "Se ha producido un error al insertar";
            }
        } else {
            redirect(getUrl("Acceso", "Acceso", "getCreate", false, "ajax"));

        }

    }

}
?>