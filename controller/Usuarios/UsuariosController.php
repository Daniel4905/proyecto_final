<?php


include_once '../model/Usuarios/UsuariosModel.php';

class UsuariosController
{
    public function getCreate()
    {
        $obj = new UsuariosModel();
        $sql = "SELECT * FROM rol";
        $sqldoc = "SELECT * FROM tipo_documento";
        $sqlsex = "SELECT * FROM sexo";

        $roles = $obj->consult($sql);
        $docs = $obj->consult($sqldoc);
        $sexo = $obj->consult($sqlsex);



        include_once '../view/usuarios/create.php';
    }

    public function postCreate()
    {
        $obj = new UsuariosModel();
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
        if (!empty($referencias)) {
            $ref = "Ref.";
        } else {
            $ref = "";
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
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
        } else {
            redirect(getUrl("Usuarios", "Usuarios", "getCreate"));
        }
    }

    public function getUsuarios()
    {
        $obj = new UsuariosModel();

        $sql = "SELECT u.*,s.sex_desc,td.doc_abrev, r.rol_nombre FROM usuarios u
            JOIN rol r ON u.rol_id = r.rol_id JOIN sexo s ON u.sex_id = s.sex_id JOIN tipo_documento td ON u.doc_id= td.doc_id ORDER BY u.usu_id ASC";

        $usuario = $obj->consult($sql);
        include_once '../view/usuarios/consult.php';
    }

    public function viewProfile()
    {
        $obj = new UsuariosModel();
        $usu_id = $_GET['usu_id'];

        $sql = "SELECT u.*,s.sex_desc,td.nombre_tipo, r.rol_nombre FROM usuarios u
            JOIN rol r ON u.rol_id = r.rol_id JOIN sexo s ON u.sex_id = s.sex_id JOIN tipo_documento td ON u.doc_id= td.doc_id WHERE usu_id = $usu_id";

        $perfil = $obj->consult($sql);
        include_once '../view/usuarios/viewProfile.php';
    }



    public function buscar()
    {
        $obj = new UsuariosModel();
        $buscar = $_POST['buscar'];

        $buscar = strtolower($_POST['buscar']); // Convertir el término a minúsculas en PHP
        $sql = "SELECT u.*, r.rol_nombre FROM usuarios u
        JOIN rol r ON u.rol_id = r.rol_id WHERE LOWER(u.usu_nombre1) LIKE '%$buscar%' 
        OR LOWER(u.usu_nombre2) LIKE '%$buscar%' 
        OR LOWER(u.usu_apellido1) LIKE '%$buscar%' 
        OR LOWER(u.usu_apellido2) LIKE '%$buscar%' 
        OR LOWER(u.usu_documento) LIKE '%$buscar%' ORDER BY u.usu_id ASC";

        $usuario = $obj->consult($sql);
        include_once '../view/usuarios/buscar.php';
    }

    public function postDelete()
    {
        $obj = new UsuariosModel();

        $usu_id = $_GET['usu_id'];

        $sql = "DELETE FROM usuarios WHERE usu_id = $usu_id";

        $ejecutar = $obj->delete($sql);

        if ($ejecutar) {
            echo "<script> alert('Usuario elimniado exitosamente') </script>";
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
        } else {
            echo "<script> alert('No se pudo eliminar el usuario') </script>";
        }
    }
    public function getUpdate()
    {
        $obj = new UsuariosModel();

        $usu_id = $_GET['usu_id'];

        $sql = "SELECT * FROM usuarios WHERE usu_id = $usu_id";

        $sqldoc = "SELECT * FROM tipo_documento ORDER BY doc_id ASC";

        $sqlRol = "SELECT * FROM rol";

        $roles = $obj->consult($sqlRol);
        $usuarios = $obj->consult($sql);
        $docs = $obj->consult($sqldoc);


        include_once '../view/usuarios/update.php';
    }

