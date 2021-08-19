<?php
	session_start();

	
	if (!isset($_SESSION['reserva'])) {
		$reserva['NOMBRECLIENTES'] = "";
		$reserva['APELLIDOSCLIENTES'] = "";
		$reserva['TELEFONOCLIENTES'] = "";
		$reserva['NUMEROPERSONA'] = "";
		$reserva['HORARESERVA'] = "";

		$_SESSION['reserva'] = $reserva;
	}
	else
		$reserva = $_SESSION['reserva'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <script src="validacion_formulario.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="css/form_insercion.css" />
  <title>Alta de Reservas</title>
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
	<form method="get" action="validacion_insercion_reservas.php" onsubmit="return ValidarReservas()">
		
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
		            <span>RESERVA</span>
		          </div>
		          <div id = "barraTitle" class="app-contact">Bar La Campiña</div>
		        </div>
		        <div class="screen-body-item">
		          <div class="app-form">
		            <div class="app-form-group">
		              <input id="NOMBRECLIENTES" type="text" size="20" name="NOMBRECLIENTES" class="app-form-control" placeholder="NOMBRE" value="<?php echo $reserva['NOMBRECLIENTES'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="APELLIDOSCLIENTES" type="text" size="20" name="APELLIDOSCLIENTES" class="app-form-control" placeholder="APELLIDOS" value="<?php echo $reserva['APELLIDOSCLIENTES'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="TELEFONOCLIENTES" type = "text"  size="40" name="TELEFONOCLIENTES" class="app-form-control" placeholder="TELÉFONO" value="<?php echo $reserva['TELEFONOCLIENTES'];?>" />
		            </div>
		            <div class="app-form-group">
		              <input id="NUMEROPERSONA" type="text" name="NUMEROPERSONA" class="app-form-control" placeholder="NÚMERO PERSONAS" value="<?php echo $reserva['NUMEROPERSONA'];?>" />
		            </div>
		            <div class="app-form-group message">
		              <input id="HORARESERVA" type="text" name="HORARESERVA" class="app-form-control" placeholder="HH:MM" value="<?php echo $reserva['HORARESERVA'];?>" />
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
	
	<!-- <form method="get" action="validacion_insercion_reservas.php" novalidate>
		<fieldset><legend>Datos</legend>
			<div></div><label for="NombreClientes">Nombre</label>
			<input id="NombreClientes" name="NombreClientes" type="text" size="20" value="<?php echo $reserva['NombreClientes'];?>" required>
			</div>

			<div><label for="TelefonoClientes">Telefono:</label>
			<input id="TelefonoClientes" name="TelefonoClientes" type="text" pattern="^[0-9]{9}" value="<?php echo $reserva['TelefonoClientes'];?>" required/>
			</div>

			<div><label for="NumeroPersonas">Numero de personas:</label>
			<input id="NumeroPersonas" type="text" name="NumeroPersonas" value="<?php echo $reserva['NumeroPersonas'];?>" required/>
			</div>

			<div><label for="Fecha">Fecha:</label>
			<input id="Fecha" name="Fecha" type="date" value="<?php echo $reserva['Fecha'];?>" required/><br>
			</div>
		</fieldset>

		<div><input type="submit" value="Añadir" /></div>

	</form> -->
	
	<?php
		include_once("pie.php");
	?>
	
	</body>
</html>