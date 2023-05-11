<?php
require_once("conexion/conexion.php");

class Usuarios_modelo {

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
     * get_usuario($nick, $password)
     * Devuelve Boolean o String en caso de error
     *
     * usuarios_modelo.php
     */
    public static function get_usuario($nick, $password){
        try{
            $password = self::cryptconmd5($password);
            $conexion = Conectar::Conexion();

            //Si $conexion es de tipo String, es porque se produjo una excepción. Para la ejecución de la función devolviendo el mensaje de la excepción.
            if(gettype($conexion) == "string"){
                return $conexion;
            }

            $sql = "SELECT USER, NAME, SURNAME, EMAIL FROM USERS WHERE USER=:user AND PASSWORD=:password";
            $respuesta = $conexion->prepare($sql);
            $respuesta->execute(array(':user'=>$nick, ':password'=>$password));
            $respuesta = $respuesta->fetch(PDO::FETCH_ASSOC);

            // Si el array no está vacío, crea y devuelve un objeto Usuario.
            if($respuesta){
                $usuario = new Usuarios_modelo($respuesta["USER"], $respuesta["NAME"], $respuesta["SURNAME"], $respuesta["EMAIL"]);
                return $usuario;
            }else{
                return $usuario = null;
            }
            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * registrar($usuario, $password)
     * Devuelve Boolean o String en caso de error
     *
     * usuarios_modelo.php
     */
    public static function registrar($usuario, $password){
        try{
            $password = self::cryptconmd5($password);
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }

            $sql = "INSERT INTO USERS (USER, NAME, SURNAME, EMAIL, PASSWORD) VALUES (:USU, :NOM, :APE, :EMAIL, :PASS)";
            $respuesta = $conexion->prepare($sql);
            $respuesta = $respuesta->execute(array(":USU"=>$usuario->nick, ":NOM"=>$usuario->name, ":APE"=>$usuario->surname, ":EMAIL"=>$usuario->email, ":PASS"=>$password));
            return $respuesta;

            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * actualizar($usuario, $password)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     */
    public static function actualizar($usuario, $password){
        try{
            $password = self::cryptconmd5($password);
            $sql= 'UPDATE USERS SET NAME=:NOM, SURNAME=:APE, EMAIL=:EMAIL WHERE USER=:USU AND PASSWORD=:PASS';
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }
            $conexion =$conexion->prepare($sql);
            $conexion->execute(array(":NOM"=>$usuario->name, ":APE"=>$usuario->surname, ":EMAIL"=>$usuario->email, ":USU"=>$usuario->nick, ":PASS"=>$password));
            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }

    }

    /**
     * function
     * cambiapass($alias, $password_actual, $password_nuevo)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     */
    public static function changepass($nick, $password_actual, $password_nuevo){

        try{
            $password_nuevo = self::cryptconmd5($password_nuevo);
            $usuario = self::get_usuario($nick, $password_actual);

            if(gettype($usuario) == "string"){
                return $usuario;
            }elseif($usuario == null){
                return '<p class="error-form">Contraseña incorrecta. No se a cambiado su clave de user</p>';
            }
            $sql= 'UPDATE USERS SET PASSWORD=:PASSNUEVO WHERE USER=:USU AND PASSWORD=:PASS';
            $conexion = Conectar::Conexion();
            if(gettype($conexion) == "string"){
                return $conexion;
            }
            $conexion =$conexion->prepare($sql);
            $password_actual = self::cryptconmd5($password_actual);
            $conexion->execute(array(":PASSNUEVO"=>$password_nuevo,":USU"=>$usuario->nick, ":PASS"=>$password_actual));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;

        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }

    }

    /**
     * function
     * eliminar($alias, $password)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     */
    public static function eliminar($nick, $password){
        try{
            $password = self::cryptconmd5($password);
            $sql= 'DELETE FROM USERS WHERE USER=:USU AND PASSWORD=:PASS';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute(array(":USU"=>$nick, ":PASS"=>$password));

            return $respuesta = $conexion->rowCount();

            $respuesta->closeCursor();
            $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * eliminar($id)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_modelo.php
     */
    public static function eliminarUsuarioPorId($id) {

        try{
            $sql = "DELETE FROM users WHERE user = ?";
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute([$id]);

            return $respuesta = $conexion->rowCount();
            $respuesta->closeCursor();

            $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }


    /**
     * function
     * Devuelve todos los usuarios
     *
     * usuarios_modelo.php
     *
     */
    public static function getAllUsers(){
        try{

            $sql= 'SELECT * FROM USERS';
            $conexion = Conectar::Conexion()->prepare($sql);
            $conexion->execute();
            $respuesta = $conexion->fetchAll(PDO::FETCH_ASSOC);

            return $respuesta;

            // $respuesta->closeCursor();
            // $conexion = null;
        }catch(PDOException $e){
            return Conectar::mensajes($e->getCode());
        }
    }

    /**
     * function
     * cryptconmd5($password)
     * Devuelve clave encriptada
     *
     * usuarios_modelo.php
     */
    public static function cryptconmd5($password) {
        //Crea un salt
        $salt = md5($password."%*4!#$;.k~’(_@");
        $password = md5($salt.$password.$salt);
        return $password;
    }

}//end class
?>
