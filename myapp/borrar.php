<?php

// Conexion a la base de datos.
@$link = mysql_connect("localhost", "root", "root");

// Selecciono la base de datos.
@$resu = mysql_select_db("phpdb", $link);

// Ejecuto la sentencia.
mysql_query("DELETE FROM usuarios WHERE usuario = '$_GET[usu]'", $link);

// Cierro la conexion a la base de datos.
mysql_close($link);

// Redirecciono la pagina.
header("Location: listado_usuarios.php");
?>