<?php

/**
 *FORM ELIMINAR (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["mensajeeliminar"])){
    //Si get[eliminar] está inicializada:
    if(isset($_GET["eliminar"])){
        //si get[eliminar] es igual a no:
        if($_GET["eliminar"]=="no"){
            echo $_SESSION["mensajeeliminar"];  // muestra mensaje
        }
    }
    unset($_SESSION["mensajeeliminar"]); // elimina datos almacenados en session
}
/**
 *FORM ELIMINAR (validacion y consulta)
 **/
// si se a presionado el submit eliminar:
if(isset($_POST["eliminar"])){
    // redirecciona con get[eliminar]:
    header("Location:". $_SERVER['PHP_SELF']."?eliminar");
// si se presiona en confirmar eliminar cuenta:
}elseif(isset($_POST["confirmareliminar"])){
    // se almacena la variable password2 para chequear:
    $password2 = $_POST["password2"];
    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>'; //almacena mensaje
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?eliminar=no"); // redirecciona
            break;
            // Validaciones para el campo password:
        }elseif($key == "password"){
            // Si es menor que seis caracteres:
            if(strlen($value) < $num=6){
                $mensaje = '<p>El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?eliminar=no");
                break;
                // Si password es distinto a confirmar password:
            }elseif($value != $password2){
                $mensaje = '<p>El campo <b>'.$key.'</b> y confirmar password deben coincidir</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?eliminar=no");
                break;
            }
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        //ejecuta la consulta sql:
        $respuesta = $controlador->eliminar($_SESSION["USUARIO"], $_POST["password"]);
        // si $respuesta es equivalente a verdadero / si hay una fila afectada:
        if($respuesta){
            header("Location:".$_SERVER['PHP_SELF']."?cerrar"); //si el usuario ha sido eliminado, se cierra elimina la sesión.
            // Si $respuesta es un string significa que hubo un error:
        }elseif(gettype($respuesta) == "string"){
            $_SESSION["mensajeeliminar"]= $respuesta; //almacena mensaje de error.

            header("Location:../vista/panel_usuario.php?eliminar=no");
            // Si no ha habido una fila acetada:
        }else{
            //almacena mensaje
            $_SESSION["mensajeeliminar"]= '<p>No se ha podido eliminar el usuario. <b>Contraseña</b> incorrecta</p>';
            header("Location:../vista/panel_usuario.php?eliminar=no");
        }
        // Cuando $validacion es false:
    }else{
        //almacena mensaje de error
        $_SESSION["mensajeeliminar"]= $mensaje;
    }
}elseif(isset($_POST["cancelareliminar"])){
    header("Location:". $_SERVER['PHP_SELF']);
}
?>
