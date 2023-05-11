<?php

/**
 *FORM MODIFICAR USUARIO (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["formdatamodificar"])){
    // si get[modificar] está inicializada:
    if(isset($_GET["modificar"])){
        if($_GET["modificar"]==("si" || "no")){
            echo $_SESSION["mensajemodificar"]; // muestra mensaje
        }
        // si get[campo] está inicializada:
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"]; // almacena el campo para asignar el foco.
        }
    }
    unset($_SESSION["formdatamodificar"]); //elimina los datos almacenados en session.
    unset($_SESSION["mensajemodificar"]); //elimina los datos almacenados en session.
}

/**
 *FORM MODIFICAR USUARIO (validacion y consulta)
 **/

//Si Post["modificar"] está inicializada:
if(isset($_POST["modificar"])){
    $password2 = $_POST["password2"]; // almacena la confirmación de password en variable para comprobaciones.

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
            break;
            // Validaciones para el campo name y surname:
        }elseif($key == "name" || $key == "surname"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            }
            // Validaciones para el campo email:
        }elseif($key == "email"){
            // si el campo no tiene los caracteres permitidos:
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $mensaje = '<p>El email <b>'.$value.'</b> está incorrecto.</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
                // si el campo tiene más de cincuenta caracteres:
            }elseif(strlen($value) > ($num=50)){
                $mensaje = '<p>El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            }
            // Validaciones para el campo password:
        }elseif($key == "password"){
            // si tiene menos de seis caracteres:
            if(strlen($value) < $num=6){
                $mensaje = '<p>El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
                // Validaciones si el campo distinto de password:
            }elseif($value != $password2){
                $mensaje = '<p>El campo <b>'.$key.'</b> y confirmar password deben coincidir</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?modificar=no&campo=$key");
                break;
            }
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        // Se crea un objeto usuario:
        $usuario = new Usuarios_modelo($_SESSION["USER"], $_POST["name"],$_POST["surname"],$_POST["email"]);
        // llama a la función actualizar():
        $respuesta = $controlador->actualizar($usuario, $_POST["password"]);

        // Si $respuesta es un string significa que hubo un error:
        if(gettype($respuesta) == "string"){

            $_SESSION["formdatamodificar"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajemodificar"]= $respuesta; // Asigna el mensaje.

            header("Location:../vista/panel_usuario.php?modificar=no");

            // Si se han realizado cambios en la base de datos:
        }elseif($respuesta){
            // se reestablecen los datos de $_SESSION que se muestran. User es el único valor que NO puede cambiarse, por lo tanto no se re asigna este valor.
            $_SESSION["NAME"] = $_POST["name"];
            $_SESSION["SURNAME"] = $_POST["surname"];
            $_SESSION["EMAIL"] = $_POST["email"];
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>Los datos han sido modificados!!</p>';
            header("Location:../vista/panel_usuario.php?modificar=si");

            // Si no se ha modificado ningún campo en la bbdd:
        }else{
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>No se ha podido modificar sus datos. <b>Password</b> incorrecto o quizás no ha modificado ningún campo.</p>';

            header("Location:../vista/panel_usuario.php?modificar=no");
        }
    }else{
        $_SESSION["formdatamodificar"] = $_POST;
        $_SESSION["mensajemodificar"]= $mensaje;
    }// end if $validación
}// end if post[modificar]

?>