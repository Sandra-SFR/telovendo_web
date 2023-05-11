<?php
require_once("conexion/conexion.php");

class admin_modelo
{
    public $nick;
    public $name;
    public $surname;
    public $email;


    /**
     * __construct
     * function($nick, $name, $surname, $email)
     * Constructor del objeto Usuarios_modelo
     *
     * usuarios_modelo.php
     *
     */
    function __construct($nick, $name, $surname, $email){

        $this->nick = $nick;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    /**
     * function
     * getUserById($id)
     * Devuelve Boolean o String en caso de error
     *
     * admin_modelo.php
     */
    public static function getUserById($id){
        try{

            $sql= 'SELECT USER, NAME, SURNAME, EMAIL FROM USERS WHERE USER= ?';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute([$id]);
            $respuesta = $conexion->fetch(PDO::FETCH_ASSOC);

            return $respuesta;

            // $respuesta->closeCursor();
            // $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * getProductById($id)
     * Devuelve Boolean o String en caso de error
     *
     * admin_modelo.php
     */
    public static function getProductById($id){
        try{

            $sql= 'SELECT ID, PRODUCT_NAME, CATEGORY, PRICE FROM PRODUCTS WHERE ID= ?';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute([$id]);
            $respuesta = $conexion->fetch(PDO::FETCH_ASSOC);

            return $respuesta;

            // $respuesta->closeCursor();
            // $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * getSaleById($id)
     * Devuelve Boolean o String en caso de error
     *
     * admin_modelo.php
     */
    public static function getSaleById($id){
        try{

            $sql= 'SELECT ID, ID_PRODUCT, ID_USER, SALE_DATE, QUANTITY FROM SALES WHERE ID= ?';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute([$id]);
            $respuesta = $conexion->fetch(PDO::FETCH_ASSOC);

            return $respuesta;

            // $respuesta->closeCursor();
            // $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * actualizarUsuario($usuario)
     * Devuelve Boolean o String en caso de error
     *
     * admin_modelo.php
     */
    public static function actualizarUsuario($usuario){
        try{

            $sql= 'UPDATE USERS SET NAME=:NOM, SURNAME=:APE, EMAIL=:EMAIL WHERE USER=:USU';
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }
            $conexion =$conexion->prepare($sql);
            $conexion->execute(array(":NOM"=>$usuario->name, ":APE"=>$usuario->surname, ":EMAIL"=>$usuario->email, ":USU"=>$usuario->nick));
            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }

    }
}