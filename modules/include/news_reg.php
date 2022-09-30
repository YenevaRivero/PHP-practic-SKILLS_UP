<?php
require "../require/config.php";

$nombre = $email = $telefono = $direccion = $ciudad = $provincia = $zip = $check = $noticia = $otrostemas="";

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
                if(!preg_match('/^[0-9]{9}+$/', $telefono)){
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
        
  //BORRAR LOS ECHOS AL COMPROBAR QUE SIRVE  
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

        //Ver si las variables tienen valor, contenido.
        //if (isset($_POST["direccion])) ? $direccion = limpiar_dato($_POST["direccion]);
        if(isset($_POST["direccion"])){
            $direccion =limpiar_dato($_POST["direccion"]);
        } else{
            $direccion = NULL;
        }

        if(isset($_POST["ciudad"])){
            $ciudad =limpiar_dato($_POST["ciudad"]);
        } else{
            $ciudad = NULL;
        }

        if(isset($_POST["provincia"])){
            $provincia =limpiar_dato($_POST["provincia"]);
        } else{
            $provincia = NULL;
        }

        if(isset($_POST["zip"])){
            $zip =limpiar_dato($_POST["zip"]);
        } else{
            $zip = NULL;
        }

        if(isset($_POST["check"])){
            $check =limpiar_dato($_POST["check"]);
        } else{
            $check = NULL;
        }

        if(isset($_POST["noticia"])){
            $noticia =limpiar_dato($_POST["noticia"]);
        } else{
            $noticia = NULL;
        }

        if(isset($_POST["otrostemas"])){
            $otrostemas =limpiar_dato($_POST["otrostemas"]);
        } else{
            $otrostemas = NULL;
        }

        $direccion= limpiar_dato($_POST["direccion"]);
        $ciudad= limpiar_dato($_POST["ciudad"]);
        $provincia= limpiar_dato($_POST["provincia"]);
        $zip= limpiar_dato($_POST["zip"]);
        $check= limpiar_dato($_POST["check"]);
        $noticia= limpiar_dato($_POST["noticia"]);
        $otrostemas= limpiar_dato($_POST["otrostemas"]);

//BORRAR FUNCIONES CUANDO COMPROBEMOS QUE SIRVEN.
        if(validar_nombre($nombre)){
            echo"validada";
        } else{
            echo"no valida";
        }

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

    }

}
?>