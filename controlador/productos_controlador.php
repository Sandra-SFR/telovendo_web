<?php
require_once("../modelo/productos_modelo.php");
class productos_controlador
{
    public function __construct(){}

    /**
     * function
     * registrarProducto($producto)
     * Devuelve Integer o String en caso de error
     *
     * productos_controlador.php
     */
    public function registrarProducto($producto){
        $registro = Productos_modelo::registrarProducto($producto);
        return $registro;
    }

    /**
     * function
     * actualizarProducto($producto)
     * Devuelve Integer o String en caso de error
     *
     * productos_controlador.php
     */
    public function actualizarProducto($producto){
        $producto = Productos_modelo::actualizarProducto($producto);
        return $producto;
    }

    /**
     * function
     * eliminar($id)
     * Devuelve Integer o String en caso de error
     *
     * productos_controlador.php
     */
    public static function eliminarProducto($id){
        $producto= Productos_modelo::eliminarProducto($id);
        return $producto;
    }


}//end Clase

//Valiables y objeto controlador utilizad@s en los require_once:
$campo=null;
$validacion=true;
$controlador = new Productos_Controlador();


require_once ('producto_forms/producto_registrar.php');
?>
