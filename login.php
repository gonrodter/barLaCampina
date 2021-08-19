<?php
	session_start();
	
	include_once("gestionBD.php");
	include_once("gestionarUsuarios.php");
	
	if (isset($_POST['submit'])){
		$usuario= $_POST['usuario'];
		$pass = $_POST['pass'];
	
		$conexion = crearConexionBD();
		$n_usuarios = consultarUsuario($conexion, $usuario, $pass);
		cerrarConexionBD($conexion);
	
		if ($n_usuarios == 0)
		$login = "error";

		else {
			$_SESSION['login'] = $usuario;
			header("Location: home.php");
		}
		
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/login.css" />
  <title>Acceso a la aplicacion web Bar La Campiña</title>
</head>

<body style="background: #0f2027; background: linear-gradient(to right,#2c5364, #203a43, #0f2027")>
	

<main>
		<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	
	<form action="login.php" method="post">
		<div class="container">
		  <div class="left">
		    <div class="header">
		      <h2 class="animation a1">Bienvenido!</h2>
		    </div>
		    <div class="form">
		      <input type="text" name="usuario" class="form-field animation a3" placeholder="Usuario">
		      <input type="password" name="pass" class="form-field animation a4" placeholder="Contraseña">
		      <button type="submit" name="submit" value="submit" class="animation a6">LOGIN</button>
		    </div>
		  </div>
		  <div class="right"></div>
		</div>
	</form>
	


</main>
<?php
	include_once("pie.php");
?>
</body>
</html>