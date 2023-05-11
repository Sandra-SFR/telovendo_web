<?php
include '../modelo/elementos.php';
require_once ('../modelo/admin_modelo.php');
session_start();

if (isset($_POST['modificar_venta'])) {
    $id = $_POST['id'];
    echo $id;

// Obtener los datos del usuario usando su ID
$venta = Admin_modelo::getSaleById($id);
print_r($venta);
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
        <li><a href="gestionar_ventas.php"><< volver</a></li>
    </section>
</header>

<section style="margin-right: 8%; margin-left: 8%">
    <div class="d1">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
            <?php require_once("../controlador/admin_controlador.php");?>

            <h2>Datos del producto</h2><br>
            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div>
                <label id="label-form" for="id">ID de la venta</label>
                <input type="text"  id="id" name="id" placeholder="ID de la venta" value="<?php echo $venta["ID"] ?>" disabled title="no puedes cambiar el id">
            </div>
            <div>
                <label id="label-form" for="id_product">Id del producto</label>
                <input type="text" id="id_product" name="id_product" placeholder="Id del producto" <?php echo (isset($venta["ID_PRODUCT"]) ? 'value="'.$venta["ID_PRODUCT"].'"' : ''); echo (($campo == 'id_product' || $campo == null) ? 'autofocus':''); ?>>
            </div>
            <div>
                <label id="label-form" for="id_user">Nombre del usuario</label>
                <input type="text" id="id_user" name="id_user" placeholder="Nombre del usuario" <?php echo (isset($venta["ID_USER"]) ? 'value="'.$venta["ID_USER"].'"' : ''); echo (($campo == 'id_user' || $campo == null) ? 'autofocus':''); ?>>
            </div>
            <div>
                <label id="label-form" for="sale_date">Fecha</label>
                <input type="text" id="sale_date" name="sale_date" placeholder="Fecha" <?php echo (isset($venta["SALE_DATE"]) ? 'value="'.$venta["SALE_DATE"].'"' : ''); echo ( $campo == 'sale_date' ? 'autofocus':''); ?>>
            </div>
            <div>
                <label id="label-form" for="quantity">Cantidad</label>
                <input type="text" id="quantity" name="quantity" placeholder="Cantidad" <?php echo (isset($venta["QUANTITY"]) ? 'value="'.$venta["QUANTITY"].'"' : ''); echo ( $campo == 'quantity' ? 'autofocus':''); ?>>
            </div>

            <div><input type="submit" id="modificarVenta" name="modificarVenta" value="Modificar">

                <?php ?>

        </form>
    </div>
</section>
</body>

</html>
