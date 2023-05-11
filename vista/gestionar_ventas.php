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
            elementos::nav_ventas();
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
                <td style="padding-right: 20px"><h3>Venta:</h3></td>
                <td style="padding-right: 20px"><h3>Producto:</h3></td>
                <td style="padding-right: 50px"><h3>Usuario:</h3></td>
                <td style="padding-right: 130px"><h3>Fecha:</h3></td>
                <td style="padding-right: 20px"><h3>Cantidad:</h3></td>
                <td><h3>Acciones:</h3></td>
            </tr>

            <tr>
                <?php
                require_once("../controlador/admin_controlador.php");
                require_once ("../modelo/ventas_modelo.php");
                $sales = ventas_modelo::getAllSales();

                foreach ($sales as $sale):
                $id = $sale["id"];
                $id_product = $sale["id_product"];
                $id_user = $sale["id_user"];
                $date = $sale["sale_date"];
                $quantity = $sale["quantity"];
                ?>
                <td><?php echo $id ?></td>
                <td><?php echo $id_product?></td>
                <td><?php echo $id_user?></td>
                <td><?php echo $date?></td>
                <td><?php echo $quantity?></td>


                <td style="padding-left: 40px">
                    <form action="eliminar_venta.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
                        <button style="background-color: #fd6868" type="submit" name="eliminar_venta">
                            <i class='far fa-trash-alt'></i>
                        </button>
                    </form>
                </td>
                <td>
                    <form action="modificar_venta.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $sale['id']; ?>">
                        <button style="background-color: #f1a258" type="submit" name="modificar_venta">
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