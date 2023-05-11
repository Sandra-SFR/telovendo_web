<?php
require_once("../modelo/usuarios_modelo.php");

class Usuarios_Controlador{

    public function __construct(){}


    /**
     * function
     * iniciar_sesion($nick, $password)
     * Devuelve objeto Usuarios_modelo o String en caso de error
     *
     * usuarios_controlador.php
     */
    public function iniciar_sesion($nick, $password){
        $usuario = Usuarios_modelo::get_usuario($nick, $password);
        return $usuario;
    }

    /**
     * function
     * registrar($usuario, $password)
     * Devuelve Boolean o String en caso de error
     *
     * usuarios_controlador.php
     */
    public function registrar($usuario, $password){
        $registro = Usuarios_modelo::registrar($usuario, $password);
        return $registro;
    }

    /**
     * function
     * actualizar($usuario, $password)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_controlador.php
     */
    public function actualizar($usuario, $password){
        $usuario = Usuarios_modelo::actualizar($usuario, $password);
        return $usuario;
    }

    /**
     * function
     * eliminar($nick, $password)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_controlador.php
     */
    public function eliminar($nick, $password){
        $usuario = Usuarios_modelo::eliminar($nick, $password);
        return $usuario;
    }

    /**
     * function
     * cambiapass($nick, $password_actual, $password_nuevo)
     * Devuelve Integer o String en caso de error
     *
     * usuarios_controlador.php
     */
    public function changepass($nick, $password_actual, $password_nuevo){
        $usuario = Usuarios_modelo::changepass($nick, $password_actual, $password_nuevo);
        return $usuario;
    }
    /**
     * function
     * cerra()
     * Elimina sesión y redirecciona al index.
     */
    public function cerrar(){
        $_SESSION = array();
        session_destroy();
        header("Location: ../index.php");
    }

}//end Clase

//Valiables y objeto controlador utilizad@s en los require_once:
$campo=null;
$validacion=true;
$controlador = new Usuarios_Controlador();
//Cerrar sesión
if(isset($_GET["cerrar"])){
    $controlador->cerrar();
}

/* Cada require contiene las validaciones de formularios y acciones a realizar en la DDBB a través de modelo/Usuarios_modelo */
require_once("usuario_forms/usuario_login.php");
require_once("usuario_forms/usuario_registrar.php");
require_once("usuario_forms/usuario_modificar.php");
require_once("usuario_forms/usuario_eliminar.php");
require_once("usuario_forms/usuario_cambiapass.php");

?>
