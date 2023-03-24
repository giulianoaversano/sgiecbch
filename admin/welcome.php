<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
    <link rel="stylesheet" href="style.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>

    <style>
        .botonverde {
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .botonverde:hover {background-color: #3e8e41}

        .botonverde:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        .botonrojo {
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #D10003;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .botonrojo:hover {background-color: #B32022}

        .botonrojo:active {
            background-color: #B32022;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

    </style>
</head>
<body>
<?php
session_start();
include ('compania.php');
include('../header.php');
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");

}

$user = "SELECT compania FROM Users where username='$_SESSION[username]'";
if ($resuser = $conn->query($user)) {
    while ($ruser = $resuser->fetch_assoc()) {
        $usrcia = $ruser['compania'];
    }
}
?>


<h2 align="center" style="color:blue"><b>Gestión Administrativa</b><br>
</h2>

<?php


if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] === 1 )) {
   echo'
<table width="100%" align="left">
	<tr>
		<td></td>
		<td align="center"> <a align="center" href="ConsultaPersona.php" target="_blank"><button class="botonverde" >Consulta <br>Persona</button> </a></td>
		</tr></table>   
   ';

}

if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] === 2) {

    echo '

<table width="100%" align="left">
	<tr>
		<td></td>
		<td align="center"> <a align="center" href="consultas.php"><button class="botonverde" >Consultas</button> </a></td>
	<td></td>
		<td align="center"> <a align="center" href="nomina.php"><button class="botonverde" >Nómina</button> </a></td>
		<td></td>
				<td align="center"> <a align="center" href="ConsultaPersona.php"><button class="botonverde" >Consulta <br>Persona</button> </a></td>
		<td></td>
				<td align="center"> <a align="center" href="forzarsalida.php"><button class="botonverde" >Forzar Salida</button> </a></td>
		<td></td>

	</tr>
	<tr>
			 <td colspan="11"><p style="color:white" align="center"></p>
	</tr>
		<tr>
			 <td colspan="11"><p style="color:white" align="center"></p>
	</tr>
<td></td>
		<td align="center"> <a align="center" href="logout.php"><button class="botonrojo" >Salir</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="reset-password.php"><button class="botonrojo" >Cambiar Contraseña</button> </a></td>
		<td> </td>
	</tr>
	</table>
	
	
</body>
</html>';
}

if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] === 3) {

    echo '

<table width="100%" align="left">
	<tr>
		<td></td>
		<td align="center"> <a align="center" href="consultas.php" ><button class="botonverde" >Consultas</button> </a></td>
	<td></td>
		<td align="center"> <a align="center" href="nomina.php" ><button class="botonverde" >Nómina</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="forzarsalida.php" ><button class="botonverde" >Forzar Salida</button> </a></td>
	
		<td></td>
		<td align="center"> <a align="center" href="ActualizaBombero.php" ><button class="botonverde" >Actualizar Bombero</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="RegistraNuevoBombero.php" ><button class="botonverde" >Registra Bombero</button> </a></td>
		<td> </td>
	</tr>
	<tr>
			 <td colspan="11"><p style="color:white" align="center"></p>
	</tr>
		<tr>
			 <td colspan="11"><p style="color:white" align="center"></p>
	</tr>
<td></td>
		<td align="center"> <a align="center" href="ConsultaPersona.php" ><button class="botonverde" >Consulta <br>Persona</button> </a></td>

<td></td>
		<td align="center"> <a align="center" href="logout.php" ><button class="botonrojo" >Salir</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="reset-password.php" ><button class="botonrojo" >Cambiar Contraseña</button> </a></td>
		<td> </td>
	</tr>
	</table>
	
';
}
if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] === 4) {

    echo '

<table width="100%" align="left">
	<tr>
		<td></td>
		<td align="center"> <a align="center" href="consultas.php" ><button class="botonverde" >Consultas</button> </a></td>
	<td></td>
		<td align="center"> <a align="center" href="nomina.php"><button class="botonverde" >Nómina</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="forzarsalida.php" ><button class="botonverde" >Forzar Salida</button> </a></td>
	
		<td></td>
		<td align="center"> <a align="center" href="ActualizaBombero.php"><button class="botonverde" >Actualizar Bombero</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="RegistraNuevoBombero.php" ><button class="botonverde" >Registra Bombero</button> </a></td>
		<td> </td>
	</tr>
	<tr>
			 <td colspan="11"><p style="color:white" align="center"></p>
	</tr>
		<tr>
			 <td colspan="11"><p style="color:white" align="center"></p>
	</tr>
<td></td>
		<td align="center"> <a align="center" href="ConsultaPersona.php" ><button class="botonverde" >Consulta <br>Persona</button> </a></td>

<td></td>
				<td align="center"> <a align="center" href="ModificaAforo.php" ><button class="botonverde" >Modifica Aforo</button> </a></td>
				<td></td>
				<td align="center"> <a align="center" href="register.php" ><button class="botonverde" >Nuevo Usuario</button> </a></td>
		<td> </td>

		
		<td align="center"> <a align="center" href="reset-password-otros.php" ><button class="botonrojo" >Reset Password <br>Otros</button> </a></td>
		<td></td>
		<td align="center"> <a align="center" href="reset-password.php" ><button class="botonrojo" >Cambiar Contraseña</button> </a></td>
		<td> </td>
	</tr>
	</table>
	
';
}

    ?>

</body>
</html>
