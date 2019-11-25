<?php
session_start(); // Inicio la sesion
session_destroy(); // Destruyo la sesion
header("Location:registrarse.php"); // Redirecciono la pagina
?>