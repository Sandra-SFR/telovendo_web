<?php

/**
 *FORM MODIFICAR VENTA (datos y mensajes)
 **/
// Si no está vacío:
if(!empty($_SESSION["formdatamodificar"])){
    //Si get[modificarVenta] está inicializada:
    if(isset($_GET["modificarVenta"])){
        if($_GET["modificarVenta"]==("si" || "no")){
            echo $_SESSION["mensajemodificar"]; // muestra mensaje
        }
        //Si get[campo] está inicializada:
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"]; // almacena el campo para asignar el foco.
        }
    }
    unset($_SESSION["formdatamodificar"]); //elimina los datos almacenados en session.
    unset($_SESSION["mensajemodificar"]); //elimina los datos almacenados en session.
}

/**
 *FORM MODIFICAR VENTA (validacion y consulta)
 **/

// Post["modificarVenta"] está inicializada:
if(isset($_POST["modificarVenta"])){

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;

            header("Location:../vista/gestionar_ventas.php?modificarVenta=no&campo=$key");
            break;
            // Validaciones para el campo id_product y quantity:
        }elseif($key == "id_product" || $key == "quantity"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[0-9]{1,10}$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener números (mínimo 1 y máximo 10 caracteres)</p>';
                $validacion=false;

                header("Location:../vista/gestionar_ventas.php?modificarVenta=no&campo=$key");
                break;
            }
            // Validaciones para el campo id_user:
        }elseif($key == "id_user"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;

                header("Location:../vista/gestionar_ventas.php?modificarVenta=no&campo=$key");
                break;
            }
            // Validaciones para el campo fecha:
        }elseif($key == "sale_date"){
            // Si la fecha tiene un formato erroneo:
            if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $value)) {
                $mensaje = '<p>La fecha <b>' . $value . '</b> no tiene el formato correcto(YYYY-MM-DD).</p>';
                $validacion = false;

                header("Location:../vista/gestionar_ventas.php?modificarVenta=no&campo=$key");
                break;
                // Si la fecha tiene un formato erroneo:
            }elseif (strtotime($key) == false){
                $mensaje = '<p>La fecha <b>'.$key.'</b> no es una fecha válida.</p>';
                // Otros casos no aceptados:
            }else{
                $mensaje = '<p>La fecha <b>'.$key.'</b> no es válida.</p>';
                $validacion=false;

                header("Location:../vista/gestionar_ventas.php?modificarVenta=no&campo=$key");
                break;
            }
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        // Se crea el objeto venta:
        $venta = new Ventas_modelo($_POST["id"], $_POST["id_product"], $_POST["id_user"], $_POST["sale_date"], $_POST["quantity"]);
        // Se llama a la función actualizarVenta():
        $respuesta = $controlador->actualizarVenta($venta);

        // Si $respuesta es un string significa que hubo un error:
        if(gettype($respuesta) == "string"){

            $_SESSION["formdatamodificar"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajemodificar"]= $respuesta; // Asigna el mensaje.

            header("Location:../vista/gestionar_ventas.php?modificarVenta=no1");

            // Si se han realizado cambios en la base de datos:
        }elseif($respuesta){
            // Se reestablecen los datos de $_SESSION que se muestran. El id es el único valor que NO puede cambiarse, por lo tanto no se reasigna este valor.
            $_SESSION["ID_PRODUCT"] = $_POST["id_product"];
            $_SESSION["ID_USER"] = $_POST["id_user"];
            $_SESSION["SALE_DATE"] = $_POST["sale_date"];
            $_SESSION["QUANTITY"] = $_POST["quantity"];
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>Los datos han sido modificados.</p>';

            header("Location:../vista/gestionar_ventas.php?modificarVenta=si");

            // Si no se ha modificado ningún campo:
        }else{
            $_SESSION["formdatamodificar"] = $_POST;
            $_SESSION["mensajemodificar"] = '<p>No se han podido modificar los datos. Quizás no ha modificado ningún campo.</p>';

            header("Location:../vista/gestionar_ventas.php?modificarVenta=no2");
        }
    }else{
        $_SESSION["formdatamodificar"] = $_POST;
        $_SESSION["mensajemodificar"]= $mensaje;
    }// end if $validación
}// end if post[modificarVenta]
