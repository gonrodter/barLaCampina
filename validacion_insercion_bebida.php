<?php
    session_start();


    if (isset($_SESSION['inventario'])) {
        $nuevaBebida["PRECIOBEBIDAS"] = $_REQUEST["PRECIOBEBIDAS"];
        $nuevaBebida["NOMBREBEBIDAS"] = $_REQUEST["NOMBREBEBIDAS"];

    }
    else 
        Header("Location: form_insercion_bebida.php");

    $_SESSION["inventario"] = $nuevaBebida;

    $errores = validarDatosBebida($nuevaBebida);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_insercion_bebida.php');
    } else
        Header('Location: accion_insertar_bebida.php');

    function validarDatosBebida($nuevaBebida){
        
        if($nuevaBebida["PRECIOBEBIDAS"]==""){ 
            $errores[] = "<p>El precio de la tapa no puede estar vacío</p>";
        }
        
        if($nuevaBebida["NOMBREBEBIDAS"]==""){ 
            $errores[] = "<p>El nombre de la tapa no puede estar vacío</p>";
        }

        return $errores;
    }
?>