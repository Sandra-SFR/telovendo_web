<?php

/**
 *FORM CAMBIAR CONTRASEÑA (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["msgchangepass"])){
    // si get[cambiapass] es si o no...
    if($_GET["changepass"] == ("si" || "no")){
        echo $_SESSION["msgchangepass"]; // muestra mensaje
    }
    unset($_SESSION["msgchangepass"]); // vacía los datos almacenados en session
}

/**
 *FORM CAMBIAR CONTRASEÑA (validacion y consulta)
 **/
// Post["changepass"] está inicializada:
if(isset($_POST["changepass"])){
    $password_actual = $_POST["password"]; // almacena password_actual para comparación en foreach
    $password_nuevo = $_POST["password2"]; // almacena password_nuevo para comparación en foreach
    $password_nuevo_confirma = $_POST["password2confirma"]; //almacena password_nuevo_confirma para comparación en foreach

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //array asociativo que contiene los nombres de los campos tal como se mostrarán en el mensaje de error
        $campos = ["password"=>"Contraseña actual", "password2"=>"Contraseña nueva", "password2confirma"=>"Cconfirmar contraseña nueva"];
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$campos[$key].'</b> no puede estár vacío</p>'; // asigna mensaje
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?changepass=no");
            break;
            // Validaciones para el campo password, password2 y password2confirma:
        }elseif($key == "password" || $key == "password2" || $key == "password2confirma"){
            // si el campo es menor que 6 caracteres:
            if(strlen($value) < $num=6){
                $mensaje = '<p>El campo <b>'.$campos[$key].'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?changepass=no");
                break;
            }
            // Validaciones para el campo password2:
            if($key == "password2"){
                // si el paswwor nuevo es igual al actual:
                if($value == $password_actual){
                    $mensaje = '<p>El campo <b>'.$campos[$key].'</b> debe ser distinta de la <b>Contraseña actual</b></p>';
                    $validacion=false;

                    header("Location:". $_SERVER['PHP_SELF']."?changepass=no");
                    //si password nuevo es distinto a la confirmación de password nuevo:
                }elseif($value != $password_nuevo_confirma){
                    $mensaje = '<p>El campo <b>'.$campos[$key].'</b> y <b>Confirmar contraseña nueva</b> deben coincidir</p>';
                    $validacion = false;

                    header("Location:". $_SERVER['PHP_SELF']."?changepass=no");
                    break;
                }
            }
        }
    }

    // Cuando $validacion es true:
    if($validacion){
        // sE ejecuta la consulta:
        $respuesta = $controlador->changepass($_SESSION["USER"], $_POST["password"], $_POST["password2"]);
        // Si $respuesta es un string significa que hubo un error o la contraseña actual es incorrecta:
        if(gettype($respuesta) == "string"){
            $_SESSION["msgchangepass"]= $respuesta;

            header("Location:../vista/panel_usuario.php?changepass=no");
            // Si la respuesta es equivalente a true / si hay una fila afectada:
        }elseif($respuesta){
            $_SESSION["msgchangepass"]= '<p>Su contraseña ha sido modificada.</p>';

            header("Location:../vista/panel_usuario.php?changepass=si");
        }
    }else{
        $_SESSION["msgchangepass"] = $mensaje;
    }
}// end if(isset($_POST["cambiapass"]))
elseif(isset($_POST["cancelpass"])){
    header("Location:". $_SERVER['PHP_SELF']);
}

?>
