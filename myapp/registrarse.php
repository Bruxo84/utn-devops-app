<?php
// Inicio sesion
session_start();
if(!empty ($_POST[b1])) // Si entro por el boton del formulario...
	if ($_POST[boton1] == 1) // Si pidio recordar usuario y password
	{
		// Genero las cookies de usuario y password y les doy duracion de 3 minutos.
		setcookie ("usu",$_POST[usuario], time()+3000);
		setcookie ("pswcookie",$_POST[psw], time()+3000);
	}
	else if ($_POST[boton1] == 2) // Si pidio recordar solo el usuario
	{
		// Genero las cookies de usuario y le doy duracion de 3 minutos.
		setcookie("usu",$_POST[usuario],time()+3000);
		// Vacio la cookie de password.
		setcookie("pswcookie","");
	}
	else if ($_POST[boton1] == 3) // Si pidio no recordar
	{
		// Vacio ambas cookies.
		setcookie("usu","");
		setcookie("pswcookie","");
	}

setcookie ("boton1",$_POST[boton1],time()+3000);
/** if ($_SERVER[REQUEST_METHOD] == "POST")
{
	ECHO "ENTRO POR POST";
}
*/

{

	// Conecto a la base de datos.
	@ $link = mysql_connect("localhost", "root", "root");

	// Selecciono la base de datos
	@ mysql_select_db("phpdb", $link);

	// Ejecuto la sentencia de logueo.
	$rs = mysql_query("select * from usuarios where usuario = '$_POST[usuario]' and psw = '$_POST[psw]'",$link);

	$n = mysql_num_rows($rs);
		if ($n > 0)
			{
				$_SESSION[ususesion] = $_POST[usuario];
				header("location:listado_usuarios.php");
			}
		else
			{
				$msg = "<font color = 'red'>Usuario o Password incorrectos</font>";
			}
}
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
                <h1>Registrarse</h1>
                <a href="recordar.php">No recuerdo mi contrase&ntilde;a</a>

                <form name="f1" method="post" action="" enctype="multipart/form-data" onsubmit="return validar();" class="formulario">
                    <div class="formLine"></div>
                    <div class="formRow">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" value="<?php echo $_COOKIE[usu]; ?>" class="input-text">
                    </div>
                    <div class="formRow">
                        <div class="formItem">
                            <label for="psw">Contrase&ntilde;a</label>
                            <input type="password" name="psw" id="psw" value="<?php echo $_COOKIE[pswcookie]; ?>" class="input-text">
                        </div>
                    </div>
                    <div class="formRow">
                        <div class="formItemBig">
                            <label></label>
                            <input type="radio" name="boton1" value="1" <?php if($_COOKIE[boton1] == 1) { echo "checked"; } ?> class="radio"> Recordar usuario y contrase&ntilde;a
                        </div>
                    </div>
                    <div class="formRow">
                        <div class="formItemBig">
                            <label></label>
                            <input type="radio" name="boton1" value="2" <?php if($_COOKIE[boton1] == 2) { echo "checked"; } ?> class="radio"> Recordar usuario
                        </div>
                    </div>
                    <div class="formRow">
                        <div class="formItemBig">
                            <label></label>
                            <input type="radio" name="boton1" value="3" <?php if($_COOKIE[boton1] == 3) { echo "checked"; } ?> class="radio"> No recordar
                        </div>
                    </div>
                    <div class="formLine"></div>
                    <div class="formRow">
                        <div class="formItem">
                            <label></label>
                            <input type="submit" name="b1" value="Ingresar">
                        </div>
                    </div>
                </form>

            </div>

            <? include ("pie.php");?>

        </div>
    </body>
</html>
