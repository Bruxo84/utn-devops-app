<?php
session_start();
if (!isset($_SESSION[ususesion]))
    header("Location:registrarse.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Listado de Productos :: Proyecto Integrador</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div id="contenido">

            <?php include("encabezado.php"); ?>

            <div id="centro">

            <h1>Listado de Productos</h1>

            <?php
            @$link = mysql_connect("localhost","root","root");

            /* pregunto si la conexion se puede establecer  en lugar de localhost en la linea 3 pusimos otro nombre*/
            if(!$link)
                die("Error devuelto:" . mysql_error());

            /* pongo una variable por ejemplo $resu y si el nombre de la base esta mal me tira el error */
            $resu = mysql_select_db("phpdb", $link);

            if ($resu == false)
                die(mysql_error());

            if (empty($_GET[orden]))
                $_GET[orden] = 'p.cod_producto';

                $sql = "SELECT p.cod_producto,
                               p.nombre,
                               p.precio,
                               p.stock,
                               p.cod_categoria,
                               c.descripcion,
                               p.cod_marca,
                               m.nombre_marca
                        FROM productos p, categorias c, marcas m
                        WHERE p.cod_categoria = c.cod_categoria
                              AND p.cod_marca = m.cod_marca
                        ORDER BY $_GET[orden]";

            mysql_query($sql, $link);
            $rs = mysql_query($sql, $link);

            if(!$rs)
                die(mysql_error());
            ?>

            <table width="860px" cellpadding="5" cellspacing="0" border="1" align="center">
                <tr bgcolor="#efc789">
                    <td><a href="?orden=cod_producto">cod_producto</a></td>
                    <td><a href="?orden=nombre">nombre</a></td>
                    <td><a href="?orden=precio">precio</a></td>
                    <td><a href="?orden=stock">stock</a></td>
                    <td><a href="?orden=cod_categoria">cod_categoria</a></td>
                    <td><a href="?orden=descripcion">descripcion</a></td>
                    <td><a href="?orden=cod_marca">cod_marca</a></td>
                    <td><a href="?orden=nombre_marca">nombre_marca</a></td>
                </tr>
                <?php
                while($v=mysql_fetch_array($rs)) {
                    if($i%2==0)
                        $col = '#b7b6ba';
                    else
                        $col = '#939197';
                ?>
                <tr bgcolor='<?php echo $col ?>'>
                    <td><?php echo $v[cod_producto] ?></td>
                    <td><?php echo $v[nombre] ?></td>
                    <td><?php echo $v[precio] ?></td>
                    <td><?php echo $v[stock] ?></td>
                    <td><?php echo $v[cod_categoria] ?></td>
                    <td><?php echo $v[descripcion] ?></td>
                    <td><?php echo $v[cod_marca] ?></td>
                    <td><?php echo $v[nombre_marca] ?></td>
                </tr>
                <?php
                    $i++;
                }
                ?>
                <tr bgcolor='<?php echo $col ?>'>
                    <td colspan="13"><font face="arial" size="2">Total registros: <?php echo mysql_num_rows($rs) ?></font></td>
                </tr>
            </table>

            <?php
            mysql_close($link);
            ?>

            </div>

            <?php include("pie.php"); ?>

        </div>

    </body>
</html>
