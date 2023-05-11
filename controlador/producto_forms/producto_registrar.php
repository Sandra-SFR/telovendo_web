<?php
/**
 *FORM REGISTRAR PRODUCTO (datos y mensajes)
 **/

// si session[formdata] tiene datos:
if(!empty($_SESSION["formdata"])){
    // almacena variables con los datos para mostrarlos al usuario en caso de error:
    $id = trim($_SESSION["formdata"]["id"]);
    $name = trim($_SESSION["formdata"]["name"]);
    $category = trim($_SESSION["formdata"]["category"]);
    $price = trim($_SESSION["formdata"]["price"]);

    if($_GET["registrarProducto"]== ("si" || "no")){
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
 *FORM REGISTRAR PRODUCTO (validacion y consulta)
 **/
//si post[registrarPoducto] está inicializada:
if(isset($_POST["registrarProducto"])) {

    // Se recorren los datos enviados por formulario:
    foreach($_POST as $key=>$value){
        //Se eliminan espacios en blanco del principio y final:
        $value = trim($value);
        // si hay campos en blanco:
        if($value == ""){
            $mensaje = '<p>El campo <b>'.$key.'</b> no puede estár vacío</p>'; // asigna el mensaje de error
            $validacion=false;
            header("Location:". $_SERVER['PHP_SELF']."?registrarProducto=no&campo=$key"); // redirecciona detallando el campo que falló
            break;
            // Validaciones para el campo product_name y category:
        }elseif($key == "product_name" || $key == "category"){
            // si el campo no tiene los caracteres permitidos y si tiene menos de dos caracteres:
            if(!preg_match("/^[ A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{2,20}+$/", $value)){
                $mensaje = '<p>El campo <b>'.$key.'</b> sólo puede contener letras (mínimo 2 y máximo 20 caracteres)</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrarProducto=no&campo=$key");
                break;
            }
            // Validaciones para el campo price:
        }elseif($key == "price"){
            // Si la price tiene un formato erroneo:
            if(!preg_match("/^\d+(\.\d+)?$/", $value)){
                $mensaje = '<p>El número <b>'.$value.'</b> está incorrecto.</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrarProducto=no&campo=$key");
                break;
                // si el campo tiene más de 10 caracteres:
            }elseif(strlen($value) > ($num=10)){
                $mensaje = '<p>El campo <b>'.$key.'</b> no debe ser mayor que '.$num.' caracteres</p>';
                $validacion=false;
                header("Location:". $_SERVER['PHP_SELF']."?registrarProducto=no&campo=$key");
                break;
            }
        }
    }
    // Cuando $validacion es true:
    if($validacion){
        //Se crea un objeto $producto:
        $producto = new Productos_modelo($_POST["id"], $_POST["name"], $_POST["category"], $_POST["price"]);
        //Se llama a la función registrarProducto($producto):
        $respuesta = $controlador->registrarProducto($producto);

        header("Location:../vista/gestionar_productos.php?registrarProducto=si");

        if(gettype($respuesta) == "string"){

            $_SESSION["formdata"] = $_POST; // Almacena datos enviados por formulario.
            $_SESSION["mensajeregistrar"]= $respuesta; // Asigna el mensaje.
            header("Location:../vista/registrar_producto.php?registrarProducto=no1");

            // Si se han realizado cambios en la base de datos:
        }elseif($respuesta){
            // Se reestablecen los datos de $_SESSION que se muestran.
            $_SESSION["ID"] = $_POST["id"];
            $_SESSION["PRODUCT_NAME"] = $_POST["product_name"];
            $_SESSION["CATEGORY"] = $_POST["category"];
            $_SESSION["PRICE"] = $_POST["price"];
            $_SESSION["formdata"] = $_POST;
            $_SESSION["mensajeregistrar"] = '<p>Los datos se han registrado.</p>';

            header("Location:../vista/gestionar_productos.php?registrarProducto=si");

            // Si no se ha modificado ningún campo:
        }else{
            $_SESSION["formdata"] = $_POST;
            $_SESSION["mensajeregistrar"] = '<p>No se han podido registrar los datos. Revisa los datos.</p>'; // se asigna mensaje de error
            header("Location:../vista/registrar_producto.php?registrarProducto=no2");
        }
    }else{
        $_SESSION["formdata"] = $_POST;
        $_SESSION["mensajeregistrar"]= $mensaje;
    }// end if $validación
}// end if post[modificarProducto]


