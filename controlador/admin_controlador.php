<?php
require_once ("../modelo/usuarios_modelo.php");
require_once ("../modelo/productos_modelo.php");
/*require_once ("../modelo/ventas_modelo.php");*/
require_once ("../modelo/admin_modelo.php");


class admin_controlador {

    public function __construct(){}

    /**
     * function
     * actualizarUsuario($usuario)
     * Devuelve Integer o String en caso de error
     *
     * admin_controlador.php
     */
    public function actualizarUsuario($usuario){
        $usuario = admin_modelo::actualizarUsuario($usuario);
        return $usuario;
    }

    /**
     * function
     * actualizarProducto($producto)
     * Devuelve Integer o String en caso de error
     *
     * admin_controlador.php
     */
    public function actualizarProducto($producto){
        $producto = Productos_modelo::actualizarProducto($producto);
        return $producto;
    }

    /**
     * function
     * actualizarVenta($venta)
     * Devuelve Integer o String en caso de error
     *
     * admin_controlador.php
     */
    public function actualizarVenta($venta){
        $venta = Ventas_modelo::actualizarVenta($venta);
        return $venta;
    }


}

$campo=null;
$validacion=true;
$controlador = new Admin_Controlador();

/*require_once ('admin_forms/admin_eliminar_usuario.php');
require_once ('admin_forms/admin_modificar_usuario.php');
require_once ('admin_forms/admin_eliminar_producto.php');
require_once ('admin_forms/admin_modificar_producto.php');
require_once ('admin_forms/admin_modificar_venta.php');*/
?>