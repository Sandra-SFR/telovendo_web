<?php
include '../modelo/elementos.php';
session_start();
if(isset($_SESSION["USER"])){
    header("Location:panel_usuario.php");
}
?>

<html>

    <head>
        <?php
        elementos::head();
        ?>
    </head>

    <body>
        <header class="head">
            <img src="/css/img/telovendo2.png">
        </header>

        <section style="font-family: 'Abel', sans-serif; margin-top: 10px">
            <li><a href="../index.php"><< volver</a></li>
        </section>

        <section class="imgFondo">
            <img src="../css/img/fondo2.png">
        </section>

        <?php
        if(isset($_GET["registrar"])){
            require_once("registrar.php");
        }else{
            ?>
            <section>
                <div class="d1">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="container">
                        <?php require_once("../controlador/usuarios_controlador.php"); ?>
                        <h2>Iniciar Sesión</h2>
                        <br>

                        <label class="label-user-form" id="label-form" for="user">Nombre de usuario</label>
                        <input type="text" class="user-form" name="user" id="user" placeholder="Nombre de usuario" <?php echo (isset($nick) ? 'value="'.$nick.'"' : ''); echo (($campo == 'user' || $campo == null) ? 'autofocus':''); ?>>

                        <label class="label-user-form" id="label-form" for="password">Contraseña</label>
                        <input type="password" class="user-form" name="password" id="password" <?php echo ( $campo == 'password' ? 'autofocus':''); ?> placeholder="Contraseña">

                        <input type="submit" name="login" value="Iniciar sesión" class="btn">
                        <br><br>
                        <p class="p-registrar-login">No tienes una cuenta? <a class="log-reg" href="registrar.php">Registrarse</a></p>
                    </form>
                </div>
            </section>
        <?php } ?>
    </body>
</html>