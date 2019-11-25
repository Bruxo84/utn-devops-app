<?php
if ($_POST[boton1] == 'on') {
    setcookie ("usuario", "");
} else {
    setcookie("usuario", $_POST[usuario], time() + 60 * 60 * 24);
}
?>