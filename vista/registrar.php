<?php
include '../modelo/elementos.php';
session_start();
// crear nuevo registro:
?>
<html>

<head>
    <?php
    elementos::head();
    ?>
</head>

<body>
<div class="head">
    <img src="/css/img/telovendo2.png">
</div>

<section style="font-family: 'Abel', sans-serif; margin-top: 10px">
    <li><a href="../index.php"><< volver</a></li>
</section>

<section class="imgFondo">
    <img src="../css/img/fondo2.png">
</section>

<section id="formaulario">
    <div id="d1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="container">

            <?php require_once("../controlador/usuarios_controlador.php"); ?>

            <h2 class="title-form">Crear cuenta</h2>

            <label id="label-form" for="user">Nombre de usuario</label>
            <input type="text" class="user-form" name="user" id="user" placeholder="Nombre de usuario" <?php echo (isset($nick) ? 'value="'.$nick.'"' : ''); echo (($campo == 'user' || $campo == null) ? 'autofocus':''); ?>>

            <label class="label-user-form" id="label-form" for="name">Nombre</label>
            <input type="text" class="user-form" name="name" id="name" <?php echo (isset($name) ? 'value="'.$name.'"' : ''); echo ( $campo == 'name' ? 'autofocus':''); ?>placeholder="Nombre">

            <label class="label-user-form" id="label-form" for="surname">Apellido</label>
            <input type="text" class="user-form" name="surname" <?php echo (isset($surname) ? 'value="'.$surname.'"' : ''); echo ( $campo == 'surname' ? 'autofocus':''); ?>placeholder="Apellido">

            <label class="label-user-form" id="label-form" for="name">Email</label>
            <input type="text" class="user-form" name="email" <?php echo (isset($email) ? 'value="'.$email.'"' : ''); echo ( $campo == 'email' ? 'autofocus':''); ?> placeholder="Email">

            <label class="label-user-form" id="label-form" for="name">Contraseña</label>
            <input type="password" class="user-form" name="password" <?php echo ( $campo == ('password'||'password2') ? 'autofocus':''); ?> placeholder="Contraseña">

            <label class="label-user-form" id="label-form" for="name">Confirmar contraseña</label>
            <input type="password" class="user-form" name="password2" placeholder="Confirmar contraseña">

            <button type="submit" name="registrar" value="Registrar" class="btn">Registrarse</button>
            <br><br>

            <p class="p-registrar-login">Ya tienes una cuenta? <a class="log-reg" href="login.php">Iniciar sesión</a></p>

        </form>
    </div>
</section>

<div class="nombre2">
    <?php
    elementos::nombre();
    ?>
</div>

</body>

</html>
