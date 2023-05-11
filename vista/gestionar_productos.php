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
            elementos::nav_productos();
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
                <td style="padding-right: 20px"><h3>Id:</h3></td>
                <td style="padding-right: 50px"><h3>Nombre:</h3></td>
                <td style="padding-right: 50px"><h3>Categoria:</h3></td>
                <td style="padding-right: 20px"><h3>Precio:</h3></td>
                <td style="padding-right: 120px"><h3>Fecha:</h3></td>
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
                <td><?php echo $product['selling_date']; ?></td>


                <td style="padding-left: 40px">
                    <form action="eliminar_producto.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button style="background-color: #fd6868"  type="submit" name="eliminar_producto">
                            <i class='far fa-trash-alt'></i>
                        </button>
                    </form>
                </td>
                <td>
                    <form action="modificar_producto.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button style="background-color: #f1a258" type="submit" name="modificar_producto">
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
