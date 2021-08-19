<?php   
    session_start();
    
    if (isset($_REQUEST['OIDLP'])) {
        $pedido["OIDLP"] = $_REQUEST["OIDLP"];   
        $_SESSION["pedido"] = $pedido;
    }
    else 
        echo $_REQUEST['OIDLP'];
        Header("Location: pedidos.php");
    
?>