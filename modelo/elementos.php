<?php
// funciones para reducir codigo html y lineas repetitivas.
class elementos
{
    /**
     *function
     * head()
     * Cabecera del html para resumir.
     *
     * elementos.php
     **/
    public static function head(){
        echo '<meta charset="UTF-8">
        <title>AA Interfaces</title>
        <link rel="StyleSheet" href="/../css/style.css" type="text/css">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script&display=swap" rel="stylesheet">';
    }

    /**
     *function
     * nav_principal()
     * Navegador cuando no hay sesion iniciada.
     *
     * elementos.php
     **/
    public  static function nav_principal(){
        echo '<ul>
                <li><a class="pactual" href="index.php">AA2 interfaces</a></li>
                <li><a href="vista/registrar.php">Formulario registro</a></li>
                <li><a href="vista/login.php">Logging</a></li>
                <li><a href="vista/lista_compra.php"><i style="font-size:16px" class="fas">&#xf07a;</i></a></li>
            </ul>';
    }

    /**
     *function
     * nav_admin()
     * Navegador del html para resumir. Administrador vista general.
     *
     * elementos.php
     **/
    public  static function nav_admin(){
        echo '<ul>
                <li><a class="pactual" href="index.php">Home</a></li>
                <li><a href="vista/gestionar_usuarios.php">Usuarios</a></li>
                <li><a href="vista/gestionar_productos.php">Productos</a></li>
                <li><a href="vista/gestionar_ventas.php">Ventas</a></li>
                <li><a href="vista/registrar.php">Formulario registro</a></li>
                <li><a href="vista/login.php">Logging</a></li>
                <li><a href="vista/lista_compra.php"><i style="font-size:16px" class="fas">&#xf07a;</i></a></li>
                <li><a href="vista/panel_usuario.php?cerrar"><i class="fa fa-power-off"></i></a></li>
            </ul>';
    }

    /**
     *function
     * nav_log()
     * Navegador del html para resumir. Usuario logueado.
     *
     * elementos.php
     **/
    public  static function nav_log(){
        echo '<ul>
                <li><a class="pactual" href="index.php">Home</a></li>
                <li><a href="vista/productos.php">Productos</a></li>
                <li><a href="vista/panel_usuario.php">Cuenta</a></li>
                <li><a href="vista/lista_compra.php"><i style="font-size:16px" class="fas">&#xf07a;</i></a></li>
                <li><a href="vista/panel_usuario.php?cerrar"><i class="fa fa-power-off"></i></a></li>
            </ul>';
    }

    /**
     *function
     * nav_log2()
     * Navegador del html para resumir. Usuario logueado.
     *
     * elementos.php
     **/
    public  static function nav_log2(){
        echo '<ul>
                <li><a href="../index.php">Home</a></li>
                <li><a class="pactual" href="productos.php">Productos</a></li>
                <li><a href="panel_usuario.php">Cuenta</a></li>
                <li><a href="lista_compra.php"><i style="font-size:16px" class="fas">&#xf07a;</i></a></li>
                <li><a href="panel_usuario.php?cerrar"><i class="fa fa-power-off"></i></a></li>
            </ul>';
    }

    /**
     *function
     * nav_productos()
     * Navegador del html para resumir. Administrador en las opciones de productos.
     *
     * elementos.php
     **/
    public static function nav_productos(){
        echo '<ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="gestionar_usuarios.php">Usuarios</a></li>
                <li><a class="pactual" href="gestionar_productos.php">Productos</a></li>
                <li><a href="gestionar_ventas.php">Ventas</a></li>
                <li><a href="registrar_producto.php">Registrar productos</a></li>               
            </ul>';
    }

    /**
     *function
     * nav_usuarios()
     * Navegador del html para resumir. Administrador en las opciones de usuarios.
     *
     * elementos.php
     **/
    public static function nav_usuarios(){
        echo '<ul>
                <li><a href="../index.php">Home</a></li>
                <li><a class="pactual" href="gestionar_usuarios.php">Usuarios</a></li>
                <li><a href="gestionar_productos.php">Productos</a></li>
                <li><a href="gestionar_ventas.php">Ventas</a></li>
                <li><a href="registrar.php">Registrar usuarios</a></li>               
            </ul>';
    }

    /**
     *function
     * nav_ventas()
     * Navegador del html para resumir. Administrador en las opciones de ventas.
     *
     * elementos.php
     **/
    public static function nav_ventas(){
        echo '<ul>
                <li><a href="../index.php">Home</li>
                <li><a href="gestionar_usuarios.php">Usuarios</a></li>
                <li><a href="gestionar_productos.php">Productos</a></li>
                <li><a class="pactual" href="gestionar_ventas.php">Ventas</a></li>
                <li><a href="registrar_venta.php">Registrar ventas</a></li>               
            </ul>';
    }

    /**
     *Insertar identificador en las paginas del trabajo.
     **/
    public static function nombre(){
        echo "Prácticas presenciales 2ºDAM 23 JMS";
    }
}