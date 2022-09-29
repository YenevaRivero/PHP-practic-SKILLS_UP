<?php
require "../require/config.php";

$nombre = $email = $telefono = $direccion = $ciudad = $provincia = $zip = $check = $noticia =$otrostemas="";

        function limpiar_dato($data){
            $data = trim($data); // Elimina espacio en blanco (u otro tipo de caracteres) del inicio o final de la cadena
            $data = stripslashes($data); // Devuelve cadenas con las barras invertidas o comillas borradas.
            $data = htmlspecialchars($data); //Limpiar caracteres especiales.
            return $data; //Devuelve el valor de las variables (lo que escribimos en los inputs)
        }



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
        
    
if($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r ($_POST);
    if(!empty($_POST["nombre"]) || !empty($_POST["email"]) || !empty($_POST["telefono"])){
        echo "<br><strong>Metodo post enviado</strong><br>";
        $nombre= limpiar_dato($_POST["nombre"]);
        echo "<strong>Nombre: </strong>" . $nombre . "<br>";
        $email= limpiar_dato($_POST["email"]);
        echo "<strong>Email: </strong>" . $email . "<br>";
        $telefono= limpiar_dato($_POST["telefono"]);
        echo "<strong>Telefono: </strong>" . $telefono . "<br>";
        $direccion= limpiar_dato($_POST["direccion"]);
        $ciudad= limpiar_dato($_POST["ciudad"]);
        $provincia= limpiar_dato($_POST["provincia"]);
        $zip= limpiar_dato($_POST["zip"]);
        $check= limpiar_dato($_POST["check"]);
        $noticia= limpiar_dato($_POST["noticia"]);
        $otrostemas= limpiar_dato($_POST["otrostemas"]);


        if(validar_nombre($nombre)){
            echo"validada";
        } else{
            echo"no valida";
        }
/* revisar validaciones
        if(validar_email($email)){
            echo"validada";
        } else{
            echo"no valida";
        }
        
        if(validar_telefono($telefono)){
            echo"validada";
        } else{
            echo"no valida";
        }
*/
    }

}
?>