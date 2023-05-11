<?php
require_once("conexion/conexion.php");

class Ventas_modelo
{

    public $id;
    public $id_product;
    public $id_user;
    public $sale_date;
    public $quantity;


    /**
     * __construct
     * function($id, $id_product, $id_user, $sale_date, $quantity)
     * Constructor del objeto Ventas_modelo
     *
     * ventas_modelo.php
     *
     */
    function __construct($id, $id_product, $id_user, $sale_date, $quantity)
    {

        $this->id = $id;
        $this->id_product = $id_product;
        $this->id_user = $id_user;
        $this->sale_date = $sale_date;
        $this->quantity = $quantity;

    }

    /**
     *
     * function
     * registrarVenta($venta)
     * Devuelve Boolean o String en caso de error
     *
     * ventas_modelo.php
     *
     */
    public static function registrarVenta($venta)
    {
        try {
            $conexion = Conectar::Conexion();
            if (gettype($conexion) == "string") {
                return $conexion;
            }

            $sql = "INSERT INTO SALES (ID, ID_PRODUCT, ID_USER, SALE_DATE, QUANTITY) VALUES (:ID, :PRO, :USE, :DAT, :QUA)";
            $respuesta = $conexion->prepare($sql);
            $respuesta = $respuesta->execute(array(":ID" => $venta->id, ":PRO" => $venta->id_product, ":USE" => $venta->id_user, ":DAT" => $venta->sale_date, ":QUA" => $venta->quantity));
            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;

        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     *
     * function
     * actualizarVenta($venta)
     * Devuelve Boolean o String en caso de error
     *
     * ventas_modelo.php
     *
     */
    public static function actualizarVenta($venta)
    {
        try {

            $sql = 'UPDATE SALES SET ID_PRODUCT=:PRO, ID_USER=:USE, SALE_DATE=:DAT, QUANTITY=:QUA WHERE ID=:ID';
            $conexion = Conectar::Conexion();
            if (gettype($conexion) == "string") {
                return $conexion;
            }
            $conexion = $conexion->prepare($sql);
            $conexion->execute(array(":PRO" => $venta->id_product, ":USE" => $venta->id_user, ":DAT" => $venta->sale_date, ":QUA" => $venta->quantity, ":ID" => $venta->id));
            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }

    }


    /**
     *
     * function
     * eliminarVenta($id)
     * Devuelve Boolean o String en caso de error
     *
     * ventas_modelo.php
     *
     */
    public static function eliminarVenta($id)
    {
        try {
            $sql = 'DELETE FROM SALES WHERE ID=:ID';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute(array(":ID" => $id));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;
        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     *
     * function
     * getAllSales()
     * Devuelve Boolean o String en caso de error
     *
     * ventas_modelo.php
     *
     */
    public static function getAllSales()
    {
        try {

            $sql = 'SELECT * FROM SALES';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute();
            $respuesta = $conexion->fetchAll(PDO::FETCH_ASSOC);

            return $respuesta;

            // $respuesta->closeCursor();
            // $conexion = null;
        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }
}