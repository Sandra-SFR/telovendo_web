<?php
#Verifica si hay sesión iniciada
require_once("controlador/sesion_start.php");
include 'modelo/elementos.php';
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

        <section class="nav">
            <?php
            if(!isset($_SESSION["USER"])){
                elementos::nav_principal();
            }elseif($_SESSION["USER"]=="Administrador"){
                elementos::nav_admin();
            }else{
                elementos::nav_log();
            } ?>
        </section>

        <section class="imgFondo">
            <img src="../css/img/fondo2.png">
        </section>

        <div class="nombre2">
            <?php
            elementos::nombre();
            ?>
        </div>

    </body>

</html>

