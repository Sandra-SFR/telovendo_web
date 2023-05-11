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

        <section class="imgFondo">
            <img src="../css/img/fondo2.png">
        </section>

        <section id="formulario">
            <div id="d1">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="container">

                    <?php require_once("../controlador/ventas_controlador.php"); ?>

                    <h2 class="title-form">Crear venta</h2>

                    <label id="label-form" for="id">ID de la  venta</label>
                    <input type="text" name="id" id="id" placeholder="Id de la venta" <?php echo (isset($id)? 'value="'.$id.'"' : ''); echo (($campo == 'id' || $campo == null) ? 'autofocus':''); ?>>

                    <label class="label-user-form" id="label-form" for="id_product">Id del producto</label>
                    <input type="text" name="id_product" id="id_product" <?php echo (isset($id_product) ? 'value="'.$id_product.'"' : ''); echo ( $campo == 'id_product' ? 'autofocus':''); ?>placeholder="ej: 6">

                    <label class="label-user-form" id="label-form" for="id_user">Id del usuario</label>
                    <input type="text" name="id_user" id="id_user" <?php echo (isset($id_user) ? 'value="'.$id_user.'"' : ''); echo ( $campo == 'id_user' ? 'autofocus':''); ?>placeholder="ej: Administrador">

                    <label class="label-user-form" id="label-form" for="category">Fecha</label>
                    <input type="text" name="sale_date" id="sale_date" <?php echo (isset($sale_date) ? 'value="'.$sale_date.'"' : ''); echo ( $campo == 'sale_date' ? 'autofocus':''); ?>placeholder="YYYY-MM-DD">

                    <label class="label-user-form" id="label-form" for="quantity">Cantidad</label>
                    <input type="number" name="quantity" id="quantity" <?php echo (isset($quantity) ? 'value="'.$quantity.'"' : ''); echo ( $campo == 'quantity' ? 'autofocus':''); ?> placeholder="00">

                    <button type="submit" name="registrarVenta" value="registrarVenta" class="btn">Registrar</button>
                    <br><br>

                    <a class="log-reg" href="gestionar_ventas.php">Ver ventas</a>

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