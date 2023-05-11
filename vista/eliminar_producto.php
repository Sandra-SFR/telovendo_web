<?php
//require_once('../modelo/productos_modelo.php');
require_once('../controlador/productos_controlador.php');

if (isset($_POST['eliminar_producto'])) {
    $id = $_POST['id'];
    productos_controlador::eliminarProducto($id);
    header('Location: gestionar_productos.php');
    exit;
}
?>
