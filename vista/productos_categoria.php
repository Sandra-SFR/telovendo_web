<?php
include '../modelo/elementos.php';
session_start();

if (isset($_POST['productos_categoria'])) {
    $category = $_POST['id'];
    echo $category;
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
</header>

<div class="nav">
    <?php
    elementos::nav_log2();
    ?>
</div>

<div class="nombre2">
    <?php
    elementos::nombre();
    ?>
</div>

<form>
    <table class="container">

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
            $category = $_POST['id'];
            $products = productos_modelo::get_productoCat($category);

            foreach ($products as $product): ?>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo $product['category']; ?></td>
            <td><?php echo $product['price']; ?></td>


            <td style="padding-left: 40px">
                <form action="añadir_producto.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button style="background-color: #ffb84e; font-size: 18px; border: none" type="submit" name="añadir_producto">
                        <i class='fas fa-cart-plus'></i>
                    </button>
                </form>
            </td>

        </tr>
        <?php endforeach; ?>
    </table>
</form>

</body>

</html>
