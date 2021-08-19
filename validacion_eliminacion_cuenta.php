<?php
    session_start();
    
    if (isset($_SESSION['cuenta'])) {
        $nuevaCuenta["OIDLC"] = $_REQUEST["OIDLC"];
    }
    else 
        Header("Location: form_eliminacion_cuenta.php");

    $_SESSION["cuenta"] = $nuevaCuenta;

    $errores = validarDatosEliminacionCuenta($nuevaCuenta);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_eliminacion_cuenta.php');
    } else
        Header('Location: accion_borrar_cuenta.php');

    function validarDatosEliminacionCuenta($nuevaCuenta){
        if($nuevaCuenta["OIDLC"]==""){ 
            $errores[] = "<p>El nº de tapa no puede estar vacío</p>";
        } 
          
        return $errores;
    }
?>