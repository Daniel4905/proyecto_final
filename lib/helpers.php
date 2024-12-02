<?php
   

session_start();
    
    function redirect($url) {
        echo "<script type='text/javascript'>"
        ."window.location.href = '$url'".
        "</script>";
    }
   
    
    function dd($var) {
        echo "<pre>";
        die(print_r($var));
    }

    function getUrl($modulo, $controlador, $funcion, $parametros = false, $pagina=false) {

        if($pagina==false){
            $pagina = 'index';
        }
        $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
        
        if($parametros !=false){
            foreach($parametros as $key => $value){
                $url.="&$key=$value";
            }
        }

        return $url;
    }
    function resolve(){
        //Recibe el modulo, controlador y funcion.
        $modulo = ucwords($_GET['modulo']); //Modulo recibido
        $controlador = ucwords($_GET['controlador']); //Controller recibido
        $funcion = $_GET['funcion']; //Funcion recibida

        //Comprueba si existe la ruta
        if (is_dir("../controller/".$modulo)) {

            //Comprueba si existe el archivo
            if(file_exists("../controller/".$modulo."/".$controlador."Controller.php")){

                include_once "../controller/".$modulo."/".$controlador."Controller.php"; //Se incluye el archivo
                $nombreClase = $controlador."Controller"; //Se asigna el nombre de la clase

                //Comprueba si existe la clase
                if(class_exists($nombreClase)){
                    //Se instancia un objeto, con el nombre de la clase
                    $objClass = new $nombreClase();

                    //Comprueba si existe el objeto
                    if(method_exists($objClass, $funcion)){
                        //El objeto utiliza la funcion
                        $objClass -> $funcion();
                    }else{
                        echo "No se encontró el objeto";
                    }
                }else{
                   echo "No se encontró la clase";
                }
            }else{
                echo "No se encontró el archivo";
            }

        }else{
            echo "No se encontró la carpeta";
        }
    }

    function validarCampos($nombre, $nombre2, $apellido, $apellido2, $correo, $clave, $telefono, $documento) {
        $patronNombre = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/"; 
        $patronCorreo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $patronClave = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/";
        $patronNumero = "/^[0-9]+$/"; 
        
    
        if (!preg_match($patronNombre, $nombre)) {
            $_SESSION['errores'][] = "El campo primer nombre solo admite letras";
            return false;
        }
        if (!empty($nombre2) && !preg_match($patronNombre, $nombre2)) {
            $_SESSION['errores'][] = "El campo segundo nombre solo admite letras";
            return false;
        }
        if (!preg_match($patronNombre, $apellido)) {
            $_SESSION['errores'][] = "El campo primer apellido solo admite letras";
            return false;
        }
        if (!empty($apellido2) && !preg_match($patronNombre, $apellido2)) {
            $_SESSION['errores'][] = "El campo segundo apellido solo admite letras";
            return false;
        }

        if (!preg_match($patronCorreo, $correo)) {
            $_SESSION['errores'][] = "El formato de correo ingresado es inválido";
            return false;
        }
    
        if (!preg_match($patronClave, $clave)) {
            $_SESSION['errores'][] = "La contraseña debe contener mínimo 8 caracteres, una mayúscula, una minúscula y un símbolo";
            return false;
        }
    
        if (!preg_match($patronNumero, $telefono)) {
            $_SESSION['errores'][] = "El campo teléfono solo admite dígitos";
            return false;
        }
        if (strlen($telefono) != 10) {
            $_SESSION['errores'][] = "El campo teléfono debe contener 10 dígitos";
            return false;
        }
    
        if (!preg_match($patronNumero, $documento) || strlen($documento) < 8 || strlen($documento) > 10) {
            $_SESSION['errores'][] = "El campo documento debe contener entre 8 y 10 dígitos";
            return false;
        }
        
        return true;
    }
    
    
    
    function validarCamponum($input) {
        $patron = "/^[0-9]+$/"; 
        return preg_match($patron, $input) === 1;
    }
    function validarCorreo($input) {
        $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/";
        return preg_match($patron, $input) === 1;
    }
    function validarClave($input) {
        $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/";
        return preg_match($patron, $input) === 1;
    }


?>