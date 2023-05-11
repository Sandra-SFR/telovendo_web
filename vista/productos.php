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
        <!--Navegador versión usuario logueado 2-->
        <div class="nav">
            <?php
            elementos::nav_log2();
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
            <tr>
                <th colspan="5"><h2>Todos los productos</h2></th>
            </tr>

            <tr>
                <td style="padding-right: 20px"><h3>Id:</h3></td>
                <td style="padding-right: 50px"><h3>Nombre:</h3></td>
                <td style="padding-right: 50px"><h3>Categoria:</h3></td>
                <td style="padding-right: 20px"><h3>Precio:</h3></td>
                <td><h3>Acciones:</h3></td>
            </tr>

            <tr>
                <?php
                require_once("../controlador/productos_controlador.php");
                require_once ("../modelo/productos_modelo.php");
                $products = productos_modelo::getAllProducts();

                foreach ($products as $product): ?>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['product_name']; ?></td>
                <td><?php echo $product['category']; ?></td>
                <td><?php echo $product['price']; ?></td>


                <td style="padding-left: 40px">
                    <form action="añadir_producto.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button style="background-color: #ffc97a; font-size: 18px; border: none" type="submit" name="añadir_producto">
                            <i class='fas fa-cart-plus'></i>
                        </button>
                    </form>
                </td>

            </tr>
            <?php endforeach; ?>
        </table>



        <!--Tabla que busca todos los resultados de categoria y los muestra-->
        <table class="container2">

            <tr>
                <td style="padding-right: 20px; padding-bottom: 15px"><h3>Selecciona una categoria:</h3></td>
            </tr>

            <tr>
                <?php
                require_once("../controlador/productos_controlador.php");
                require_once ("../modelo/productos_modelo.php");
                $categories = productos_modelo::getAllProductsCat();

                foreach ($categories as $category): ?>
                <td><?php echo $category; ?></td>

                <td style="padding-left: 40px">
                    <form action="productos_categoria.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $category; ?>">
                        <button style="background-color: #90fabe; font-size: 18px; border: none" type="submit" name="productos_categoria">
                            ver
                        </button>
                    </form>
                </td>

            </tr>
            <?php endforeach; ?>
        </table>

    </body>

</html>