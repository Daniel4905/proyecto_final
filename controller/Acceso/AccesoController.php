<?php

include_once '../model/Acceso/AccesoModel.php';

class AccesoController
{
    public function login()
    {

        $obj = new AccesoModel();

        $user = $_POST['numeroId'];
        $password = $_POST['password'];

        $hashlog = hash('sha256', $password);

        $sql = "SELECT * FROM usuarios WHERE usu_documento = '$user' AND est_id=1";
        $usuario = $obj->consult($sql);
        if ($usuario && count($usuario) > 0) {
            foreach ($usuario as $usu) {
                if ($hashlog === $usu['usu_clave']) {
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

        $hash = hash('sha256', $usu_clave);


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
        } else {
            $_SESSION['errores'][] = "No se pudo realizar el registro";
            redirect(getUrl('Acceso', 'Acceso', 'getCreate', false, "ajax"));
        }

    }

    public function validarDoc()
    {
        $obj = new AccesoModel();

        $doc = isset($_POST['doc']) ? $_POST['doc'] : '';

        if (empty($doc)) {
            //echo "Error: No se envió el documento";
            return;
        }

        $sql = "SELECT * FROM usuarios WHERE usu_documento = '$doc'";

        $docs = $obj->consult($sql);

        if ($docs && count($docs) > 0) {
            echo "El documento ingresado ya existe";
        } else {
            echo "Documento valido";
        }
    }
    public function getRestContra()
    {
        include_once '../view/Acceso/restablecerContra.php';
    }
    public function restContra()
    {
        $obj = new AccesoModel();
        $usu_doc = $_POST['numeroId'];
        $usu_correo = $_POST['correoRest'];

        $sql = "SELECT usu_nombre1, usu_apellido1, usu_id FROM usuarios WHERE usu_documento ='$usu_doc' AND usu_correo = '$usu_correo'";
        $usuario = $obj->consult($sql);

        if (!empty($usuario)) {
            $usu_nombre = $usuario[0]['usu_nombre1'] . " " . $usuario[0]['usu_apellido1'];
            $usu_id = $usuario[0]['usu_id'];
            $token = $this->generarToken();

            $id = $obj->autoIncrement('tokens_contra', 'id_token');
            $sql = "INSERT INTO tokens_contra (id_token, token, usu_id, expiracion) VALUES ($id, '$token', $usu_id, NOW() + INTERVAL '10 minutes')";
            $guardar = $obj->insert($sql);
            if ($guardar) {
                $url = 'http://localhost:8080/proyecto_final/web/ajax.php?modulo=Acceso&controlador=Acceso&funcion=getRestablecer&token=' . $token;
                $enviar = $this->enviar($usu_correo, $usu_nombre, $url);
                if ($enviar) {
                    echo "Correo enviado exitosamente";
                } else {
                    echo "No se pudo enviar el correo";
                }
            }
        } else {
            echo "Credenciales invalidas";
        }
    }

    public function generarToken()
    {
        $longitud = 5;
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $tokenArray = array();
        for ($i = 0; $i < $longitud; $i++) {
            $indiceAleatorio = mt_rand(0, strlen($caracteres) - 1);
            $tokenArray[] = $caracteres[$indiceAleatorio];
        }
        return implode('', $tokenArray);
    }
    public function getError(){
        include_once '../view/Acceso/error.php';
    }

    public function getRestablecer()
    {
        $obj = new AccesoModel();
        $token = $_GET['token'];
        $sql = "SELECT usu_id FROM tokens_contra WHERE token = '$token' AND expiracion > NOW()";
        $tokenVal = $obj->consult($sql);
        if (!empty($tokenVal)){
            include_once '../view/Acceso/restablecerCont.php';
        }else{
            $this->getError();
        }
    }

    public function restContraNew()
    {
        $obj = new AccesoModel();

        $usu_clave = $_POST['usu_clave'];
        $usu_clavenew = $_POST['usu_clavenew'];
        $token = $_POST['token'];

        $hash = hash('sha256', $usu_clave);

        $sql = "SELECT usu_id FROM tokens_contra WHERE token = '$token' AND expiracion > NOW()";
        $tokenVal = $obj->consult($sql);
        if (isset($tokenVal)) {
            $usu_id = $tokenVal[0]['usu_id'];
            $sqlUp = "UPDATE usuarios SET usu_clave = '$hash' WHERE usu_id = $usu_id";
            $ejecutar = $obj->update($sqlUp);
            if ($ejecutar) {
                $_SESSION['restC'][] = "Contraseña restablecida correctamente";
                redirect('login.php');
            } else {
                echo "No se ejecuto el update";
            }
        } else {
            echo "El token ya expiró valido";
        }

    }


    public function enviar($correo, $usuario, $url)
    {
        //Para usar PHPMailer: 
        // Habilitar estas dos extensiones en php.ini
        // extension=php_openssl.dll extension=php_sockets.dll
        // Habilitar Telnet:
        // Panel de control > Programas > Progamas y carácteristicas >  Activar o desactivar las características de Windows > Marcar casilla cliente telnet o telnet client
        // Verificar Telnet:  cmd: telnet smtp.gmail.com 587 o tambien con esto en powershell: Test-NetConnection -ComputerName smtp.gmail.com -Port 587
        
        require 'PHPMailer-5.2.28/PHPMailerAutoload.php';

        $mail = new PHPMailer();

        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';            // Servidor SMTP (puede ser otro, como Outlook)
        $mail->SMTPAuth = true;                   // Habilitar autenticación SMTP
        $mail->Username = 'danielwz0409@gmail.com';  // Tu dirección de correo
        $mail->Password = 'yiut dojf nukl fdfv';        // Contraseña de tu correo
        $mail->SMTPSecure = 'tls';                // Encriptación TLS (o 'ssl' si el puerto es 465)
        $mail->Port = 587;                        // Puerto para TLS (o 465 para SSL)

        // Configuración del correo
        $mail->setFrom('danielwz0409@gmail.com', 'AccidentEye');  // Remitente
        $mail->addAddress("$correo", "$usuario"); // Destinatario
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $imagenRuta = 'C:/ms4w/Apache/htdocs/proyect2/web/img/logo_claro.png';
        $mail->AddEmbeddedImage($imagenRuta, 'imagen_id', 'logo_claro.png');

        $mail->Subject = 'Restablecer contraseña';
        $mail->Body = '
                        <head>
                            <style>
                               
                                .container {
                                    width: 100%;
                                    max-width: 600px;
                                    margin: 0 auto;
                                    padding: 20px;
                                    background-color:rgb(32, 36, 52) !important; /* Fondo blanco para el contenido */
                                    border-radius: 8px;
                                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                                }
                                h1 {
                                    color: #bbb8b8 !important; /* Color de texto gris claro */
                                    font-size: 24px;
                                    text-align: center;
                                }
                                p {
                                    font-size: 16px;
                                    color: #bbb8b8 !important; /* Color de texto gris claro */
                                    line-height: 1.6;
                                    margin-bottom: 20px;
                                }
                                .button {
                                    display: inline-block;
                                    padding: 12px 25px;
                                    font-size: 16px;
                                    color: #ffffff;
                                    background: linear-gradient(135deg, rgb(115, 187, 255) 39%, rgb(149, 95, 224) 101%) !important; /* Botón con gradiente */
                                    text-decoration: none;
                                    border: none;
                                    border-radius: 50px; /* Bordes redondeados */
                                    text-align: center;
                                    margin: 20px 0;
                                }
                                .footer {
                                    text-align: center;
                                    font-size: 14px;
                                    color: #bbb8b8 !important; /* Color de texto gris claro */
                                }
                                .footer a {
                                    color: #bbb8b8 !important; /* Enlaces de color gris claro */
                                    text-decoration: none;
                                }
                                .image {
                                    display: block;
                                    max-width: 400px;
                                    height: auto;
                                    margin: 20px auto;
                                    padding: 15 15 15 15;
                                }
                            </style>
                            <div class="container" style="rgb(32, 36, 52) !important;">
                                <!-- Logo Embebido -->
                                <div class="logo">
                                    <img src="cid:imagen_id" alt="Logo geovisor" class="image">
                                </div>
                                <h1>Restablece tu Contraseña</h1>
                                <p>Hola, has solicitado restablecer tu contraseña. Para proceder, por favor haz clic en el siguiente enlace:</p>
                                <p style="text-align: center;">
                                    <a href="' . $url . '" class="button">Restablecer Contraseña</a>
                                </p>
                                <p>Este enlace será válido por 10 minutos. Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
                                <div class="footer">
                                    <p>Si no puedes hacer clic en el botón, copia y pega el siguiente enlace en tu navegador:</p>
                                    <p><a href="' . $url . '">' . $url . '</a></p>
                                </div>
                            </div>';
        // Enviar correo
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function getGestionApp(){
        
        include_once '../view/Acceso/gestion.php';
    }


}
?>