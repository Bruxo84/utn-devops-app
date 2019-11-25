<?php
if (isset($_POST[email])) {
    // Conecto a la base de datos.
    @$link = mysql_connect("localhost", "root", "root");

    // Selecciono la base de datos
    @mysql_select_db("phpdb", $link);

    // Ejecuto la sentencia de logueo.
    $rs = mysql_query("SELECT * FROM usuarios WHERE email = '$_POST[mail]'",$link);

    $n = mysql_num_rows($rs);
    if ($n > 0) {
        $v = mysql_fetch_array($rs);
        $to = $v[mail];
        $subject = 'Recordatorio de contraseña.';
        $message = 'Tu contraseña es ' . $v[psw];

        $headers = 'To: <'.$v[mail].'>' . "\r\n";
        $headers .= 'From: <admin@misitio.com>' . "\r\n";
        //$headers .= 'Cc: <admin@misitio.com>' . "\r\n";
        //$headers .= 'Bcc: <admin@misitio.com>' . "\r\n";

        mail($to, $subject, $message, $headers);
        $msg = "<font color='green'>Email enviado.</font>";
    } else {
        $msg = "<font color='red'>La cuenta de email no existe en el sistema.</font>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recordar Contrase&ntilde;a :: Proyecto Integrador</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <div id="contenido">

        <?php include("encabezado.php"); ?>

            <div id="centro">
                <h1>Recordar contrase&ntilde;a</h1>
                <?php echo $msg; ?>

                <form name="f1" method="post" action="" class="formulario">
                    <div class="formLine"></div>
                    <div class="formRow">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="input-text">
                    </div>
                    <div class="formLine"></div>
                    <div class="formRow">
                        <div class="formItem">
                            <label></label>
                            <input type="submit" value="Enviar Contrase&ntilde;a">
                        </div>
                    </div>
                </form>
                <div class="clear"></div>
            </div>

        <?php include("pie.php"); ?>

        </div>
    </body>
</html>
