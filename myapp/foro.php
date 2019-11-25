<?php
session_start();
if (!isset($_SESSION[ususesion]))
    header("Location:registrarse.php");
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

            <h1>Foro</h1>
            <?php
            // Defino el nombre del archivo en una constante.
            define(ARCH, "comentarios.txt");

            // Si vinieron por POST el nombre y el comentario y no estan vacios
            if (!empty($_POST[nombre]) && !empty($_POST[comentario])) {
                // Abro el archivo de texto para agregar.
                $fp = fopen(ARCH, "a");

                // Escribo los datos.
                fwrite ($fp, "Nombre: <b>$_POST[nombre]</b><br>\r\n");
                fwrite ($fp, "Fecha de posteo: " . date("d-F-Y H:i", time()));
                fwrite ($fp, "<br> $_POST[comentario]<hr>\r\n");

                // Cierro el archivo de texto.
                fclose ($fp);
            }
            // Si el archivo existe...
            if (file_exists(ARCH)) {
                // Abro el archivo de texto.
                $fp = fopen(ARCH, "r");

                // Lo recorro e imprimo en pantalla.
                fpassthru($fp);

                // Cierro el archivo de texto.
                fclose($fp);
            }
            ?>

            </div>

            <?php include("pie.php"); ?>

        </div>

    </body>
</html>
