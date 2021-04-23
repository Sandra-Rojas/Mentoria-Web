<?php

$valido= null;
$result= null;
$username = null;
$password = null;

if (isset($_POST['sing-in-button'])) {
	//buscar datos
	//utilizar mysqli para accesar a bd
	$dbname = "registro";
	$dbuser = "registro_user";
	$dbpass = "registro_user1";

	$db = new mysqli('localhost', $dbuser, $dbpass, $dbname);
	$db->set_charset('utf8mb4');

	/****************************** */
	/* comprobar la conexión */
	if ($db->connect_errno) {
		printf("Conexión fallida: %s\n", $mysqli->connect_error);
		exit();
	}

	/* comprobar si el servidor sigue vivo */
	if ($db->ping()) {
		printf ("¡La conexión está bien!\n");
	} else {
		printf ("Error: %s\n", $mysqli->error);
	}
	//*********************** */
	//If (!isset ($_POST['username']))  $_POST['username']= false	;
	//If (!isset ($_POST['pass']))  $_POST['pass']= false	;

	$username = $_POST['username'];
	$password = $_POST['pass'];

	echo "username" . $username . "-";

	$sql = "SELECT * FROM users WHERE user_name = '$username'";
	echo $sql;

	$result = $db->query($sql);

	/****cuenta filas */
	$row_cnt = $result->num_rows;
	echo "\n Cantidad de filas encontradas: " ;
	echo $row_cnt;
	/************ */

	//modifica sentencia result, se debe validar tb que query devuelve datos
	if ($result) {
		if ($row = $result->fetch_assoc()){
			echo "\nDatos de query: ";
			print_r($row);
			echo "\nEl result existe\n";
			}
		else {
			$valido = false;
		}
	} else {
		$valido = false;
	}

	echo "$username, $password ";

	 /* liberar el conjunto de resultados */
	 $result->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registro Mentoria Web</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<style>
		.msg-form{
			margin:1em;
			color: red;
		}
</style>

</head>

<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" method="POST" action="index.php">
					<input type="hidden" name="super-secreto" valor="valor super secreto">
					<span class="login100-form-title p-b-59">
						<!--Sign Up-->
						Sign In
					</span>

					<!--controla que una vez ingresado los datos y no encuentre datos indica que uusario o passw es incorrecta -->
					<?php if($valido === false):?>
						<p class="msg-form">Usuario o password incorrecto </p>
					<?php endif; ?> 

					
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Username...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="*****">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="sing-in-button">
								<!--Sign Up-->
								Sign In
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>