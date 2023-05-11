<?php
require_once("conexion/conexion.php");

class Productos_modelo{

    public $id;
    public $name;
    public $category;
    public $price;

    /**
     * __construct
     * function($id, $name, $category, $pricel)
     * Constructor del objeto Productos_modelo
     *
     * productos_modelo.php
     *
     */
    function __construct($id, $name, $category, $price){

        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }

    /**
     * function
     * get_productoCat($category)
     * Devuelve Boolean o String en caso de error
     *
     * productos_modelo.php
     *
     */
    public static function get_productoCat($category){
        try{
            $conexion = Conectar::Conexion();

            //Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if(gettype($conexion) == "string"){
                return $conexion;
            }

            $sql = "SELECT * FROM PRODUCTS WHERE CATEGORY=:category";
            $respuesta = $conexion->prepare($sql);
            $respuesta->execute(array(':category'=>$category));
            $respuesta = $respuesta->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;


            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * registrarProducto($producto)
     * Devuelve Boolean o String en caso de error
     *
     * productos_modelo.php
     *
     */
    public static function registrarProducto($producto){
        try{
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }

            $sql = "INSERT INTO PRODUCTS (ID, PRODUCT_NAME, CATEGORY, PRICE) VALUES (:ID, :NOM, :CAT, :PRI)";
            $respuesta = $conexion->prepare($sql);
            $respuesta = $respuesta->execute(array(":ID"=>$producto->id, ":NOM"=>$producto->name, ":CAT"=>$producto->category, ":PRI"=>$producto->price));
            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * actualizarProducto($producto)
     * Devuelve Boolean o String en caso de error
     *
     * productos_modelo.php
     *
     */
    public static function actualizarProducto($producto){
        try{

            $sql= 'UPDATE PRODUCTS SET PRODUCT_NAME=:NOM, CATEGORY=:CAT, PRICE=:PRI WHERE ID=:ID';
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }
            $conexion =$conexion->prepare($sql);
            $conexion->execute(array(":NOM"=>$producto->name, ":CAT"=>$producto->category, ":PRI"=>$producto->price, ":ID"=>$producto->id));
            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }

    }

    /**
     * function
     * eliminarProducto($id)
     * Devuelve Boolean o String en caso de error
     *
     * productos_modelo.php
     *
     */
    public static function eliminarProducto($id){
        try{
            $sql= 'DELETE FROM PRODUCTS WHERE ID=:ID';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute(array(":ID"=>$id));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * getAllProducts()
     * Devuelve Boolean o String en caso de error
     *
     * productos_modelo.php
     *
     */
    public static function getAllProducts(){
        try{

            $sql= 'SELECT * FROM PRODUCTS';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute();
            $respuesta = $conexion->fetchAll(PDO::FETCH_ASSOC);

            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     *function
     * getAllProductsCat()
     * Lista todas las categorias una sola vez(distinct) para no duplicar resultados.
     *
     * productos_modelo.php
     **/
    public static function getAllProductsCat(){
        try{

            $sql= 'SELECT DISTINCT CATEGORY FROM PRODUCTS';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute();
            $respuesta = $conexion->fetchAll(PDO::FETCH_COLUMN);

            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

}