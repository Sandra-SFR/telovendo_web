<?php

class Conectar{
    /**
     * function
     * Conexion()
     * Crea objeto PDO (abre conexion), establece atributos de error
     *
     * conexion.php
     */
    public static function Conexion(){
        try{
            //Este archivo es requerido desde dos ubicaciones. Es por eso que se realizan dos comprobaciones para verificar si el archivo basededatos.php existe
            if(file_exists("../modelo/conexion/basededatos.php") || file_exists("modelo/conexion/basededatos.php")){
                // En caso de existir lo solicita
                require_once("basededatos.php");
                //instancia objeto PDO
                $conexion = new PDO("mysql:host=".HOST."; dbname=".DBNAME,USER,PASS);
                //Asignación de atributos para detección de errores.
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Codificación para evitar símbolos en carácteres especiales.
                $conexion->exec("SET CHARACTER SET utf8");
                //devuelve objeto Conexion
                return $conexion;
                // en caso de no existir, devuelve un mensaje de error.
            }else{
                return "<p class='warning-form'>No cuenta con los recursos* para conectar con la base de datos. En la página de inicio podrá ver los pasos a seguir para generar los recursos necesarios.<br><small>*Si ya generó los recursos, revise que los datos sean correctos.</small></p>";
            }
            //En caso de exception devuelve el mensaje correspondiente.
        }catch(PDOException $e){
            return self::mensajes($e->getCode());
        }
    }

    /**
     * function
     * Pruebaconexion()
     * Intenta establecer la conexion cone el gestor de base de datos sin acceder a ninguna ddbb.
     * Devuelve un objeto PDO y, en caso de no ser posible la conexion, devuelve mensaje de error
     *
     * conexion.php
     */
    public static function Pruebaconexion(){
        try{
            require_once("basededatos.php");
            $conexion = new PDO("mysql:host=".HOST,USER,PASS); //Conectar::Conexion();
            return $conexion;
        }catch(PDOException $e){
            return self::mensajes($e->getCode());
        }

    }
    /**
     * function
     * mensajes($e)
     *
     * Recibe como parámetro el código de PDOException y devuelve el mensaje de error correspondiente.
     *
     * ddbb_modelo.php
     */
    public static function mensajes($e){
        switch($e){
            case "2002":
                if(file_exists("modelo/conexion/basededatos.php")){
                    return "<p>Error al conectar. Host incorrecto: (" . $e.")</p>";
                }else{
                    return "<p>No cuenta con los recursos* para conectar con la base de datos. Revise que los datos sean correctos.</p>";
                }
                break;
            case "1049":
                return "<p>Error al conectar. No se encuentra la Base de datos: (" . $e.")</p>";
                break;
            case "1045":
                return "<p >Error al conectar. Usuario y/o Contraseña incorrecta: (" . $e.")</p>";
                break;
            case "42000":
                return "<p>Error al conectar. Usuario y/o Contraseña incorrecta: (" . $e.")</p>";
                break;
            case "42S02":
                return "<p>Error en la consulta. No se encuentra la Tabla en la DDBB: (" . $e.")</p>";
                break;
            case "23000":
                return "<p>Ya existe el usuario. Prueba con otro alias (" . $e.")</p>";
                break;
            default:
                return "<p>Error al conectar. ERROR INESPERADO ".$e."</p>";
        }//end Switch
    }//end mensajes($e)
}//end Clase
?>
