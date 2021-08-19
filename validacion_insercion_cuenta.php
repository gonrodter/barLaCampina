<?php
	session_start();


	if (isset($_SESSION['cuenta'])) {
		$nuevaCuenta["OIDBEB"] = $_REQUEST["OIDBEB"];
		$nuevaCuenta["OIDTAP"] = $_REQUEST["OIDTAP"];
		$nuevaCuenta["CANTIDADLC"] = $_REQUEST["CANTIDADLC"];
		$nuevaCuenta["MESLC"] = $_REQUEST["MESLC"];
		$nuevaCuenta["NCUENTA"] = $_REQUEST["NCUENTA"];

	}
	else 
		Header("Location: form_insercion_cuenta.php");

	$_SESSION["cuenta"] = $nuevaCuenta;

	$errores = validarDatosCuenta($nuevaCuenta);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: form_insercion_cuenta.php');
	} else
		Header('Location: accion_insertar_cuenta.php');

	function validarDatosCuenta($nuevaCuenta){
		require_once("gestionBD.php");
	    require_once("gestionar_inventario.php");
		$conexion = crearConexionBD();
	    $filas = consultarTapas($conexion);
		$filas2 = consultarBebidas($conexion);
        $tapasTodasMenosPedidas = consultarCantidadFinalTapas($conexion);
        $bebidasTodasMenosPedidas = consultarCantidadFinalBebidas($conexion);
		cerrarConexionBD($conexion);
		$array = array();
		$array2 = array();
		
		foreach($filas as $fila) { 
		        array_push($array, $fila["OIDTAP"]);
		    }
		foreach($filas2 as $fila2) { 
		        array_push($array2, $fila2["OIDBEB"]);
		    }
		
		if($nuevaCuenta["OIDBEB"]=="" && $nuevaCuenta["OIDTAP"]==""){
		$errores[] = "<p>Rellene alguno de los dos campos de números de tapa o bebida</p>";
		}
		
		if($nuevaCuenta["OIDBEB"]!="" && $nuevaCuenta["OIDTAP"]!=""){
		$errores[] = "<p>Rellene solo uno de los dos campos de números de tapa o bebida</p>";
		}
		
		if(!in_array($nuevaCuenta["OIDTAP"], $array)&& $nuevaCuenta["OIDTAP"] != ""){ 
		           	$errores[] = "<p>El nº de la tapa no existe</p>";
		}
		if(!in_array($nuevaCuenta["OIDBEB"], $array2)&& $nuevaCuenta["OIDBEB"] != ""){ 
		           	$errores[] = "<p>El nº de la bebida no existe</p>";
		}
		
		if($nuevaCuenta["CANTIDADLC"]==""){ 
			$errores[] = "<p>La cantidad no puede estar vacía</p>";
		}	
		
		if($nuevaCuenta["MESLC"]==""){ 
			$errores[] = "<p>El Mes no puede estar vacío</p>";
		}
			
		if($nuevaCuenta["NCUENTA"]==""){ 
			$errores[] = "<p>El nº de cuenta no puede estar vacío</p>";
		}
		


        foreach ($tapasTodasMenosPedidas as $tapa) {
            if($nuevaCuenta['OIDTAP'] == $tapa["OIDTAP"]){
                $tapasIniciales = $tapa["CANTIDADPRODUCTOS"];
                $tapasConsumidas = $tapa["SUM(CANTIDADLC)"];
                $tapasPedidasAProveedores = productosPedidos($conexion, $tapa["NOMBREPRODUCTOS"]);
                $tapasDisponibles = $tapasIniciales - $tapasConsumidas + $tapasPedidasAProveedores;
                if($tapasDisponibles<$nuevaCuenta['CANTIDADLC']){
                    $errores[] = "<p>No hay suficiente inventario</p>";
                }
            }
        }
        foreach ($bebidasTodasMenosPedidas as $bebida) {
            if($nuevaCuenta['OIDBEB'] == $bebida["OIDBEB"]){
                $bebidasIniciales = $bebida["CANTIDADPRODUCTOS"];
                $bebidasConsumidas = $bebida["SUM(CANTIDADLC)"];
                $bebidasPedidasAProveedores = productosPedidos($conexion, $bebida["NOMBREPRODUCTOS"]);
                $bebidasDisponibles = $bebidasIniciales - $bebidasConsumidas + $bebidasPedidasAProveedores;
                if($bebidasDisponibles<$nuevaCuenta['CANTIDADLC']){
                    $errores[] = "<p>No hay suficiente inventario</p>";
                }
            }
        }
cerrarConexionBD($conexion);
		
	
		return $errores;
	}
?>