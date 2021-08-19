<?php
    session_start();
    
    if (isset($_SESSION['inventario'])) {
        $nuevaBebida["OIDBEB"] = $_REQUEST["OIDBEB"];
    }
    else 
        Header("Location: form_eliminacion_bebida.php");

    $_SESSION["inventario"] = $nuevaBebida;

    $errores = validarDatosEliminacionBebida($nuevaBebida);
    
    if (count($errores)>0) {
        $_SESSION["errores"] = $errores;
        Header('Location: form_eliminacion_bebida.php');
    } else
        Header('Location: accion_borrar_bebida.php');

    function validarDatosEliminacionBebida($nuevaBebida){
        if($nuevaBebida["OIDBEB"]==""){ 
            $errores[] = "<p>El nº de tapa no puede estar vacío</p>";
        } 
          
        return $errores;
    }
?>