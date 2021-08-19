<?php
    session_start();
    
    if (isset($_SESSION['gestion'])) {
        $nuevoGasto["OIDAL"] = $_REQUEST["OIDAL"];
    }
    else 
        Header("Location: form_eliminacion_gastosfijos.php");

    $_SESSION["gestion"] = $nuevoGasto;

    $errores = validarDatosEliminacionGasto($nuevoGasto);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_eliminacion_gastosfijos.php');
    } else
        Header('Location: accion_borrar_gastos.php');

    function validarDatosEliminacionGasto($nuevoGasto){
        if($nuevoGasto["OIDAL"]==""){ 
            $errores[] = "<p>El nº de tapa no puede estar vacío</p>";
        } 
          
        return $errores;
    }
?>