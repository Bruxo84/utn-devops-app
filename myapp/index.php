<!DOCTYPE html>
<html>
    <head>
        <title>Proyecto Integrador</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div id="contenido">
            
            <?php include("encabezado.php"); ?>
            
            <div id="centro">
                <h1>Proyecto Integrador / Curso de PHP</h1>
                <h2>Usuario: xxxxxxxx<br />Fecha: <?php echo date("d/m/Y"); ?></h2>
                <h3>Usted es el visitante n&uacute;mero: <?php include("contador.php"); ?></h3>
            </div>

            <?php include("pie.php"); ?>
            
        </div>

    </body>
</html>
