<?php
include '../modelo/elementos.php';
session_start();

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
        </header>

        <div class="nav">
            <?php
            elementos::nav_usuarios();
            ?>
        </div>

        <section class="imgFondo">
            <img src="../css/img/fondo2.png">
        </section>

        <div class="nombre2">
            <?php
            elementos::nombre();
            ?>
        </div>

        <table class="container">
            <tr> <?php
                if (isset($_SESSION["mensajemodificar"])) {
                    echo '<div class="mensaje">' . $_SESSION["mensajemodificar"] . '</div>';
                    unset($_SESSION["mensajemodificar"]);
                }
                ?></tr>

            <tr>
                <td style="padding-right: 20px"><h3>Usuario:</h3></td>
                <td style="padding-right: 50px"><h3>Nombre:</h3></td>
                <td style="padding-right: 50px"><h3>Apellido:</h3></td>
                <td style="padding-right: 20px"><h3>Email:</h3></td>
                <td ><h3>Acciones:</h3></td>
            </tr>

            <tr>
                <?php
                require_once("../controlador/admin_controlador.php");
                require_once ("../modelo/usuarios_modelo.php");
                $users = usuarios_modelo::getAllUsers();

                foreach ($users as $user):
                $id = $user["USER"];
                $nombre = $user["NAME"];
                $apellido = $user["SURNAME"];
                $email = $user["EMAIL"];
                ?>
                <td><?php echo $id ?></td>
                <td><?php echo $nombre?></td>
                <td><?php echo $apellido?></td>
                <td><?php echo $email?></td>

                <td style="padding-left: 40px">
                    <form action="eliminar_usuario.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $user['USER']; ?>">
                        <button style="background-color: #fd6868" type="submit" name="eliminar_usuario">
                            <i class='far fa-trash-alt'></i>
                        </button>
                    </form>
                </td>
                <td>
                    <form action="modificar_usuario.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $user['USER']; ?>">
                        <button style="background-color: #f1a258" type="submit" name="modificar_usuario">
                            <i class='fas fa-pen'></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        </form>
        </div>
        </section>

    </body>

</html>
