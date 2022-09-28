<?php
require "../require/config.php";

$nombre = $email = $telefono = $direccion = $ciudad = $provincia = $zip = $check = $noticia =$otrostemas="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["name"])){
        echo "<br><strong>Metodo post enviado</strong><br>";

    }

}

?>