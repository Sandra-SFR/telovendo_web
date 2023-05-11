<?php
//TODO: revisar
/**
Eliminar un producto
 **/
// Si no está vacío:
if(!empty($_SESSION["mensajeeliminar"])){

    if(isset($_GET["eliminarProducto"])){
        if($_GET["eliminarProducto"]=="no"){
            echo $_SESSION["mensajeeliminar"];  // Muestra mensaje.
        }
    }
    unset($_SESSION["mensajeeliminar"]); // Elimina los datos almacenados en session.
}

/**
Si el usuario es el administrador borra el registro
 **/
// Si se a presionado el boton de eliminar (siendo el administrador):
if($_SESSION["USER"]=="Administrador" && isset($_POST["eliminarProducto"])){
    $id = $_POST['id'];
    $conexion -> eliminarProducto($id);

    echo $_SESSION["mensajeeliminar"] = '<p>El producto ha sido eliminado.</p>';
    header("Location:../vista/gestionar_productos.php?eliminarProducto");

}
?>