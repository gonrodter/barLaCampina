<?php
	session_start();

	
	if (!isset($_SESSION['cuenta'])) {
		$cuenta['OIDBEB'] = "";
		$cuenta['OIDTAP'] = "";
		$cuenta['CANTIDADLC'] = "";
		$cuenta['MESLC'] = "";
		$cuenta['NCUENTA'] = "";

		$_SESSION['cuenta'] = $cuenta;
	}
	else
		$cuenta = $_SESSION['cuenta'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/form_insercion.css" />
  <script src="validacion_formulario.js" type="text/javascript"></script>
  <title>Alta de Cuentas</title>
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027">
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
	<form method="get" action="validacion_insercion_cuenta.php" onsubmit="return ValidarCuenta()">
		<div class="background">
		  <div class="container">
		    <div class="screen">
		      <div class="screen-header">
		        <div class="screen-header-left">
		          <div class="screen-header-button close" id="divRojo" onclick="cambiarRojo()"></div>
		          <div class="screen-header-button maximize" id="divAmarillo" onclick="cambiarAmarillo()"></div>
		          <div class="screen-header-button minimize" id="divVerde" onclick="cambiarVerde()"></div>
		        </div>
		        <div class="screen-header-right">
		          <div class="screen-header-ellipsis"></div>
		          <div class="screen-header-ellipsis"></div>
		          <div class="screen-header-ellipsis"></div>
		        </div>
		      </div>
		      <div class="screen-body">
		        <div class="screen-body-item left">
		          <div id = "titleAnnadir" class="app-title">
		            <span>AÑADIR</span>
		            <span>CUENTA</span>
		          </div>
		          <div id = "barraTitle" class="app-contact">Bar La Campiña</div>
		        </div>
		        <div class="screen-body-item">
		          <div class="app-form">
		            <div class="app-form-group">
		              <input id="OIDBEB" type="text" name="OIDBEB" class="app-form-control" placeholder="Nº BEBIDA" value="<?php echo $cuenta['OIDBEB'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="OIDTAP" type="text" name="OIDTAP" class="app-form-control" placeholder="Nº TAPA" value="<?php echo $cuenta['OIDTAP'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="CANTIDADLC" type="text" name="CANTIDADLC" class="app-form-control" placeholder="CANTIDAD" value="<?php echo $cuenta['CANTIDADLC'];?>" />
		            </div>
		            <div class="app-form-group message">
		              <input id="MESLC" type="text"  name="MESLC" class="app-form-control" placeholder="MES" value="<?php echo $cuenta['MESLC'];?>" />
		            </div>
		            <div class="app-form-group message">
		              <input id="NCUENTA" type="text" name="NCUENTA" class="app-form-control" placeholder="Nº CUENTA" value="<?php echo $cuenta['NCUENTA'];?>" />
		            </div>
		            
		            <div class="app-form-group buttons">
		              <button id="btnAnnadir" type="submit" class="app-form-button">AÑADIR</button>	              
					<script>
					var style = document.querySelector('.app-title').style;
					style.setProperty('--background', '#ea1d6f');
					
					function cambiarRojo() {
					  document.getElementById("btnAnnadir").style.color = "#ea1d6f";
					  document.getElementById("titleAnnadir").style.color = "#ea1d6f";
					  style.setProperty('--background', '#ea1d6f');
					}
					
					function cambiarAmarillo() {
					  document.getElementById("btnAnnadir").style.color = "#e8e925";
					  document.getElementById("titleAnnadir").style.color = "#e8e925";
					  style.setProperty('--background', '#e8e925');
					}
					
					function cambiarVerde() {
					  document.getElementById("btnAnnadir").style.color = "#74c54f";
					  document.getElementById("titleAnnadir").style.color = "#74c54f";
					  style.setProperty('--background', '#74c54f');
					}
					</script>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</form>
	
	
	<!-- <fieldset><legend>Datos</legend>
			<div></div><label for="OidBeb">Identificador Bebida:</label>
			<input id="OidBeb" name="OidBeb" type="text" size="20" value="<?php echo $cuenta['OidBeb'];?>" required>
			</div>

			<div><label for="OidTap">Identificador Tapa:</label>
			<input id="OidTap" name="OidTap" type="text" size="40" value="<?php echo $cuenta['OidTap'];?>" required/>
			</div>

			<div><label for="CantidadLc">Cantidad:</label>
			<input id="CantidadLc" type="text" name="CantidadLc" size="40" value="<?php echo $cuenta['CantidadLc'];?>" required/>
			</div>

			<div></div><label for="MesLc">Mes:</label>
			<input id="MesLc" name="MesLc" type="text" size="20" value="<?php echo $cuenta['MesLc'];?>" required>
			</div>

			<div><label for="OidCu">Nº cuenta:</label>
			<input id="OidCu" name="OidCu" type="text" size="40" value="<?php echo $cuenta['OidCu'];?>" required/>
			</div>			
		</fieldset>

		<div><input type="submit" value="Añadir" /></div> -->
		
		
	<?php
		include_once("pie.php");
	?>
	
	</body>
</html>