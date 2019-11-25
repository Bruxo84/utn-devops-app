<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inscripcion :: Proyecto Integrador</title>
        <link rel="stylesheet" type="text/css" href="estilos.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div id="contenido">

            <?php include("encabezado.php"); ?>

            <div id="centro">
                <script>
                    function validar() {
                        document.f1.usuario.disabled = false;

                        // Si el valor del campo usuario es nulo
                        if (document.f1.usuario.value == '') {
                            // Alerto que es un campoi obligatorio
                            alert ('El usuario es un dato obligatorio');
                        
                            // Cancelo el envio del formulario
                            return false;
                        }
                        return true; // Envio el formulario
                    }
                </script>

                <?php
                if ($_SERVER[REQUEST_METHOD] == 'POST') {
                    // Incluyo el archivo de validaciones
                    include("validar.php");
                } else {
                    // Si vino sin parametro, vino a hacer una carga, por lo que agrego los valores por defecto
                    if (empty($_GET[usumodifica])) {
                        $fuma = 'si';
                        $tipo = 'dni';
                        $archivo_nombre = 'avatar.gif';
                    } else { // Si vino con paramtros, es para editar, por lo que cargo los valores de la base de datos
                        // Conecto a la base
                        @ $link = mysql_connect("localhost", "root", "root");

                        // Selecciono la base de datos
                        mysql_select_db("phpdb", $link);

                        // Ejecuto la consulta buscando el usuario
                        $rs = mysql_query("select * from usuarios where usuario='$_GET[usumodifica]'", $link);

                        // Guardo en un array asociativo la informacion
                        $v = mysql_fetch_array($rs);

                        // Lleno las variables con los datos
                        $usuario = $v[usuario];
                        $psw = $v[psw];
                        $psw2 = $psw;
                        $nombre = $v[nombre];
                        $apellido = $v[apellido];
                        $fuma = $v[fuma];
                        $tipo = $v[tipo];
                        $numero = $v[numero];
                        $mail = $v[mail];
                        $edad = $v[edad];
                        $sexo = $v[sexo];
                        $pais = $v[pais];
                        $archivo_nombre = $v[imagen];

                        // Cierro la conexion a la base de datos
                        mysql_close($link);
                    }
                }
                ?>

                <?php
                // Si no entro por POST o hay un mensaje de error, muestro el formulario normalmente
                if (($_SERVER['REQUEST_METHOD'] != "POST") or (!empty($msg))) {
                ?>

				<form name="f1" method="POST" action="" enctype="multipart/form-data" onsubmit="return validar();">
				<table>
				
					<tr>
					  <td colspan="4"><h1>Formulario de Inscripci&oacute;n</h1></td>
					</tr>
				
					<tr>
					  <td colspan="4"><hr></td>
					</tr>
				
					<tr width="100%" >
					  <td>Usuario</td>
					  <td><input type="text" name="usuario" value="<?= $usuario;?>" <? if (!empty($_GET[usumodifica])) echo "disabled";?>></td>
					  <td></td>
					  <td></td>
					</tr>
				
					<tr>
					  <td>Contraseña</td>
					  <td><input type="password" name="psw" value="<?echo $psw;?>"></td>
					  <td>Repetir Contraseña</td>
				 	  <td><input type="password" name="psw2" value="<?echo $psw2;?>"></td>
					</tr>
				
					<tr>
					  <td colspan="4"><hr></td>
					</tr>
				
					<tr>
					  <td>Nombre</td>
					  <td><input type="text" name="nombre" size="20" maxlength="25" value="<?= $nombre;?>"></td>
					  <td>Apellido</td>
				 	  <td><input type="text" name="apellido" size="40"maxlength="45" value="<?= $apellido;?>"></td>
					</tr>
				
					<tr>
					  <td>Edad</td>
					  <td><input type="text" name="edad" size="3" maxlength="3" value="<?= $edad;?>"></td>
					  <td>Pais</td>
				 	  <td><select name="pais" >
						 			<option value="arg" <?if ($pais=="arg") echo "selected";?>>Argentina</option>
						 			<option value="bra" <?if ($pais=="bra") echo "selected";?>>Brasil</option>
						 			<option value="uru" <?if ($pais=="uru") echo "selected";?>>Uruguay</option>
						 			<option value="chi" <?if ($pais=="chi") echo "selected";?>>Chile</option>
						 			<option value="par" <?if ($pais=="par") echo "selected";?>>Paraguay</option>
						 			<option value="bol" <?if ($pais=="bol") echo "selected";?>>Bolivia</option>
						 			<option value="per" <?if ($pais=="per") echo "selected";?>>Peru</option>
					  </select>
					  </td>
					</tr>
				
					<tr>
					  <td>Mail</td>
					  <td colspan="3"><input type="text" name="mail" size="88"maxlength="90" value="<?= $mail;?>"> </td>
					</tr>
				
					<tr>
					  <td rowspan="2">
								<fieldset>
									<legend>Sexo</legend>
										<input type="radio" name="sexo" value="m" <? if ($sexo == "m") echo "checked"; ?>  >Masculino<br>
										<input type="radio" name="sexo" value="f"<? if ($sexo == "f") echo "checked"; ?>>Femenino<br>
						  </fieldset>
					  </td>
					  <td rowspan="2">
				        <fieldset>
				        <legend>Tipo de Documento</legend>
				           <input type="radio" name="tipo" value="dni" <? if ($tipo == "dni") echo "checked"; ?>>DNI<br>
				           <input type="radio" name="tipo" value="ci" <? if ($tipo == "ci") echo "checked"; ?>>CI<br>
				           <input type="radio" name="tipo" value="le" <? if ($tipo == "le") echo "checked"; ?>>LE<br>
						</fieldset>
					  </td>
					  <td>Numero de Documento</td>
				 	  <td><input type="text" name="numero" size="10" maxlength="10" value="<?= $numero;?>"></td>
					</tr>
					<tr>
					  <td>Fuma</td>
					  <td><input type="checkbox" name="fuma" value="si" <? if ($fuma == "si") echo "checked"; ?>></td>
				
					</tr>
				
					<tr>
					  <td>Imagen</td>
					  <td colspan="2"><input type="file" name="imagen" size="75"> </td>
					  <td><img src="images/<?=$archivo_nombre;?>" alt="Foto" border="1"></td>
					</tr>
				
					<tr>
					  <td colspan="4"><hr></td>
					</tr>
					<tr>
					  <td></td>
					  <td> <input type="submit" value="Enviar Datos"></td>
					  <td> <input type="reset" value="Borrar Informacion"></td>
				 	  <td></td>
					</tr>
				
				</table>
				</form>

 
				<div class="clear"></div>
            </div>
            <?php
            } else { // Si entro por POST y no hubo mensaje de error, procedo a guardar los datos
                // Conecto a la base de datos
                @ $link = mysql_connect("localhost", "root", "root");
                // Selecciono la base de datos
                mysql_select_db("phpdb", $link);
                // Si fuma esta vacio, le agrego un valor
                if ($fuma == "")
                    $fuma = "No";
                // Si la variable de modificacion esta vacia, procedo con al alta
                if (empty($_GET[usumodifica])) {
                    $x = "insert into usuarios(usuario,psw,nombre,apellido,edad,mail,sexo,fuma,pais,tipo,numero,imagen)
                            values('$usuario','$psw','$nombre','$apellido',$edad,'$mail','$sexo','$fuma','$pais','$tipo','$numero','$archivo_nombre')";

                // Sino, procedo con la modificacion
                } else {
                    $x = "UPDATE usuarios
                             set psw = '$psw',
                                 nombre = '$nombre',
                                 apellido = '$apellido',
                                 edad = $edad,
                                 mail = '$mail',
                                 sexo = '$sexo',
                                 fuma = '$fuma',
                                 pais = '$pais',
                                 tipo = '$tipo',
                                 numero = '$numero'";

                            if (!empty($archivo_nombre)) {
                                $x .= ", imagen = '$archivo_nombre'";
                            }

                                $x .= " where usuario = '$usuario' ";
                }



                // Ejecuto la sentencia
                mysql_query($x, $link);

                if (!empty($archivo_nombre)) {
                    if ((($_FILES["imagen"]["type"] == "image/gif")
                            || ($_FILES["imagen"]["type"] == "image/jpeg")
                            || ($_FILES["imagen"]["type"] == "image/jpg"))
                            && ($_FILES["imagen"]["size"] < 1120000)) {
                    if ($_FILES["imagen"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["imagen"]["error"] . "<br>";
                    } else {
                        echo "Upload: " . $_FILES["imagen"]["name"] . "<br>";
                        echo "Type: " . $_FILES["imagen"]["type"] . "<br>";
                        echo "Size: " . ($_FILES["imagen"]["size"] / 1024) . " Kb<br>";
                        echo "Temp file: " . $_FILES["imagen"]["tmp_name"] . "<br>";

                                if (file_exists("images/" . $_FILES["imagen"]["name"])) {
                                    echo $_FILES["imagen"]["name"] . " already exists. ";
                                } else {
                                    // Muevo la imagen desde su ubicacion temporal a la carpeta de imagenes
                                    move_uploaded_file($_FILES["imagen"]["tmp_name"], "images/" . $archivo_nombre);
                                }
                            }
                        } else {
                            echo "Archivo Invalido";
                        }
                    }


                    // Cierro la conexion de la base de datos.
                    mysql_close($link);

                    // Imprimo un mensaje de que el registro se ingreso con exto.
                    echo "<br>Registro insertado <br>";
                }
            ?>

<?php include("pie.php"); ?>

        </div>

    </body>
</html>
