<!--TODO: revisar los nombres de las variables por si estan mal-->

<?php
include '../modelo/elementos.php';
session_start();

if(!isset($_SESSION["USER"])){
    header("Location:login.php");
}else {?>

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
                <li><a href="../index.php"><< volver</a></li>
                <li><a href="?cerrar">Cerrar Sesión</a></li>
            </section>
        </header>

        <section class="imgFondo">
            <img src="../css/img/fondo2.png">
        </section>

        <br>
        <section>
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
                    <?php require_once("../controlador/usuarios_controlador.php");?>


                    <?php if(isset($_GET["changepass"])){ ?>
                    <h2 class="title-form">Cambiar Contraseña</h2>
                    <div class="div-input">
                        <label class="label-user-form" id="label-form" for="user">Nombre de usuario</label>
                        <input type="text" class="user-form" name="user" placeholder="Nombre de usuario" value="<?php echo $_SESSION["USER"] ?>" disabled title="no puedes cambiar el usuario">
                    </div>
                    <div class="div-input">
                        <label class="label-user-form" id="label-form" for="password">Contraseña actual</label>
                        <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña actual" autofocus>
                    </div>
                    <div class="div-input">
                        <label class="label-user-form" id="label-form" for="password2">Contraseña nueva</label>
                        <input type="password" class="user-form" id="password2" name="password2" placeholder="Contraseña nueva">
                    </div>
                    <div class="div-input">
                        <label class="label-user-form" id="label-form" for="password2confirma">Confirmar contraseña nueva</label>
                        <input type="password" class="user-form" id="password2confirma" name="password2confirma" placeholder="Confirmar contraseña nueva">
                    </div>
                    <div class="btn-datos">
                        <input type="submit" id="changepass" name="changepass" value="Cambiar">
                        <input type="submit" id="cancelpass" name="cancelpass" value="Cancelar"></div>
            </div>
            <?php
            }elseif(isset($_GET["eliminar"])){ ?>
                <h2 class="title-form">Eliminar Cuenta</h2>
                <p class="warning-form">Estás por eliminar tu cuenta de usuario. Esta acción no puede deshacerse.</p>
                <div class="div-input">
                    <input type="text" class="user-form" name="user" placeholder="Nombre de usuario" value="<?php echo $_SESSION["USER"] ?>" disabled title="no puedes cambiar el usuario">
                    <label class="label-user-form" id="label-form" for="user">Nombre de usuario</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña" autofocus>
                    <label class="label-user-form" id="label-form" for="password">Contraseña</label>
                </div>
                <div class="div-input">
                    <input type="password" class="user-form" id="password2" name="password2" placeholder="Confirmar contraseña">
                    <label class="label-user-form" id="label-form" for="password2">Confirmar contraseña</label>
                </div>

                <div class="btn-datos"><input type="submit" id="confirmareliminar" name="confirmareliminar" value="Confirmar">
                    <input type="submit" id="cancelareliminar" name="cancelareliminar" value="Cancelar"></div>

            <?php }else{ ?>

                <h2 class="title-form">Mis Datos</h2>

                <div class="div-input">
                    <label class="label-user-form" id="label-form" for="user">Nombre de usuario</label>
                    <input type="text" class="user-form" name="user" placeholder="Nombre de usuario" value="<?php echo $_SESSION["USER"] ?>" disabled title="no puedes cambiar el usuario">
                </div>
                <div class="div-input">
                    <label class="label-user-form" id="label-form" for="nombre">Nombre</label>
                    <input type="text" class="user-form" id="name" name="name" placeholder="Nombre" <?php echo (isset($_SESSION["NAME"]) ? 'value="'.$_SESSION["NAME"].'"' : ''); echo (($campo == 'name' || $campo == null) ? 'autofocus':''); ?>>
                </div>
                <div class="div-input">
                    <label class="label-user-form" id="label-form" for="surname">Apellido</label>
                    <input type="text" class="user-form" id="surname" name="surname" placeholder="Apellido" <?php echo (isset($_SESSION["SURNAME"]) ? 'value="'.$_SESSION["SURNAME"].'"' : ''); echo ( $campo == 'surname' ? 'autofocus':''); ?>>
                </div>
                <div class="div-input">
                    <label class="label-user-form" id="label-form" for="email">Email</label>
                    <input type="text" class="user-form" id="email" name="email" placeholder="Email" <?php echo (isset($_SESSION["EMAIL"]) ? 'value="'.$_SESSION["EMAIL"].'"' : ''); echo ( $campo == 'email' ? 'autofocus':''); ?>>
                </div>
                <div class="div-input">
                    <label class="label-user-form" id="label-form" for="password">Contraseña</label>
                    <input type="password" class="user-form" id="password" name="password" placeholder="Contraseña" <?php echo (isset($_SESSION["PASSWORD"]) ? 'value="'.$_SESSION["PASSWORD"].'"' : ''); echo ($campo == 'password' ? 'autofocus':''); ?>>
                </div>
                <div class="div-input">
                    <label class="label-user-form" id="label-form" for="usuario">Confirmar contraseña</label>
                    <input type="password" class="user-form" name="password2" placeholder="Confirmar contraseña">
                </div>
                <div>
                    <p><small><a class="log-reg" href="<?php echo $_SERVER['PHP_SELF']."?changepass"; ?>">Cambiar contraseña.</a></small></p>
                    <br>
                </div>
                <div>
                    <button style="background-color: #ffbb80" type="submit" id="modificar" name="modificar" value="Modificar">Modificar cuenta</button>
                    <button style="background-color: #ff8383" type="submit" name="eliminar" value="Eliminar Cuenta">Eliminar cuenta</button>
                </div>
            <?php } ?>

            </form>
            </div>
        </section>
    </body>

    </html>
<?php } ?>

