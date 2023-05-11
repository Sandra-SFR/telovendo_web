<?php
include '../modelo/elementos.php';
require_once ('../modelo/admin_modelo.php');
session_start();

if (isset($_POST['modificar_producto'])) {
    $id = $_POST['id'];
    echo $id;

// Obtener los datos del usuario usando su ID
    $producto = Admin_modelo::getProductById($id);
    print_r($producto);
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
        <li><a href="gestionar_productos.php"><< volver</a></li>
    </section>
</header>

<section style="margin-right: 8%; margin-left: 8%">
    <div class="d1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
            <?php require_once("../controlador/admin_controlador.php");?>

            <h2>Datos del producto</h2><br>
            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div>
                <label id="label-form" for="user">ID del producto</label>
                <input type="text"  id="id" name="id" placeholder="ID producto" value="<?php echo $producto["ID"] ?>" disabled title="no puedes cambiar el usuario">
            </div>
            <div>
                <label id="label-form" for="nombre">Nombre del producto</label>
                <input type="text" id="product_name" name="product_name" placeholder="Nombre" <?php echo (isset($producto["PRODUCT_NAME"]) ? 'value="'.$producto["PRODUCT_NAME"].'"' : ''); echo (($campo == 'product_name' || $campo == null) ? 'autofocus':''); ?>>
            </div>
            <div>
                <label id="label-form" for="surname">Categoria</label>
                <input type="text" id="category" name="category" placeholder="Categoria" <?php echo (isset($producto["CATEGORY"]) ? 'value="'.$producto["CATEGORY"].'"' : ''); echo ( $campo == 'category' ? 'autofocus':''); ?>>
            </div>
            <div>
                <label id="label-form" for="email">Precio</label>
                <input type="text" id="price" name="price" placeholder="0.00" <?php echo (isset($producto["PRICE"]) ? 'value="'.$producto["PRICE"].'"' : ''); echo ( $campo == 'price' ? 'autofocus':''); ?>>
            </div>
            <div><input type="submit" id="modificarProducto" name="modificarProducto" value="Modificar">

                <?php ?>

        </form>
    </div>
</section>
</body>

</html>
