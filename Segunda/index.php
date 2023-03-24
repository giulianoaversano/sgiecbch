<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <?php include('../includes/title.inc');
    include ('../clock.php');
    ?>
</head>
	<style>

		body {
            font-family: Verdana, sans-serif;
	font-size:80%;
}

/* porcentaje base, solo en el body */
p {
    font-family: Verdana, sans-serif;
	font-size:0.9em;
}
h1 {
    font-family: Verdana, sans-serif;
    font-size:2em;
}
h2 {
    font-family: Verdana, sans-serif;
    font-size:1.4em;
}


/* fin de zona común a todas las resoluciones */
@media screen and (min-width:800px) {
	body {
        font-family: Verdana, sans-serif;
        font-size:200%;
		/* ampliamos los textos si mide más de 800px */
	}
}

/* fin de la zona para más de 800px de ancho de pantalla */
@media screen and (min-width:1200px) {
	body {
        font-family: Verdana, sans-serif;
        font-size:100%;
		/* ampliamos más aún los textos si mide más de 1200px */
	}
}

/* fin de la zona para más de 1200px de ancho de pantalla */
	</style>

	<style>
@media screen and (max-width:480px){
	body {
		h1 {
            font-family: Verdana, sans-serif;
            font-size: 20px;
}
	body {
		h2 {
            font-family: Verdana, sans-serif;
            font-size: 18px;
}

h3 {
    font-family: Verdana, sans-serif;
    font-size: 16px;
  }
}
	}
}

</style>
<style>
    hr.lineaverde {
        border: 8px solid green;
        border-radius: 5px;
    }
</style>
<!-- BOTONES -->
<style type="text/css" media="screen">
.botonIN {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 12px; /*espacio alrededor texto*/
background-color: #2E9B2F; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: Verdana; /*tipografía texto*/
border-radius: 50px; /*bordes redondos**/
font-size: 18px;
}
	</style>

<style>
.botonOUT {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 12px; /*espacio alrededor texto*/
background-color: #C0080B; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: Verdana; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
	font-size: 18px;
}

	</style>
<style>
.botonAZUL {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 12px; /*espacio alrededor texto*/
background-color: #0930C5; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: Verdana; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
	font-size: 18px;
}

	</style>
<body>
<?php
header("Refresh: 60");
session_start();
include ('compania.php');
include('../header.php');
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");

}



$user = "SELECT compania FROM Users where username='$_SESSION[username]'";
if ($resuser = $conn->query($user)) {
    while ($ruser = $resuser->fetch_assoc()) {
$usrcia = $ruser['compania'];
    }
}



if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] === 1 AND $usrcia != $compania)) {
    echo '<script> alert("Tu usuario no cuenta con el permiso para acceder a esta página"); window.location = "../index.php" </script>';
    exit;
}

if(!isset($_SESSION["nivel"]) || (($_SESSION["nivel"] >= 2) OR ($_SESSION["nivel"] = 1 AND $usrcia = $compania) )) {

   include ('../includes/botonera.php');


    $maxaforo = "SELECT * FROM aforo where compania='$compania'";

    if ($result = $conn->query($maxaforo)) {
        while ($row = $result->fetch_assoc()) {
            echo '<p style="color:red">Aforo Máximo Permitido: ' . $row["maxaforo"] . ' Personas</p>';
        }
    }


    $cuenta = "SELECT SUM((SELECT count(id) from registro WHERE evento='Ingreso'  AND registro.compania='$compania' ) + (SELECT count(id) from Registro_Visitas WHERE evento='Ingreso' AND compania='$compania')) as var";


    if ($result = $conn->query($cuenta)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<p style="color:red">Total En Cuartel: ' . $row["var"] . '</p>';
            }
        }
    }

    echo '
	<h3 align=center><u>Personal Presente en ' . $compania . ' Compañía</u> </h3>
<p>';


    $respuesta = "SI";
    $estado = "Ingreso";

    /* OFICIALES DE MANDO */
echo '<table>';
    include ('../includes/oficiales.php');
    echo '</table>';

    /* VOLUNTARIOS */
    echo '<table>';
    include ('../includes/voluntarios.php');
    echo '</table>';
    /* CUARTELERO Y CONDUCTORES */
    echo '<table>';
    include ('../includes/cuarteleros.php');
    echo '</table>';
    /* BRIGADIERES */
    echo '<table>';
    include ('../includes/brigadieres.php');
    echo '</table>';
    /* VISITAS */
    echo '<table>';
    include ('../includes/visitas.php');
    echo '</table>';
}

?>

</body>
</html>	
