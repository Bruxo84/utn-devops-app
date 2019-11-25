<?php
// Inicio la sesion
session_start();

// Si no esta logueado, lo redirecciono al logueo.
if (!isset($_SESSION[ususesion]))
	header("Location:registrarse.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Comentarios :: Proyecto Integrador</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div id="contenido">

            <?php include("encabezado.php"); ?>

            <div id="centro">

		<h1>Comentarios</h1>

                <form name="f1" method="post" action="foro.php" enctype="multipart/form-data" onsubmit="return validar();" class="formulario">
                <div class="formLine"></div>
                <div class="formRow">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" size="50" maxlength="20" class="input-text">
                </div>
                <div class="formRow">
                    <label>Comentario</label>
                    <textarea name="comentario" cols="40" rows="10"></textarea>
                </div>
                <div class="formLine"></div>
                <div class="formItem">
                    <label></label>
                    <input type="submit" value="Enviar">
                </div>
		</form>
                <div class="clear"></div>

            </div>
            <?php include("pie.php"); ?>

        </div>

    </body>
</html>
