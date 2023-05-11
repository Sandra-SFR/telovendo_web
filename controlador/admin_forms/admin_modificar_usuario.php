<?php

/**
 *FORM MODIFICAR USUARIO (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["formdatamodificar"])){
    // si get[modificarUsuario] está inicializada:
    if(isset($_GET["modificarUsuario"])){
        if($_GET["modificarUsuario"]==("si" || "no")){
            echo $_SESSION["mensajemodificar"]; // muestra mensaje
        }
        // si get[campo] está inicializada
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"]; // almacena el campo para asignar el foco.
        }
    }
    unset($_SESSION["formdatamodificar"]); //elimina los datos almacenados en session
    unset($_SESSION["mensajemodificar"]); //elimina los datos almacenados en session
}

/**
 *FORM MODIFICAR USUARIO (validacion y consulta)
 **/

// si post["modificarUsuario"] está inicializada:
if(isset($_POST["modificarUsuario"])){

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?modificarUsuario=no&campo=$key");
            break;
            // Validaciones para el campo name y surname:
        }elseif($key == "name" || $key == "surname"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificarUsuario=no&campo=$key");
                break;
            }
            // Validaciones para el campo email:
        }elseif($key == "email"){
            // si el campo no tiene un formato válido para emails:
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $mensaje = '<p>El email <b>'.$value.'</b> está incorrecto.</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificarUsuario=no&campo=$key");
                break;
                // si el campo tiene más de 50 caracteres:
            }elseif(strlen($value) > ($num=50)){
                $mensaje = '<p>El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificarUsuario=no&campo=$key");
                break;
            }
        }
    }

    // Cuando $validacion es true:
    if($validacion){
        // Se crea el objeto usuario:
        $usuario = new Admin_modelo($_POST["id"], $_POST["name"],$_POST["surname"],$_POST["email"]);
        // Se llama a la función actualizarUsuario():
        $respuesta = $controlador->actualizarUsuario($usuario);

        // Si $respuesta es un string significa que hubo un error:
        if(gettype($respuesta) == "string"){

            $_SESSION["formdatamodificar"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajemodificar"]= $respuesta; // Asigna el mensaje.

            header("Location:../vista/gestionar_usuarios.php?modificarUsuario=no1");

            // Si se han realizado cambios en la base de datos:
        }elseif($respuesta){
            // se reestablecen los datos de $_SESSION que se muestran. El id es el único valor que NO puede cambiarse, por lo tanto no se re asigna este valor.
            $_POST["NAME"] = $_POST["name"];
            $_POST["SURNAME"] = $_POST["surname"];
            $_POST["EMAIL"] = $_POST["email"];
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>Los datos han sido modificados.</p>';

            header("Location:../vista/gestionar_usuarios.php?modificarUsuario=si");

            // si no se ha modificado ningún campo en la base de datos:
        }else{
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>No se han podido modificar los datos. Quizás no ha modificado ningún campo.</p>';

            header("Location:../vista/gestionar_usuarios.php?modificarUsuario=no2");
        }
    }else{
        $_SESSION["formdatamodificar"] = $_POST;
        $_SESSION["mensajemodificar"]= $mensaje;
    }// end if $validación
}// end if post[modificarUsuario]
