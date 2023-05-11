<?php
require_once('../modelo/usuarios_modelo.php');

if (isset($_POST['eliminar_usuario'])) {
    $id = $_POST['id'];
    usuarios_modelo::eliminarUsuarioPorId($id);
    header('Location: gestionar_usuarios.php');
    exit;
}
?>
