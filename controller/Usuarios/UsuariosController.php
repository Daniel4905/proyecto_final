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
        if (empty($usu_rol)) {
            $_SESSION['errores'][] = "El campo rol es requerido";
            $validacion = false;
        }

        if (!validarCampos($usu_nombre1, $usu_nombre2, $usu_apellido1, $usu_apellido2, $usu_correo, $usu_clave, $usu_tel, $usu_doc)) {
            $validacion = false;
        }

        $direccion = "$tipoV $numeroPr $comp1 $numeroSc $comp2 $numeroTerc $ref $referencias";


        $hash = hash('sha256', $usu_clave);


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

        if ($validacion) {
            $ejecutar = $obj->insert($sql);

            if ($ejecutar) {
                $_SESSION['regEx'][] = 'Registro exitoso';
                redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            } else {
                //redirect(getUrl("Usuarios", "Usuarios", "getCreate"));
            }
        } else {
            //redirect(getUrl("Usuarios", "Usuarios", "getCreate"));
        }

    }

    public function getUsuarios()
    {
        $obj = new UsuariosModel();

        $sql = "SELECT u.*, s.sex_desc, td.doc_abrev, r.rol_nombre, est.est_id 
        FROM usuarios u
        LEFT JOIN rol r ON u.rol_id = r.rol_id 
        LEFT JOIN sexo s ON u.sex_id = s.sex_id 
        LEFT JOIN tipo_documento td ON u.doc_id = td.doc_id
        LEFT JOIN estados est ON u.est_id = est.est_id
        ORDER BY u.usu_id ASC;";
        $_SESSION['sql'] = $sql;


        $usuario = $obj->consult($sql);
        include_once '../view/usuarios/consult.php';
    }

    public function viewProfile()
    {
        $obj = new UsuariosModel();
        $usu_id = $_GET['usu_id'];

        $sql = "SELECT u.*, s.sex_desc, td.doc_abrev, r.rol_nombre, est.est_id, td.nombre_tipo FROM usuarios u
                JOIN rol r ON u.rol_id = r.rol_id 
                JOIN sexo s ON u.sex_id = s.sex_id 
                JOIN tipo_documento td ON u.doc_id = td.doc_id
                JOIN estados est ON u.est_id = est.est_id
                 WHERE usu_id = $usu_id";

        $perfil = $obj->consult($sql);
        include_once '../view/usuarios/viewProfile.php';
    }

    public function viewProfile2()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['id'];

        $sql = "SELECT u.*, s.sex_desc, td.doc_abrev, r.rol_nombre, est.est_id, td.nombre_tipo FROM usuarios u
                JOIN rol r ON u.rol_id = r.rol_id 
                JOIN sexo s ON u.sex_id = s.sex_id 
                JOIN tipo_documento td ON u.doc_id = td.doc_id
                JOIN estados est ON u.est_id = est.est_id
                 WHERE usu_id = $usu_id";

        $perfil = $obj->consult($sql);
        include_once '../view/usuarios/viewProfile.php';
    }

    public function getActualizarContra()
    {
        include_once '../view/usuarios/contra.php';
    }



    public function buscar()
    {
        $obj = new UsuariosModel();
        $buscar = $_POST['buscar'];

        $buscar = strtolower($_POST['buscar']);
        $sql = "SELECT u.*, r.rol_nombre FROM usuarios u
        JOIN rol r ON u.rol_id = r.rol_id
        JOIN sexo s ON u.sex_id = s.sex_id 
        JOIN tipo_documento td ON u.doc_id = td.doc_id
        JOIN estados est ON u.est_id = est.est_id
        WHERE LOWER(u.usu_nombre1) LIKE '%$buscar%' 
        OR LOWER(u.usu_nombre2) LIKE '%$buscar%' 
        OR LOWER(u.usu_apellido1) LIKE '%$buscar%' 
        OR LOWER(u.usu_apellido2) LIKE '%$buscar%' 
        OR LOWER(u.usu_documento) LIKE '%$buscar%' ORDER BY u.usu_id ASC";

        $_SESSION['sql'] = $sql;
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

        $sqlsex = "SELECT * FROM sexo";



        $sexo = $obj->consult($sqlsex);
        $roles = $obj->consult($sqlRol);
        $usuarios = $obj->consult($sql);
        $docs = $obj->consult($sqldoc);

        include_once '../view/usuarios/update.php';
    }

    public function postUpdate()
    {
        $obj = new UsuariosModel();


        $usu_id = $_POST['usu_id'];
        $usu_idAd = $_POST['usu_idAd'];
        $usu_doc = $_POST['usu_documento'];
        $usu_nombre1 = $_POST['usu_nombre1'];
        $usu_nombre2 = $_POST['usu_nombre2'];
        $usu_apellido1 = $_POST['usu_apellido1'];
        $usu_apellido2 = $_POST['usu_apellido2'];
        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_clave'];
        $usu_clavenew = $_POST['usu_clavenew'];
        $usu_tel = $_POST['usu_tel'];
        $usu_rol = $_POST['rol_id'];

        if (empty($_POST['rol_id'])) {
            $usu_rol = 1;
        } else {
            $usu_rol = $_POST['rol_id'];
        }

        $doc_id = $_POST['doc_id'];

        $validacion = true;



        $sqlAD = "SELECT usu_clave FROM usuarios WHERE usu_id = $usu_idAd";
        $result = $obj->consult($sqlAD);
        if ($result && isset($result[0])) {
            $contraAdmin = $result[0]['usu_clave'];
        } else {
            echo "No se encontraron resultados";
        }

        $sqlcontra = "SELECT usu_clave FROM usuarios WHERE usu_id = $usu_id";
        $resultado = $obj->consult($sqlcontra);
        if ($resultado && isset($resultado[0])) {
            $contraBase = $resultado[0]['usu_clave'];
        } else {
            echo "No se encontraron resultados";
        }
        $hash1 = hash('sha256', $usu_clave);

        if ($hash1 != $contraAdmin) {
            $_SESSION['errores'][] = "La contraseña actual ingresada no es correcta";
            $validacion = false;
        }

        if (isset($_POST['sex_id'])) {
            $sex_id = $_POST['sex_id'];
        } else {
            $sqlsex = "SELECT sex_id FROM usuarios WHERE usu_id = $usu_id";
            $resultadoSex = $obj->consult($sqlsex);
            if ($resultadoSex && isset($resultadoSex[0])) {
                $sex_id = $resultadoSex[0]['sex_id'];
            } else {
                echo "No se encontraron resultados";
            }
        }


        if (isset($_POST['cambiarCont'])) {
            $usu_clavenew = $_POST['usu_clavenew'];
            $hash = hash('sha256', $usu_clavenew);
        } else {
            $hash = $contraBase;
        }
        $sql = "";
        if (empty($usu_apellido2) && empty($usu_nombre2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = NULL, usu_apellido1 = '$usu_apellido1', usu_apellido2 = NULL, usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id, sex_id = $sex_id WHERE usu_id = $usu_id";
        } else if (empty($usu_nombre2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = NULL, usu_apellido1 = '$usu_apellido1', usu_apellido2 = '$usu_apellido2', usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id, sex_id = $sex_id WHERE usu_id = $usu_id";
        } else if (empty($usu_apellido2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = '$usu_nombre2', usu_apellido1 = '$usu_apellido1', usu_apellido2 = NULL, usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id, sex_id = $sex_id WHERE usu_id = $usu_id";
        } else {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = '$usu_nombre2', usu_apellido1 = '$usu_apellido1', usu_apellido2 = '$usu_apellido2', usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel',  rol_id = $usu_rol, doc_id = $doc_id, sex_id = $sex_id WHERE usu_id = $usu_id";
        }
        if ($validacion) {
            $ejecutar = $obj->update($sql);
            if ($ejecutar) {
                if ($usu_id == $_SESSION['id']) {
                    $_SESSION['nombre'] = $usu_nombre1 . " " . $usu_nombre2;
                    $_SESSION['apellido'] = $usu_apellido1;
                }
                $_SESSION['ActEx'][] = "Actualización exitosa";
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

            if (!empty($_SESSION['sql'])) {
                $sql = $_SESSION['sql'];
            }

            $usuario = $obj->consult($sql);

            include_once "../view//usuarios/buscar.php";
        } else {
            echo "No se puede actualizar el estado";

        }
    }


    public function getUpdateUsu()
    {
        $obj = new UsuariosModel();

        $usu_id = $_POST['id'];

        $sql = "SELECT * FROM usuarios WHERE usu_id = $usu_id";

        $sqldoc = "SELECT * FROM tipo_documento ORDER BY doc_id ASC";

        $sqlsex = "SELECT * FROM sexo";


        $docs = $obj->consult($sqldoc);
        $sexo = $obj->consult($sqlsex);
        $usuarios = $obj->consult($sql);
        $docs = $obj->consult($sqldoc);

        include_once '../view/usuarios/actualizarDatosUsu.php';
    }

    public function getConf()
    {
        $obj = new UsuariosModel();

        include_once '../view/usuarios/configuracionPerfil.php';
    }

    public function getConf2()
    {
        $obj = new UsuariosModel();

        include_once '../view/usuarios/confP.php';
    }

    public function postUpdateUsu()
    {
        $obj = new UsuariosModel();

        $usu_id = $_SESSION['id'];
        $usu_doc = $_POST['usu_documento'];
        $usu_nombre1 = $_POST['usu_nombre1'];
        $usu_nombre2 = $_POST['usu_nombre2'];
        $usu_apellido1 = $_POST['usu_apellido1'];
        $usu_apellido2 = $_POST['usu_apellido2'];
        $usu_correo = $_POST['usu_correo'];
        $usu_clave = $_POST['usu_clave'];

        $usu_tel = $_POST['usu_tel'];

        if (isset($_POST['cambiarDir'])) {
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
        } else {
            $sqldire = "SELECT usu_direccion FROM usuarios WHERE usu_id = $usu_id";
            $resultado = $obj->consult($sqldire);
            if ($resultado && isset($resultado[0])) {
                $direccion = $resultado[0]['usu_direccion'];
            } else {
                echo "No se encontraron resultados";
            }
        }



        if (isset($_POST['doc_id'])) {
            $doc_id = $_POST['doc_id'];
        } else {
            $sqldoc = "SELECT doc_id FROM usuarios WHERE usu_id = $usu_id";
            $resultadoDoc = $obj->consult($sqldoc);
            if ($resultadoDoc && isset($resultadoDoc[0])) {
                $doc_id = $resultadoDoc[0]['doc_id'];
            } else {
                echo "No se encontraron resultados";
            }
        }

        if (isset($_POST['sex_id'])) {
            $sex_id = $_POST['sex_id'];
        } else {
            $sqlsex = "SELECT sex_id FROM usuarios WHERE usu_id = $usu_id";
            $resultadoSex = $obj->consult($sqlsex);
            if ($resultadoSex && isset($resultadoSex[0])) {
                $sex_id = $resultadoSex[0]['sex_id'];
            } else {
                echo "No se encontraron resultados";
            }
        }



        $sqlcontra = "SELECT usu_clave FROM usuarios WHERE usu_id = $usu_id";
        $resultado = $obj->consult($sqlcontra);

        if ($resultado && isset($resultado[0])) {
            $contraBase = $resultado[0]['usu_clave'];
        } else {
            echo "No se encontraron resultados";
        }
        $validacion = true;

        $hash1 = hash('sha256', $usu_clave);

        if ($hash1 != $contraBase) {
            $_SESSION['errores'][] = "La contraseña actual ingresada no es correcta";
            $validacion = false;
        }
        $hash = $contraBase;

        $sql = "";
        if (empty($usu_apellido2) && empty($usu_nombre2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = NULL, usu_apellido1 = '$usu_apellido1', usu_apellido2 = NULL, usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel', usu_direccion='$direccion', doc_id = $doc_id, sex_id = $sex_id WHERE usu_id = $usu_id";
        } else if (empty($usu_nombre2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = NULL, usu_apellido1 = '$usu_apellido1', usu_apellido2 = '$usu_apellido2', usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel', usu_direccion='$direccion', doc_id = $doc_id, sex_id = $sex_id  WHERE usu_id = $usu_id";
        } else if (empty($usu_apellido2)) {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = '$usu_nombre2', usu_apellido1 = '$usu_apellido1', usu_apellido2 = NULL, usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel', usu_direccion='$direccion', doc_id = $doc_id, sex_id = $sex_id  WHERE usu_id = $usu_id";
        } else {
            $sql = "UPDATE usuarios SET usu_documento = '$usu_doc', usu_nombre1 = '$usu_nombre1', usu_nombre2 = '$usu_nombre2', usu_apellido1 = '$usu_apellido1', usu_apellido2 = '$usu_apellido2', usu_correo = '$usu_correo', usu_clave = '$hash',  usu_tel = '$usu_tel', usu_direccion='$direccion', doc_id = $doc_id, sex_id = $sex_id  WHERE usu_id = $usu_id";
        }
        if ($validacion) {
            $ejecutar = $obj->update($sql);
            if ($ejecutar) {
                if ($usu_id == $_SESSION['id']) {
                    $_SESSION['nombre'] = $usu_nombre1 . " " . $usu_nombre2;
                    $_SESSION['apellido'] = $usu_apellido1;
                    $_SESSION['sexo'] = $sex_id;
                }
                echo "Actualización exitosa";
            } else {
                echo "No se pudo actualizar al usuario";
            }
        } else {
            echo "No se pudo actualizar al usuario";
        }
    }

    public function validarCont()
    {
        $obj = new UsuariosModel();

        $usu_id = $_POST['id'];
        $usu_clave = $_POST['clave'];

        $sql = "SELECT * FROM usuarios WHERE usu_id = $usu_id";
        $resultado = $obj->consult($sql);
        $hash = hash('sha256', $usu_clave);
        if ($resultado && isset($resultado[0])) {
            $contraBase = $resultado[0]['usu_clave'];

            if ($contraBase === $hash) {
                echo "Contraseña válida";
            } else {
                echo "La contraseña ingresada no es correcta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    }

    public function ordenarAlf()
    {
        $obj = new UsuariosModel();

        $criterio = $_POST['criterio'];
        $sql = "";
        if ($criterio == 1) {
            $sql = "SELECT u.*, r.rol_nombre, est.est_nombre FROM usuarios u
                    JOIN rol r ON u.rol_id = r.rol_id
                    JOIN sexo s ON u.sex_id = s.sex_id 
                    JOIN tipo_documento td ON u.doc_id = td.doc_id
                    JOIN estados est ON u.est_id = est.est_id
                    ORDER BY u.usu_nombre1 ASC";
        } else if ($criterio == 2) {
            $sql = "SELECT u.*, r.rol_nombre, est.est_nombre FROM usuarios u
                    JOIN rol r ON u.rol_id = r.rol_id
                    JOIN sexo s ON u.sex_id = s.sex_id 
                    JOIN tipo_documento td ON u.doc_id = td.doc_id
                    JOIN estados est ON u.est_id = est.est_id
                    ORDER BY u.usu_nombre1 DESC";
        } else if ($criterio == 3) {
            $sql = "SELECT u.*, r.rol_nombre, est.est_nombre FROM usuarios u
                    JOIN rol r ON u.rol_id = r.rol_id
                    JOIN sexo s ON u.sex_id = s.sex_id 
                    JOIN tipo_documento td ON u.doc_id = td.doc_id
                    JOIN estados est ON u.est_id = est.est_id
                    ORDER BY u.usu_id DESC";
        } else {
            $sql = $_SESSION['sql'];
        }
        $_SESSION['sql'] = $sql;

        $usuario = $obj->consult($sql);
        include_once '../view/usuarios/buscar.php';
    }


    public function detallesUsuario()
    {
        $obj = new UsuariosModel();
        $usu_id = $_POST['id'];
        $sql = "SELECT u.*,s.sex_desc, td.nombre_tipo, td.doc_abrev, r.rol_nombre FROM usuarios u
            JOIN rol r ON u.rol_id = r.rol_id 
            JOIN sexo s ON u.sex_id = s.sex_id 
            JOIN tipo_documento td ON u.doc_id = td.doc_id WHERE usu_id = $usu_id";
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
    public function getDatosGraf()
    {

        $obj = new UsuariosModel();

        $sql = "SELECT EXTRACT(YEAR FROM fecha) AS anio, EXTRACT(MONTH FROM fecha) AS mes, COUNT(*) AS usuarios
                FROM auditoria_usuarios
                GROUP BY EXTRACT(YEAR FROM fecha), EXTRACT(MONTH FROM fecha)
                ORDER BY EXTRACT(YEAR FROM fecha), EXTRACT(MONTH FROM fecha)";

        $datos = $obj->consult($sql);

        if ($datos) {
            $salida = array();
            foreach ($datos as $fecha) {
                $salida[] = $fecha['mes'] . '/' . $fecha['anio'] . ',' . $fecha['usuarios'];
            }

            echo implode(";", $salida);
        }
    }

    public function actualizarContra()
    {
        $obj = new UsuariosModel();

        $usu_clavenew = $_POST['usu_clavenew'];
        $usu_clavenewConf = $_POST['usu_clavenewConf'];
        $usu_clave = $_POST['usu_clave'];
        $usu_id = $_POST['usu_id'];
        $validoContra = true;

        $sql2 = "SELECT * FROM usuarios WHERE usu_id = $usu_id";
        $resultado = $obj->consult($sql2);
        $hash = hash('sha256', $usu_clave);
        if ($resultado && isset($resultado[0])) {
            $contraBase = $resultado[0]['usu_clave'];
            if ($contraBase === $hash) {
                $validoContra = true;
            } else {
                echo "La contraseña actual no es la correcta";
                $validoContra = false;
            }
        }

        if ($usu_clavenew != $usu_clavenewConf) {
            echo "Las contraseñas no coinciden";
            $validoContra = false;
        }
        if ($validoContra) {
            $hash = hash('sha256', $usu_clavenew);
            $sql = "UPDATE usuarios SET usu_clave = '$hash' WHERE usu_id = $usu_id";
            $ejecutar = $obj->update($sql);
            if ($ejecutar) {
                echo "Actualización exitosa";
            } else {
                echo "No se pudo actualizar la contraseña";
            }
        }
    }

}

