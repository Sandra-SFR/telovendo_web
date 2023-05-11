<?php

/**
 *FORM MODIFICAR PRODUCTO (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["formdatamodificar"])){
    // si get[modificarProducto] está inicializada:
    if(isset($_GET["modificarProducto"])){
        if($_GET["modificarProducto"]==("si" || "no")){
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
 *FORM MODIFICAR PRODUCTO (validacion y consulta)
 **/

// Si post["modificarProducto"] está inicializada:
if(isset($_POST["modificarProducto"])){

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>'; // asigna el mensaje de error
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?modificarProducto=no&campo=$key"); // redirecciona detallando el campo que falló
            break;
            // Validaciones para el campo product_name y category:
        }elseif($key == "product_name" || $key == "category"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificarProducto=no&campo=$key");
                break;
            }
            // Validaciones para el campo price:
        }elseif($key == "price"){
            // Si la price tiene un formato erroneo:
            if(!preg_match("/^\d+(\.\d+)?$/", $value)){
                $mensaje = '<p>El número <b>'.$value.'</b> está incorrecto.</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificarProducto=no&campo=$key");
                break;
                // si el campo tiene más de 10 caracteres:
            }elseif(strlen($value) > ($num=10)){
                $mensaje = '<p>El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?modificarProducto=no&campo=$key");
                break;
            }
        }
    }


    // Cuando $validacion es true:
    if($validacion){
        // Se crea el objeto producto:
        $producto = new productos_modelo($_POST["id"], $_POST["product_name"], $_POST["category"], $_POST["price"]);
        // Se llama a la función actualizarProducto():
        $respuesta = $controlador->actualizarProducto($producto);
        // Si $respuesta es un string significa que hubo un error.

        if(gettype($respuesta) == "string"){

            $_SESSION["formdatamodificar"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajemodificar"]= $respuesta; // Asigna el mensaje.
            header("Location:../vista/gestionar_productos.php?modificarProducto=no1");

            // Si se han realizado cambios en la base de datos:
        }elseif($respuesta){
            // Se reestablecen los datos de $_SESSION que se muestran. El id es el único valor que NO puede cambiarse, por lo tanto no se re asigna este valor.
            $_SESSION["PRODUCT_NAME"] = $_POST["product_name"];
            $_SESSION["CATEGORY"] = $_POST["category"];
            $_SESSION["PRICE"] = $_POST["price"];
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>Los datos han sido modificados.</p>';

            header("Location:../vista/gestionar_productos.php?modificarProducto=si");

            // Si no se ha modificado ningún campo:
        }else{
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>No se han podido modificar los datos. Quizás no ha modificado ningún campo.</p>'; // se asigna mensaje de error
            header("Location:../vista/gestionar_productos.php?modificarProducto=no2");
        }
    }else{
        $_SESSION["formdatamodificar"] = $_POST;
        $_SESSION["mensajemodificar"]= $mensaje;
    }// end if $validación
}// end if post[modificarProducto]
