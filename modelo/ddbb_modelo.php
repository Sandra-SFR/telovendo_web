<?php

require_once("conexion/conexion.php");

class Crearddbb
{

    /**
     * function
     * basededatos($nombrehost, $usuariohost, $passwordhost)
     * 1) Crea el archivo basededatos.php que almacena los datos para la conexion con el gestor de base de datos.
     * 2) Comprueba que el archivo haya sido creado y devuelve el mensaje correspondiente.
     * 3) Prueba la conexion para chequear que los datos sean correctos y devuelve mensaje.
     * 4) Intenta crear la base de datos y devuelve mensaje.
     * 5) Intenta crear la tabla y devuelve mensaje.
     *
     * ddbb_modelo.php
     *
     * @param $nombrehost
     * @param $usuariohost
     * @param $passwordhost
     * @return Array
     */
    public static function basededatos($nombrehost, $usuariohost, $passwordhost)
    {
        $archivo = fopen("modelo/conexion/basededatos.php", "w") or die("No se puede abrir/crear el archivo!");
        $php = "<?php 

    define('HOST','" . $nombrehost . "');
    define('USER','" . $usuariohost . "');
    define('PASS', '" . $passwordhost . "');
    define('DBNAME', 'TELOVENDO');

?>";
        fwrite($archivo, $php);
        fclose($archivo);

        $mensajes = array();

        if (file_exists("modelo/conexion/basededatos.php")) {
            $mensajes[] = "<p class='ok-form'>Archivo: El archivo ha sido creado correctamente</p>";

            $prueba = self::pruebaconexion();
            if (gettype($prueba) != "string") {
                $mensajes[] = "<p class='ok-form'>Conexión: Los datos son correctos, conexion establecida.";

                $ddbb = self::creaddbb();
                if (gettype($ddbb) == "object") {
                    $mensajes[] = "<p class='ok-form'>DDBB: La DDBB AA2SFR ha sido creada.";

                    $tabla = self::creatabla();
                    if (gettype($tabla) == "object") {
                        $mensajes[] = "<p class='ok-form'>Tabla: La Tabla USERS ha sido creada.";
                    } else {
                        $mensajes[] = $tabla;
                        return $mensajes;
                    }
                } else {
                    $mensajes[] = $ddbb;
                    return $mensajes;
                }
            } else {
                $mensajes[] = $prueba;
                return $mensajes;
            }
        } else {
            $mensajes[] = "<p class='error-form'>Error, El archivo no pudo ser creado</p>";
        }

        return $mensajes;
    }

    /**
     * function
     * pruebaconexion()
     * Intenta la conexión sin acceder a ninguna base de datos.
     * Devuelve un objeto PDO. en caso de error, devuelve String
     *
     * ddbb_modelo.php
     *
     * @return Object
     */
    public static function pruebaconexion()
    {
        try {
            $conexion = Conectar::Pruebaconexion();
            return $conexion;
            $conexion = null;
        } catch (PDOException $e) {
            return Conectar::mensajes($e->getCode());
        }
    }





}

?>
