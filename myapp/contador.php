<?php

// Defino en una constante el nombre del archivo.
define(ARCH, "visitas.txt");

// Si el archivo existe...
if (file_exists(ARCH)) {
    // Abro en modo lectura.
    $fp = fopen(ARCH, "r");

    // Leo todo el archivo de texto.
    $cant = fread($fp, filesize(ARCH));

    // Cierro el archivo de texto.
    fclose($fp);
} else {
    // Si el archivo no existe...
    // Seteo la cantidad de visitas en 0
    $cant = 0;
}
// Aumento en 1 la cantidad de visitas.
$cant++;

// Abro el archivo en modo lectura.
$fp = fopen (ARCH, "w" );

// Escribo la cantidad de visitas en el archivo.
fwrite($fp , $cant);

// Cierro el archivo.
fclose($fp);

// Imprimo la cantidad de visitas.
echo $cant;
?>