    public function postUpdate()
    {
        $obj = new UsuariosModel();


        $usu_id = $_POST['usu_id'];
        $usu_doc = $_POST['usu_documento'];
        $usu_nombre1 = $_POST['usu_nombre1'];
        $usu_nombre2 = $_POST['usu_nombre2'];
        $usu_apellido1 = $_POST['usu_apellido1'];
        $usu_apellido2 = $_POST['usu_apellido2'];
        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_clave'];
        $usu_clavenew = $_POST['usu_clavenew'];
        $usu_tel = $_POST['usu_tel'];
        // $usu_rol = $_POST['rol_id'];

        if (empty($_POST['rol_id'])) {
            $usu_rol = 1;
        } else {
            $usu_rol = $_POST['rol_id'];
        }

        $doc_id = $_POST['doc_id'];


        $sqlcontra = "SELECT usu_clave FROM usuarios WHERE usu_id = $usu_id";
        $resultado = $obj->consult($sqlcontra);
        if ($resultado && isset($resultado[0])) {
            $contraBase = $resultado[0]['usu_clave'];
        } else {
            echo "No se encontraron resultados";
        }
        $validacion = true;

        if (!empty($usu_clave)) {
            if (!password_verify($usu_clave, $contraBase)) {
                $_SESSION['error'][] = "La contraseña actual ingresada no es correcta";
                $validacion = false;
            }
        }
        if (empty($usu_clavenew)) {
            $hash = $contraBase;
        } else {
            $hash = password_hash($usu_clavenew, PASSWORD_DEFAULT);
        }
        $sql = "";
        if (empty($usu_apellido2) && empty($usu_nombre2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = NULL, usu_apellido1 = '$usu_apellido1', usu_apellido2 = NULL, usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id WHERE usu_id = $usu_id";
        } else if (empty($usu_nombre2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = NULL, usu_apellido1 = '$usu_apellido1', usu_apellido2 = '$usu_apellido2', usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id WHERE usu_id = $usu_id";
        } else if (empty($usu_apellido2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = '$usu_nombre2', usu_apellido1 = '$usu_apellido1', usu_apellido2 = NULL, usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id WHERE usu_id = $usu_id";
        } else {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = '$usu_nombre2', usu_apellido1 = '$usu_apellido1', usu_apellido2 = '$usu_apellido2', usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id WHERE usu_id = $usu_id";
        }
        if ($validacion) {
            $ejecutar = $obj->update($sql);
            if ($ejecutar) {
                if ($usu_id == $_SESSION['id']) {
                    $_SESSION['nombre'] = $usu_nombre1;
                    $_SESSION['apellido'] = $usu_apellido1;
                }
                redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            } else {
                redirect(getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu_id)));
            }
        } else {
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate", array("usu_id" => $usu_id)));
        }
    }
    public function postUpdateStatus()
    {
        $obj = new UsuariosModel();

        $usu_id = $_POST['user'];
        $est_id = $_POST['id'];

        if ($est_id == 1) {
            $statusToModify = 2;
        } elseif ($est_id == 2) {
            $statusToModify = 1;
        }
        $sql = "UPDATE usuarios SET est_id= $statusToModify WHERE usu_id= $usu_id";
        $ejecutar = $obj->update($sql);
 
        if ($ejecutar) {
            $sql = "SELECT u.*, r.rol_nombre FROM usuarios u
                     JOIN rol r ON u.rol_id = r.rol_id ORDER BY u.usu_id ASC";
            $usuario = $obj->consult($sql);

            include_once "../view//usuarios/buscar.php";
        } else {
            echo "No se puede actualizar el estado";
        }
    }
    public function getUpdateUsu()
    {
        $obj = new UsuariosModel();

        $usu_id = $_GET['usu_id'];

        $sql = "SELECT * FROM usuarios WHERE usu_id = $usu_id";

        $sqldoc = "SELECT * FROM tipo_documento ORDER BY doc_id ASC";

        $sqlsex = "SELECT * FROM sexo";


        $docs = $obj->consult($sqldoc);
        $sexo = $obj->consult($sqlsex);
        $usuarios = $obj->consult($sql);
        $docs = $obj->consult($sqldoc);


        include_once '../view/usuarios/actualizarDatosUsu.php';
    }


    public function postUpdateUsu()
    {

    }

    public function detallesUsuario()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['usu_id'];
        $sql = "SELECT u.*,s.sex_desc, td.nombre_tipo, td.doc_abrev, r.rol_nombre FROM usuarios u
            JOIN rol r ON u.rol_id = r.rol_id JOIN sexo s ON u.sex_id = s.sex_id JOIN tipo_documento td ON u.doc_id= td.doc_id WHERE usu_id = $usu_id";
        $usuarios = $obj->consult($sql);
        foreach ($usuarios as $usuario) {
            if ($usuario) {
            echo "<p><strong>Documento:</strong> " . $usuario['doc_abrev'] . " " . $usuario['usu_documento'] . "</p>" .
            "<p><strong>Nombres:</strong> " . $usuario['usu_nombre1'] . " " . $usuario['usu_nombre2'] . "</p>" .
            "<p><strong>Apellidos:</strong> " . $usuario['usu_apellido1'] . " " . $usuario['usu_apellido2'] . "</p>" .
            "<p><strong>Correo:</strong> " . $usuario['usu_correo'] . "</p>" .
            "<p><strong>Teléfono:</strong> " . $usuario['usu_tel'] . "</p>" .
            "<p><strong>Dirección:</strong> " . $usuario['usu_direccion'] . "</p>" .
            "<p><strong>Sexo biologico:</strong> " . $usuario['sex_desc'] . "</p>" .
            "<p><strong>Rol:</strong> " . $usuario['rol_nombre'] . "</p>";
            } else {
                echo "<p class='text-danger'>No se encontraron detalles para este usuario.</p>";
            }
        }
    }
}
