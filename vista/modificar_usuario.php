<?php
include '../modelo/elementos.php';
require_once ('../modelo/admin_modelo.php');
session_start();

if (isset($_POST['modificar_usuario'])) {
    $id = $_POST['id'];
    echo $id;

// Obtener los datos del usuario usando su ID
    $usuario = Admin_modelo::getUserById($id);
    print_r($usuario);
    echo $id;
}
?>

<html>
<head>
    <?php
    elementos::head();
    ?>
</head>

<body>

<header>
    <div class="head">
        <img src="/css/img/telovendo2.png">
    </div>

    <section style="font-family: 'Abel', sans-serif; margin-top: 10px">
        <li><a href="gestionar_usuarios.php"><< volver</a></li>
    </section>
</header>

<section style="margin-right: 8%; margin-left: 8%">
    <div class="d1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
            <?php require_once("../controlador/admin_controlador.php");?>

            <h2>Datos de usuario</h2><br>
            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div>
                <label id="label-form" for="user">Nick de usuario</label>
                <input type="text" id="user" name="user" placeholder="Nick de usuario" value="<?php echo $usuario["USER"] ?>" disabled title="no puedes cambiar el usuario">
            </div>
            <div>
                <label id="label-form" for="nombre">Nombre del usuario</label>
                <input type="text" id="name" name="name" placeholder="Nombre" <?php echo (isset($usuario["NAME"]) ? 'value="'.$usuario["NAME"].'"' : ''); echo (($campo == 'name' || $campo == null) ? 'autofocus':''); ?>>
            </div>
            <div>
                <label id="label-form" for="surname">Apellido del usuario</label>
                <input type="text" id="surname" name="surname" placeholder="Apellido" <?php echo (isset($usuario["SURNAME"]) ? 'value="'.$usuario["SURNAME"].'"' : ''); echo ( $campo == 'surname' ? 'autofocus':''); ?>>
            </div>
            <div>
                <label  id="label-form" for="email">Email del usuario</label>
                <input type="text" id="email" name="email" placeholder="Email" <?php echo (isset($usuario["EMAIL"]) ? 'value="'.$usuario["EMAIL"].'"' : ''); echo ( $campo == 'email' ? 'autofocus':''); ?>>
            </div>
            <div><input type="submit" id="modificarUsuario" name="modificarUsuario" value="Modificar">

                <?php ?>

        </form>
    </div>
</section>
</body>

</html>
