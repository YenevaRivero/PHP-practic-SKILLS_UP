<?php
require "../require/config.php";

$nombre = $email = $telefono = $direccion = $ciudad = $provincia = $zip = $check = $noticia = $otrostemas="";
$nombre_err = $email_err = $telefono_err = false;
$checkboxs;

function limpiar_dato($data){
    $data = trim($data); // Elimina espacio en blanco (u otro tipo de caracteres) del inicio o final de la cadena
    $data = stripslashes($data); // Devuelve cadenas con las barras invertidas o comillas borradas.
    $data = htmlspecialchars($data); //Limpiar caracteres especiales.
    return $data; //Devuelve el valor de las variables (lo que escribimos en los inputs)
}

function validar_nombre($nombre){
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
        return false;

        }  else {
            return true;
        }
    }
    
function validar_telefono($telefono){
    if(!preg_match('/^[0-9]{9}+$/', $telefono)){
        return false;
    } else {
        return true;
    }

}

function validar_email($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
        } else {
            return true;
        }
}
        
  //BORRAR LOS ECHOS AL COMPROBAR QUE SIRVE  
if($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r ($_POST);
    if(!empty($_POST["nombre"]) || !empty($_POST["email"]) || !empty($_POST["telefono"])){
        echo "<br><strong>Metodo post enviado</strong><br>";
        $nombre = limpiar_dato($_POST["nombre"]);
        echo "<strong>Nombre: </strong>" . $nombre . "<br>";
        $email = limpiar_dato($_POST["email"]);
        echo "<strong>Email: </strong>" . $email . "<br>";
        $telefono = limpiar_dato($_POST["telefono"]);
        echo "<strong>Telefono: </strong>" . $telefono . "<br>";



        if(validar_nombre($nombre)){
            echo"validada";
        } else {
            $nombre_err = true;
        }

        if(validar_email($email)){
            echo"validada";
        } else {
            $email_err = true;
        }
        
        if(validar_telefono($telefono)){
            echo"validada";
        } else {
            $telefono_err = true;
        }

        if( validar_nombre($nombre) && validar_email($email) && validar_telefono($telefono) ){

            
            //Ver si las variables tienen valor, contenido.
            //if (isset($_POST["direccion])) ? $direccion = limpiar_dato($_POST["direccion]);
            if(isset($_POST["direccion"])){
                $direccion = limpiar_dato($_POST["direccion"]);
            } else {
                $direccion = NULL;
            }
            
            if(isset($_POST["ciudad"])){
                $ciudad = limpiar_dato($_POST["ciudad"]);
            } else {
                $ciudad = NULL;
            }
            
            if(isset($_POST["provincia"])){
                $provincia = limpiar_dato($_POST["provincia"]);
            } else {
            $provincia = NULL;
            }

            if(isset($_POST["zip"])){
                $zip = limpiar_dato($_POST["zip"]);
            } else { 
                $zip = NULL;
            }

        /* if(isset($_POST["check"])){
                $check =limpiar_dato($_POST["check"]);
            } else{
                $check = NULL;
            } */

            $check = filter_input(
                INPUT_POST,
                "check",
                FILTER_SANITIZE_SPECIAL_CHARS,
                FILTER_REQUIRE_ARRAY
            );

            var_dump($check);
            
            ///echo "<br>Longitud de check: ".count($check) .".";

           /// echo "<br>";
            
            $lengArray = count($check);

            switch ($lengArray){
                case 1:
                    if($check=[0] == "HTML News"){
                            $checkboxs = bindec('100');
                    } elseif ($check[0] == "CSS News") {
                            $checkboxs = bindec('010');
                    } else {
                            $checkboxs = bindec('001');
                    }
                    break;

                case 2:
                    if($check[0] != "HTML News"){
                            $checkboxs = bindec('011');
                        } elseif ($check[0] != "CSS News" && $check[1] == "Javascript News") {
                            $checkboxs = bindec('101');
                        } else {
                            $checkboxs = bindec('110');
                        }
                        break;

                case 3:
                    $checkboxs = bindec('111') ;
                    break;
                default: 
                    $checkboxs = bindec('100');
            }

            echo "<br> valor a devolver <strong>" . $checkboxs . "</strong>";


            // === Usa un array y muestra sus valores separados por coma (o lo que se ponga entre comillas).

            $string = implode(", ", $check);
            echo $string;
            echo "<br>";

            // === FIN MOSTRAR valores array.
            
            if(isset($_POST["noticia"])){
                $noticia =limpiar_dato($_POST["noticia"]);
                if($noticia=="HMTL"){
                    $noticia=1; // Value de HTML en los radios.
                } else {
                    $noticia=0; //Value de Texto plano en los radios.
                }

            } else {
                $noticia = 1;
            }
            
            if(isset($_POST["otrostemas"])){
                $otrostemas =limpiar_dato($_POST["otrostemas"]);
            } else {
                $otrostemas = NULL;
            }

            // echo "<strong>Noticias que quiere recibir: $noticia";

            // ====================== BORRAME
            echo "<br><strong>Nombre:</strong> $nombre <br>";
            echo "<br><strong>Tel??fono:</strong> $telefono <br>";
            echo "<br><strong>Email:</strong> $email <br>";
            echo "<br><strong>Direcci??n:</strong> $direccion <br>";
            echo "<br><strong>Ciudad:</strong> $ciudad <br>";
            echo "<br><strong>Provincia:</strong> $provincia <br>";
            echo "<br><strong>Zip:</strong> $zip <br>";
            echo "<br><strong>Checkbox:</strong> $check <br>";
            echo "<br><strong>Noticia:</strong> $noticia <br>";
            echo "<br><strong>Otros temas:</strong> $otrostemas <br>";

            //Comprobar que no existen datos que se van a enviar: nombre, email y telefono.

            try{
                $sql = "SELECT * from news_reg WHERE fullname = :fullname OR email = :email OR phone = :phone";
            
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(":fullname", $nombre, PDO::PARAM_STR);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                $stmt->bindParam(":phone", $telefono, PDO::PARAM_STR);

                $stmt->execute();
                $resultado = $stmt->fetchAll();
                echo "Resultado es: " . var_dump($resultado) . "<br>";
                if($resultado){
                    echo "La informaci??n existe. <br>";
                    } else {

                        //realizamos la inserci??n
                        //INSERT datos a la base de datos;

                        try{
                            $sql ="INSERT INTO news_reg (fullname, email, phone, address, city, state, zipcode, newsletters, format_news, suggestion) VALUES (:fullname, :email, :phone, :address, :city, :state, :zipcode, :newsletters, :format_news, :suggestion)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':fullname', $nombre, PDO::PARAM_STR);
                            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                            $stmt->bindParam(':phone', $telefono, PDO::PARAM_STR);
                            $stmt->bindParam(':address', $direccion, PDO::PARAM_STR);
                            $stmt->bindParam(':city', $ciudad, PDO::PARAM_STR);
                            $stmt->bindParam(':state', $provincia, PDO::PARAM_STR);
                            $stmt->bindParam(':zipcode', $zip, PDO::PARAM_STR);
                            $stmt->bindParam(':newsletters', $checkboxs, PDO::PARAM_INT);
                            $stmt->bindParam(':format_news', $noticia, PDO::PARAM_INT);
                            $stmt->bindParam(':suggestion', $otrostemas, PDO::PARAM_STR);

                            $stmt->execute();
                            echo "New record created succesfully.<br>";
                            echo "Valor a ingresado decimal de 3bit: " . $checkboxs . "<br>";

                        } catch(PDOException $e){
                            echo $sql . "<br>" . $e->getMessage();
                        }
                        $conn = null;
                    }
                } catch(PDOException $e){
                    echo $sql . "<br>" . $e->getMessage();  
                }
            
        } else {
            echo "Una de las validaciones ha fallado. </br>";
            if($nombre_err == true){
                echo "La validaci??n del nombre ha fallado";
            } elseif($email_err == true){
                echo "La validaci??n del email ha fallado";
            } elseif($telefono_err == true);
                echo "La validaci??n del tel??fono ha fallado";
        }
        
    } else {
        echo "Uno de los datos requeridos no ha sido rellenado";
    }
    
} else {
    echo "No hemos recibido m??todo post";
}

?>

