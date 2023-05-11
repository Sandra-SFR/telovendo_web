<?php

/**
 *FORM LOGIN (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["formdatalogin"])){
    //Se eliminan espacios en blanco del principio y final:
    $nick = trim($_SESSION["formdatalogin"]["user"]);
    // si get["login] es no...
    if(($_GET["login"]=="no")){
        echo $_SESSION["mensajelogin"];
        //si get["campo"] está instanciada:
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"];
        }
    }
    unset($_SESSION["formdatalogin"]); // elimina formdatalogin.
    unset($_SESSION["mensajelogin"]); // elimina mensajelogin.
}

/**
 *FORM LOGIN (validacion y consulta)
 **/
// Post["login"] está inicializada:
if(!empty($_POST["login"])){

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $validacion=false;
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>';

            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key");
            break;
            // si el campo user tiene menos de 3 caracteres:
        }elseif($key == "user" && strlen($value) < $num=3){
            $mensaje = '<p>El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key");
            break;
            // si el campo password tiene menos de 6 caracteres:
        }elseif($key == "password" && strlen($value) < $num=6){
            $mensaje = '<p>El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?login=no&campo=$key");
            break;
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        // Llama función iniciar_sesion() que devuelve un objeto usuario:
        $usuario = $controlador->iniciar_sesion($_POST["user"], $_POST["password"]);
        // Si $respuesta es un string significa que hubo un error:
        if(gettype($usuario) == "string"){
            $_SESSION["formdatalogin"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajelogin"] = $usuario; // Asigna el mensaje.
            header("Location:". $_SERVER['PHP_SELF']."?login=no");
            // si $usuario es null significa que el usuario o la contraseña son incorrectos:
        }elseif($usuario == null){
            $_SESSION["formdatalogin"] = $_POST;
            $_SESSION["mensajelogin"] = '<p>Usuario y/o Contraseña incorrecta</p>';
            header("Location:". $_SERVER['PHP_SELF']."?login=no");
            // Si $usuario es un objeto:
        }else{
            //Asigna las variables de sesión:
            $_SESSION["USER"] = $usuario->nick;
            $_SESSION["NAME"] = $usuario->name;
            $_SESSION["SURNAME"] = $usuario->surname;
            $_SESSION["EMAIL"] = $usuario->email;
            header("Location:../index.php");
        }
        // Cuando $validacion es false:
    }else{
        $_SESSION["formdatalogin"] = $_POST;
        $_SESSION["mensajelogin"] = $mensaje;
    }// end if validacion login
}// en if !empty POST
?>