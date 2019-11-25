<?php
session_start();
if (!isset($_SESSION[ususesion]))
	header("location:registrarse.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Listado de Usuarios :: Proyecto Integrador</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div id="contenido">

            <?php include("encabezado.php"); ?>

            <div id="centro">

		<h1>Listado de usuarios</h1>

		<form name="f1" method="GET" action="">
                    <table width="860px" height="27" border="0" bgcolor="#e6a442" align="center">
                        <tr>
                            <td>Usuario:</td>
                            <td><input name="usuario" type="text" id="usuario" maxlength="50" size="30" /></td>
                            <td>Mail:</td>
                            <td><input name="mail" type="text" id="mail" maxlength="50" size="30" /></td>
                            <td>Pais:</td>
                            <td>
                                <select name="pais" id="pais">
                                    <option value="">---------------------</option>
                                    <option value="arg">Argentina</option>
                                    <option value="bra">Brasil</option>
                                    <option value="uru">Uruguay</option>
                                    <option value="chi">Chile</option>
                                    <option value="par">Paraguay</option>
                                    <option value="bol">Bolivia</option>
                                    <option value="per">Peru</option>
                                </select>
                            </td>
                            <td>Sexo: </td>
                            <td>
                                <select name="sexo" id="sexo">
                                    <option value=""></option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                            </td>
                            <td width="16"><a href ="javascript:document.f1.submit()"><img src="images/enviar.jpg" width="69" height="20" alt="submit" border="0"></a></td>
                        </tr>
                    </table>
                </form>

                <?php
                @$link = mysql_connect("localhost","root","root");

                /* pregunto si la conexion se puede establecer  en lugar de localhost en la linea 3 pusimos otro nombre*/
                if (!$link)
                    die ("Error devuelto:". mysql_error());

                $resu = mysql_select_db("phpdb",$link); /** pongo una variable por ejemplo $resu y si el nombre de la base esta mal me tira el error */

                if ($resu == false)
                    die (mysql_error());

                $sql = "SELECT * FROM usuarios WHERE usuario LIKE '%$_GET[usuario]%' AND mail LIKE '%$_GET[mail]%' AND pais LIKE '%$_GET[pais]%' AND sexo LIKE '%$_GET[sexo]%'";
                mysql_query($sql,$link );
                $rs = mysql_query ($sql , $link);

                if (!$rs)
                    die (mysql_error());
                ?>

                <table width="860px" cellpadding="5" cellspacing="0" border="1" align="center">
                    <tr bgcolor="#efc789">
                        <td>Usuario</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Mail</td>
                        <td>Pais</td>
                        <td>Edad</td>
                        <td>Sexo</td>
                        <td>Tipo</td>
                        <td>Numero</td>
                        <td>Fuma</td>
                        <td>Imagen</td>
                        <td>Editar</td>
                        <td>Borrar</td>
                    </tr>
                    <?php
                    while ($v = mysql_fetch_array($rs)) {
                        if ($i%2==0)
                            $col = '#b7b6ba';
                        else
                            $col = '#939197';
                    ?>
                    <tr bgcolor='<?php echo $col?>'>
                        <td><?php echo $v[usuario]?></td>
                        <td><?php echo $v[nombre]?></td>
                        <td><?php echo $v[apellido]?></td>
                        <td><?php echo $v[mail]?></td>
                        <td><?php echo $v[pais]?></td>
                        <td><?php echo $v[edad]?></td>
                        <td><?php echo $v[sexo]?></td>
                        <td><?php echo $v[tipo]?></td>
                        <td><?php echo $v[numero]?></td>
                        <td><?php echo $v[fuma]?></td>
                        <td><img src="images/<?php echo $v[imagen];?>" alt="imagen"></td>
                        <td><a href="inscripcion.php?usumodifica=<?php echo $v[usuario];?>"><img src="images/edit.jpg" border="0"></a></td>
                        <td><a href='borrar.php?usu=<?php echo $v[usuario];?>' onclick="return confirm ('Esta seguro que desea eliminar <?php echo $v[usuario] ?>')"><img src="images/borrar.jpg" border="0"></a></td>
                    </tr>
                    <?php
                        $i++;
                    }
                    ?>
                    <tr bgcolor='<?php echo $col?>'>
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
