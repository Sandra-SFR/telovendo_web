<?php
/**
 * Formulario registrar un producto
 * Datos y mensajes
 */

// si session[formdata] tiene datos:
if(!empty($_SESSION["formdata"])){
    // almacena variables con los datos para mostrarlos al usuario en caso de error.
    $id = trim($_SESSION["formdata"]["id"]);
    $id_product = trim($_SESSION["formdata"]["id_product"]);
    $id_user = trim($_SESSION["formdata"]["id_user"]);
    $sale_date = trim($_SESSION["formdata"]["sale_date"]);
    $quantity = trim($_SESSION["formdata"]["quantity"]);


    if($_GET["registrarVenta"]== ("si" || "no")){
        echo $_SESSION["mensajeregistrar"];
        if(!empty($_GET["campo"])){
            $campo = $_GET["campo"]; //Almacena el campo incorrecto en el formulario.
        }
    }
    // Elimina los datos almacenados en session:
    unset($_SESSION["formdata"]);
    unset($_SESSION["mensajeregistrar"]);
}

/**
 * Formulario registrar una venta
 *
 */
// Post["modificarVenta"] está inicializada:
if(isset($_POST["registrarVenta"])){

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>';
            $validacion=false;

            header("Location:../vista/registrar_venta.php?registrarVenta=no&campo=$key");
            break;
            // Validaciones para el campo id_product y quantity:
        }elseif($key == "id_product" || $key == "quantity"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[0-9]{1,10}$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener números (mínimo 1 y máximo 10 caracteres)</p>';
                $validacion=false;

                header("Location:../vista/registrar_venta.php?registrarVenta=no&campo=$key");
                break;
            }
            // Validaciones para el campo id_user:
        }elseif($key == "id_user"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;

                header("Location:../vista/registrar_venta.php?registrarVenta=no&campo=$key");
                break;
            }
            // Validaciones para el campo fecha:
        }elseif($key == "sale_date"){
            // Si la fecha tiene un formato erroneo:
            if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $value)) {
                $mensaje = '<p>La fecha <b>' . $value . '</b> no tiene el formato correcto(YYYY-MM-DD).</p>';
                $validacion = false;

                header("Location:../vista/registrar_venta.php?registrarVenta=no&campo=$key");
                break;
                // Si la fecha tiene un formato erroneo:
            }elseif (strtotime($key) == false){
                $mensaje = '<p>La fecha <b>'.$key.'</b> no es una fecha válida.</p>';
                // Otros casos no aceptados:
            }else{
                $mensaje = '<p>La fecha <b>'.$key.'</b> no es válida.</p>';
                $validacion=false;

                header("Location:../vista/registrar_venta.php?registrarVenta=no&campo=$key");
                break;
            }
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        //Se crea un objeto $venta:
        $venta = new Ventas_modelo($_POST["id"],$_POST["id_product"], $_POST["id_user"], $_POST["sale_date"], $_POST["quantity"]);
        //Se llama a la función registrarVenta($venta):
        $respuesta = $controlador->registrarVenta($venta);

        header("Location:../vista/gestionar_ventas.php?registrarVenta=si");

        // Si $respuesta es un string significa que hubo un error:
        if(gettype($respuesta) == "string"){

            $_SESSION["formdata"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajeregistrar"]= $respuesta; // Asigna el mensaje.

            header("Location:../vista/registrar_venta.php?registrarVenta=no1");

            // Si se han realizado cambios en la base de datos:
        }elseif($respuesta){
            // Se reestablecen los datos de $_SESSION que se muestran.
            $_SESSION["ID"] = $_POST["id"];
            $_SESSION["ID_PRODUCT"] = $_POST["id_product"];
            $_SESSION["ID_USER"] = $_POST["id_user"];
            $_SESSION["SALE_DATE"] = $_POST["sale_date"];
            $_SESSION["QUANTITY"] = $_POST["quantity"];
            $_SESSION["formdata"] = $_POST;
            $_SESSION["mensajeregistrar"] = '<p>Los datos han sido registrados.</p>';

            header("Location:../vista/gestionar_ventas.php?modificarVenta=si");

            // Si no se ha modificado ningún campo:
        }else{
            $_SESSION["formdata"] = $_POST;
            $_SESSION["mensajeregistrar"] = '<p>No se han podido registrar los datos. Revisa los datos.</p>';

            header("Location:../vista/registrar_venta.php?registrarVenta=no2");
        }
    }else{
        $_SESSION["formdata"] = $_POST;
        $_SESSION["mensajeregistrar"]= $mensaje;
    }// end if $validación
}// end if post[registrarVenta]
?>
