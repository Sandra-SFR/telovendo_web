<?php
//TODO: revisar
/**
 *Eliminar un Usuario por id
 * datos y mensajes
 **/
// Si no está vacío:
if(!empty($_SESSION["mensajeeliminar"])){

    if(isset($_GET["eliminarUsuario"])){
        if($_GET["eliminarUsuario"]=="no"){
            echo $_SESSION["mensajeeliminar"];  // Muestra mensaje.
        }
    }
    unset($_SESSION["mensajeeliminar"]); // Elimina los datos almacenados en session.
}

/**
 *Si el usuario es el administrador borra el registro
 *
 **/
// Si se a presionado el boton de eliminar (siendo el administrador):
if($_SESSION["USER"]=="Administrador" && isset($_POST["eliminarUsuario"])){
    $id = $_POST['id'];
    $conexion -> eliminarUsuarioPorId($id);

    echo $_SESSION["mensajeeliminar"] = '<p>El usuario ha sido eliminado.</p>';
    header("Location:../vista/gestionar_usuarios.php?eliminarUsuario");

}
?>
