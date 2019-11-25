<?php
$usuario = $_POST[usuario];
$psw = $_POST[psw];
$psw2 = $_POST[psw2];
$nombre = $_POST[nombre];
$apellido = $_POST[apellido];
$edad = $_POST[edad];
$pais = $_POST[pais];
$sexo = $_POST[sexo];	
$tipo = $_POST[tipo];
$numero = $_POST[numero];
$fuma = $_POST[fuma];
$mail = $_POST[mail];
$archivo_nombre = $_FILES[imagen][name];
$archivo_tmp = $_FILES[imagen][tmp_name];

/* validar datos 
empty ($x)--> true/false
strlen (sx) --> ve la cantidad de caracteres que tiene una string, devuelve un int
ltrim (" juan"); --> devuelve sin los blancos a la izquierda "juan"
rtrim ("juan ");--> elimina los blancos a la derecha "juan"
trim (" juan ");--> quita lo blancos de la derecha e izquierda
trim ("juan.",./n/t");remueve el punto la como o lo que nosotros especifiquemos esta funcion toma dos parametros, el primero es lo que queremos tomar y el segundo es lo que queremos sacar 
/t significa tab
is_integer(varible cualquiera)--> true si el valor es intreo
is_float 
is_time
is_bool
is_array
is_string
is_objet
la edad va a ser siempre estring, no puedo preguntar si es integer, para ello usamos la funcion 
$x = "10" (esto seria la variable de edad)
if(is_integer($x))
    echo'ok';
if(is_numeric ($x))
    echo 'ok es numerico';
CONVERSION DE VALORES
$x = intval("10"); // devuelve 10
$server tiene varibles del servidor como por ejemplo el metodo en que fuie requerida la pagina,si fue con POST o GET
*/ 
$msg = "";
if (empty($usuario) == true) {
    $msg = $msg . "El usuario es un dato obligatorio. Completelo. Gracias.<br>";
}
if ($psw != $psw2) {
    $msg = $msg .  "Las contraseñas son distintas. Por favor vuelva intentarlo. Gracias.<br>";
}
if (strlen($psw) < 3 || strlen($psw) > 10) {
    $msg .= "La contraseña debe tener entre 3 y 10 caracteres.<br>";
}
if (empty($nombre)) {
    $msg = $msg .  "Su nombre es un dato obligatorio. Completelo. Gracias.<br>";
}
if (empty ($apellido)) {
    $msg = $msg . "Su apellido es un dato obligatorio. Completelo. Gracias.<br>";
}
if( !empty($edad) && !is_numeric($edad)) {
    $msg .= "La edad no es un valor numerico<br>";
}
if( !empty($edad) && !is_numeric($edad) && $edad < 0 ) {
    $msg .= "La edad no se puede registrar<br>";
}

echo "<FONT color='red'>$msg</FONT>";
/* cuando nos equivocamos para no perder toda la informacion que solo borre lo que este mal */ 
?>