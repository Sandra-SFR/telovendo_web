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

                    <?php require_once("../controlador/productos_controlador.php"); ?>

                    <h2 class="title-form">Crear producto</h2>

                    <label id="label-form" for="id">ID del producto</label>
                    <input type="text" name="id" id="id" placeholder="Id del producto" <?php echo (isset($id)? 'value="'.$id.'"' : ''); echo (($campo == 'id' || $campo == null) ? 'autofocus':''); ?>>

                    <label class="label-user-form" id="label-form" for="name">Nombre del producto</label>
                    <input type="text" name="name" id="name" <?php echo (isset($name) ? 'value="'.$name.'"' : ''); echo ( $campo == 'name' ? 'autofocus':''); ?>placeholder="Nombre del producto">

                    <label class="label-user-form" id="label-form" for="category">Categoria</label>
                    <input type="text" name="category" id="category" <?php echo (isset($category) ? 'value="'.$category.'"' : ''); echo ( $campo == 'category' ? 'autofocus':''); ?>placeholder="Categoria">

                    <label class="label-user-form" id="label-form" for="price">Precio</label>
                    <input type="number" name="price" id="price" <?php echo (isset($price) ? 'value="'.$price.'"' : ''); echo ( $campo == 'price' ? 'autofocus':''); ?> placeholder="0.00">

                    <button type="submit" name="registrarProducto" value="Registrar" class="btn">Registrar</button>
                    <br><br>

                    <a class="log-reg" href="gestionar_productos.php">Ver productos</a>

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

