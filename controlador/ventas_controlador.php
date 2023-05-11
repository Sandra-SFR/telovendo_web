<?php
require_once ("../modelo/ventas_modelo.php");
class Ventas_controlador{

    public function __construct(){}

    /**
     * function
     * registrarVenta($venta)
     * Devuelve Boolean o String en caso de error
     *
     * ventas_controlador.php
     */
    public function registrarVenta($venta){
        $registro = Ventas_modelo::registrarVenta($venta);
        return $registro;
    }

}
//Valiables y objeto controlador utilizad@s en los require_once:
$campo=null;
$validacion=true;
$controlador = new Ventas_controlador();

require_once ('venta_forms/venta_registrar.php');