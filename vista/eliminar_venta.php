<?php
require_once('../modelo/ventas_modelo.php');

if (isset($_POST['eliminar_venta'])) {
    $id = $_POST['id'];
    ventas_modelo::eliminarVenta($id);
    header('Location: gestionar_ventas.php');
    exit;
}
?>