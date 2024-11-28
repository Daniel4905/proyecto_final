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
                    $_SESSION['nombre'] = $usu["usu_nombre1"] . " " . $usu["usu_nombre2"];
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
        $doc_id = $_POST['doc_id'];
        $sex_id = $_POST['sex_id'];

        $tipoV = $_POST['tipoVia'];
        $numeroPr = $_POST['numeroPrincipal'];
        $comp1 = $_POST['complemento1'];
        $comp2 = $_POST['complemento2'];
        $numeroSc = $_POST['numeroSecundario'];
        $numeroTerc = $_POST['numeroTerciario'];
        $referencias = $_POST['referencias'];
        if (!empty($referencias)) {
            $ref = "Ref.";
        } else {
            $ref = "";
        }

        $direccion = "$tipoV $numeroPr $comp1 $numeroSc $comp2 $numeroTerc $ref $referencias";
        $validacion = true;

        if (empty($usu_nombre1)) {
            $_SESSION['errores'][] = "El campo primer nombre es requerido";
            $validacion = false;
        }
        if (empty($usu_apellido1)) {
            $_SESSION['errores'][] = "El campo primer apellido es requerido";
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
        if (empty($doc_id)) {
            $_SESSION['errores'][] = "El campo documento es requerido";
            $validacion = false;
        }
        if (empty($sex_id)) {
            $_SESSION['errores'][] = "El campo sexo biologico es requerido";
            $validacion = false;
        }
        if (empty($usu_tel)) {
            $_SESSION['errores'][] = "El campo telefono es requerido";
            $validacion = false;
        }
        if (empty($tipoV)) {
            $_SESSION['errores'][] = "El campo tipoVia es requerido";
            $validacion = false;
        }
        if (empty($numeroPr)) {
            $_SESSION['errores'][] = "El campo numero principal es requerido";
            $validacion = false;
        }
        if (empty($numeroSc)) {
            $_SESSION['errores'][] = "El campo numero 1 es requerido";
            $validacion = false;
        }
        if (empty($numeroTerc)) {
            $_SESSION['errores'][] = "El campo numero 2 es requerido";
            $validacion = false;
        }

        if (!validarCampos($usu_nombre1, $usu_nombre2, $usu_apellido1, $usu_apellido2, $usu_correo, $usu_clave, $usu_tel, $usu_doc)) {
            $validacion = false;
        }


        $hash = password_hash($usu_clave, PASSWORD_DEFAULT);


        $id = $obj->autoIncrement("usuarios", "usu_id");
        $sql = "";
        if (empty($usu_apellido2)) {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', '$usu_nombre2', '$usu_apellido1', NULL, '$usu_correo', '$hash', '$usu_tel', '$direccion', 2, 1, $doc_id, $sex_id)";
        } else if (empty($usu_nombre2)) {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', NULL, '$usu_apellido1', '$usu_apellido2', '$usu_correo', '$hash', '$usu_tel', '$direccion', 2, 1, $doc_id, $sex_id)";
        } else if (empty($usu_nombre2) && empty($usu_apellido2)) {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', NULL, '$usu_apellido1', NULL, '$usu_correo', '$hash', '$usu_tel','$direccion', 2, 1, $doc_id)";
        } else {
            $sql = "INSERT INTO usuarios VALUES($id, '$usu_doc', '$usu_nombre1', '$usu_nombre2', '$usu_apellido1', '$usu_apellido2', '$usu_correo', '$hash', '$usu_tel', '$direccion', 2, 1, $doc_id, $sex_id)";
        }
        if ($validacion) {
            $ejecutar = $obj->insert($sql);

            if ($ejecutar) {
                $_SESSION['RegExitoso'][] = "Registro exitoso";
                redirect("index.php");
            } else {
                $_SESSION['errores'][] = "No se pudo realizar el registro";
                redirect(getUrl('Acceso', 'Acceso', 'getCreate', false, "ajax"));
            }
        }else{
            $_SESSION['errores'][] = "No se pudo realizar el registro";
                redirect(getUrl('Acceso', 'Acceso', 'getCreate', false, "ajax"));
        }

    }

}
?>