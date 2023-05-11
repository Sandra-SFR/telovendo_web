<?php

/**
 *FORM REGISTRAR USUARIO (datos y mensajes)
 **/
// si session[formdata] no está vacío:
if(!empty($_SESSION["formdata"])){
    // almacena variables con los datos para mostrarlos al usuario en caso de error.
    $nick = trim($_SESSION["formdata"]["user"]);
    $name = trim($_SESSION["formdata"]["name"]);
    $surname = trim($_SESSION["formdata"]["surname"]);
    $email = trim($_SESSION["formdata"]["email"]);

    if($_GET["registrar"]== ("si" || "no")){
        echo $_SESSION["mensajeregistrar"]; //muestra mensaje
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"]; //almacena el campo incorrecto en el formulario.
        }
    }
    unset($_SESSION["formdata"]); // elimina los datos almacenados en session.
    unset($_SESSION["mensajeregistrar"]); // elimina los datos almacenados en session.
}

/**
 *FORM REGISTRAR USUARIO (validacion y consulta)
 **/
//Si post[registrar] está inicializada:
if(isset($_POST["registrar"])){
    $password2 = $_POST["password2"]; //almacena variable para comprobación de contraseña

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>'; // asigna mensaje de error
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key"); //redirecciona detallando el campo que falló
            break;
            // Validaciones para el campo user que sea un formato valido y entre 3 y 20 caracteres:
        }elseif($key == "user" && !preg_match('/^[A-Za-zñÑ0-9.-_]{3,20}+$/', $value)){
            $mensaje = '<p>El campo <b>'.$key.'</b> sólo permite . - _ y letras sin acentos <br>(mínimo 3 y máximo 20 caracteres)</p>';
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
            break;
            // Validaciones para el campo name y apellido. Permite letras con acentos, espacios, minimo 2 maximo 20 caracteres:
        }elseif(($key == "name" || $key == "apellido") && !preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ]{2,20}+$/", $value)){
            $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras <br>(mínimo 2 y máximo 20 caracteres).</p>';
            $validacion=false;

            header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
            break;
            // Validacion que comprueba que el campo email sea válido y que no supere los 50 caracteres:
        }elseif($key == "email"){
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $mensaje = '<p>El email <b>'.$value.'</b> está incorrecto.</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            }elseif(strlen($value) > ($num=50)){
                $mensaje = '<p>El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            }
            // comprueba que el campo password no tenga menos de 6 caracteres y que el campo confirmar password coincida:
        }elseif($key == "password"){
            if(strlen($value) < $num=6){
                $mensaje = '<p>El campo <b>'.$key.'</b> debe ser mayor que '.$num.'</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            }elseif($value != $password2){
                $mensaje = '<p>El campo <b>'.$key.'</b> y confirmar password deben coincidir</p>';
                $validacion=false;

                header("Location:". $_SERVER['PHP_SELF']."?registrar=no&campo=$key");
                break;
            }
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        //Se crea un objeto usuario:
        $usuario = new Usuarios_modelo($_POST["user"], $_POST["name"],$_POST["surname"],$_POST["email"]);
        //Se llama a la función registrar():
        $respuesta = $controlador->registrar($usuario, $_POST["password"]);

        //Si ya existe el user o si ocurre un error al ejecutar la consulta vuelve a seccion registrar y muestra el mensaje:
        if(gettype($respuesta) == "string"){
            $_SESSION["formdata"] = $_POST;
            $_SESSION["mensajeregistrar"] = $respuesta;

            header("Location:". $_SERVER['PHP_SELF']."?registrar=no");

            // Si se ha registrado en la base de datos:
        }else{
            $_SESSION["formdata"] = $_POST; // almacena los datos enviados por post.
            require_once("email.php"); // requiere el archivo email.
            $nombre = trim($_SESSION["formdata"]["user"]);
            $correo_electronico= trim($_SESSION["formdata"]["email"]);
            $email =new Email();
            $_SESSION["mensajeregistrar"] = $email->enviar_correo_confirmacion($nombre, $correo_electronico); // llama a la función email y y almacena el mensaje que devuelve.

            if($_SESSION["USER"]=="Administrador"){
                header("Location:../vista/gestionar_usuarios.php?registrar=si");
            }else{
                header("Location:". $_SERVER['PHP_SELF']."?registrar=si");
            }
        }
        // Cuando $validacion es false:
    }else{
        $_SESSION["formdata"] = $_POST;
        $_SESSION["mensajeregistrar"] = $mensaje;
    }// end if validacion
}// end if(isset($_POST["registrar"]))

?>