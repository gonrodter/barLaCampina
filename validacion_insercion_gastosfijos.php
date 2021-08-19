<?php
    session_start();


    if (isset($_SESSION['gestion'])) {
        $nuevoGastosfijos["MESAGUALUZ"] = $_REQUEST["MESAGUALUZ"];
        $nuevoGastosfijos["CANTIDADAGUALUZ"] = $_REQUEST["CANTIDADAGUALUZ"];
    }
    else 
        Header("Location: form_insercion_gastosfijos.php");

    $_SESSION["gestion"] = $nuevoGastosfijos;

    $errores = validarDatosGastos($nuevoGastosfijos);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_insercion_gastosfijos.php');
    } else
        Header('Location: accion_insertar_gastosfijos.php');

    function validarDatosGastos($nuevoGastosfijos){
        if($nuevoGastosfijos["MESAGUALUZ"]==""){ 
            $errores[] = "<p>El mes no puede estar vacío</p>";
        }   
        
        if($nuevoGastosfijos["CANTIDADAGUALUZ"]==""){ 
            $errores[] = "<p>El gasto de agua no puede estar vacío</p>";
        }
  
      
        return $errores;
    }
?>