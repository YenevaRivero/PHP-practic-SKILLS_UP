<?php
require "../require/config.php";

$nombre = $email = $telefono = $direccion = $ciudad = $provincia = $zip = $check = $noticia =$otrostemas="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST["nombre"]) || !empty($_POST["email"]) || !empty($_POST["telefono"])){
        echo "<br><strong>Metodo post enviado</strong><br>";
        $nombre= $_POST["nombre"];
        $email= $_POST["email"];
        $telefono= $_POST["telefono"];
        $direccion= $_POST["direccion"];
        $ciudad= $_POST["ciudad"];
        $provincia= $_POST["provincia"];
        $zip= $_POST["zip"];
        $check= $_POST["check"];
        $noticia= $_POST["noticia"];
        $otrostemas= $_POST["otrostemas"];

        function limpiar_dato($data){
            $data = trim($data); // Elimina espacio en blanco (u otro tipo de caracteres) del inicio o final de la cadena
            $data = stripslashes($data); // Devuelve cadenas con las barras invertidas o comillas borradas.
            $data = htmlspecialchars($data); //Limpiar caracteres especiales.
        }

        //nombre, email y número de teléfono

    function validar_nombre($nombre){
        
        if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
            return false;

            }  else{
                return true;
            }
        }

        function validar_telefono($telefono){
            if(!preg_match('/^[0-9]{10}+$/', $telefono)){
                return false;
            } else{
                return true;
            }

        }

        function validar_email($email){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
                } else{
                    return true;
                }
        }
    }


}

?>