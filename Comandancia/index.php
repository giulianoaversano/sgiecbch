
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CBCH - Ingreso/Egreso</title>

</head>
	<style>

		body {
            font-family: 'Verdana', sans-serif;
}

/* porcentaje base, solo en el body */
p {
    font-family: 'Verdana', sans-serif;
    font-size:0.9em;
}
h1 {
    font-family: 'Verdana', sans-serif;

}
h2 {
    font-family: 'Verdana', sans-serif;
}
#pie {
    font-family: 'Verdana', sans-serif;
    font-size:1.2em;
}
.epigrafes {
    font-family: 'Verdana', sans-serif;
    font-size:1.1em;
}

/* fin de zona común a todas las resoluciones */
@media screen and (min-width:800px) {
	body {
        font-family: 'Verdana', sans-serif;
		/* ampliamos los textos si mide más de 800px */
	}
}

/* fin de la zona para más de 800px de ancho de pantalla */
@media screen and (min-width:1200px) {
	body {
        font-family: 'Verdana', sans-serif;
		/* ampliamos más aún los textos si mide más de 1200px */
	}
}

/* fin de la zona para más de 1200px de ancho de pantalla */
	</style>
	
	<style>
@media screen and (max-width:480px){
	body {
		h1 {
            font-family: 'Verdana', sans-serif;
}
	body {
		h2 {
            font-family: 'Verdana', sans-serif;
}
 
h3 {
    font-family: 'Verdana', sans-serif;
  }
} 
	}
}

</style>

<!-- BOTONES -->
<style type="text/css" media="screen">
.botonIN {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 15px; /*espacio alrededor texto*/
background-color: #61a6c9; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: 'Verdana', sans-serif; /*tipografía texto*/
border-radius: 50px; /*bordes redondos**/
font-size: 18px;
}
	</style>

<style>	
.botonOUT {
border: 1px solid #8b6c2e; /*anchura, estilo y color borde*/
padding: 15px; /*espacio alrededor texto*/
background-color: rgba(192, 167, 8, 0.79); /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
    font-family: 'Verdana', sans-serif; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
	font-size: 18px;
}
	
	</style>
<style>	
.botonAZUL {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 15px; /*espacio alrededor texto*/
background-color: #0930C5; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
    font-family: 'Verdana', sans-serif; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
	font-size: 30px;	
}
	
	</style>
<body>

<?php

session_start();
include ('compania.php');
include('../header.php');
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    header("Refresh: 60");
}



$user = "SELECT compania FROM Users where username='$_SESSION[username]'";
if ($resuser = $conn->query($user)) {
    while ($ruser = $resuser->fetch_assoc()) {
        $usrcia = $ruser['compania'];
    }
}



if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] === 1 AND $usrcia != $compania)) {
    echo '<script> alert("Tu usuario no cuenta con el permiso para acceder a esta página");window.location = "../index.php" </script>';
    exit;
}
echo '<table width="100%">
<tr><td width="30%" style="border: #3d3e47">';


if(!isset($_SESSION["nivel"]) || (($_SESSION["nivel"] >= 2) OR ($_SESSION["nivel"] = 1 AND $usrcia = $compania) )) {
    $maxaforo = "SELECT * FROM aforo where compania='Comandancia'";


    if ($result = $conn->query($maxaforo)) {
        while ($row = $result->fetch_assoc()) {
            echo '<p style="color:red">Aforo Máximo Permitido: ' . $row["maxaforo"] . ' Personas</p>';
        }
    }


    $cuenta = "SELECT SUM((SELECT count(id) from registro WHERE evento='Ingreso' AND compania='$compania') + (SELECT count(id) from Registro_Visitas WHERE evento='Ingreso' AND compania='$compania')) as var";


    if ($result = $conn->query($cuenta)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<p style="color:red">Aforo Total Actual: ' . $row["var"] . ' Personas</p>';
            }
        }
    }
    echo '
</td>
<form method="POST" >
<td width="70%" align="center">
<table width="100%">
<td width="10%"></td>
<td width="40%" align="right"><input type="submit" name="bomberos" value="INGRESO/EGRESO" class="botonIN" formaction="Registro.php"></td>
<td width="10%"></td>
<td width="40%" align="left"><input type="submit" name="visitas" value="VISITAS" class="botonOUT" formaction="visitas.php"></td>
  	</td>
  	</table>
  	</tr>
</form>
</table>




';

    echo '
	<h3 align=center><u>PERSONAL PRESENTE EN COMANDANCIA</u> </h3>
<p>';


    $respuesta = "SI";
    $estado = "Ingreso";

    /* OFICIALES GENERALES */
    echo '<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="2" width="100%" cellpadding="2"> 
      <tr style="background-color:#ffc400">
	    <td colspan="7"><p style="color:#363636; font-size: 14px" align="center"><b>OFICIALES GENERALES</b></p>
		</tr>
		<tr style="color:#585858">
        <td align="center"> <b>Clave Radial</b></font> </td> 
        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>Cargo</font> </b></td> 
        <td align="center"> <b>Ingreso</font> </b></td> 
        <td align="center"> <b>Estado</font> </b></td> 
      </tr>';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql3 = "SELECT * FROM registro,nomina WHERE registro.evento='$estado' AND registro.rut = nomina.rut AND ofgral='Si'  AND registro.compania='$compania' ORDER BY clave ASC";

    if ($result = $conn->query($sql3)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row[clave];
            $field2name = $row[nombres];
            $field3name = $row[apellido_paterno];
            $field4name = $row[apellido_materno];
            $field5name = $row[cargo];
            $field6name = $row[ingreso];
            $field7name = $row[estado];

            echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
             </tr>';

        }
    }
    echo '</table>';
    /* INSPECTORES DE COMANDANCIA */


    echo '	<table border="0" width="100%" cellpadding="10"> 
      <tr><td ></td><td ></td><td ></td></tr>
	  </table>';

    echo '		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="" width="100%" cellpadding=""> 
            <tr style="background-color:#4b8499">
	    <td colspan="7"><p align="center" style="color:#dedede; font-size: 14px"><b>INSPECTORES DE COMANDANCIA</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center"> <b>Clave Radial</b></font> </td> 
        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>Cargo</font> </b></td> 
        <td align="center"> <b>Ingreso</font> </b></td> 
        <td align="center"> <b>Estado</font> </b></td> 

      </tr>';


    $sql4 = "SELECT * FROM registro,nomina WHERE registro.rut = nomina.rut AND ofcom ='Si' AND registro.evento='Ingreso'  AND registro.compania='$compania'  ORDER BY nomina.cargo DESC, nomina.clave ASC";

    if ($result = $conn->query($sql4)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row[clave];
            $field2name = $row[nombres];
            $field3name = $row[apellido_paterno];
            $field4name = $row[apellido_materno];
            $field5name = $row[cargo];
            $field6name = $row[ingreso];
            $field7name = $row[estado];

            echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				
             </tr>';

        }
    }
    echo '</table><br>';

    /* OFICIALES COMPAÑÍA */


    echo '		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="" width="100%" cellpadding=""> 
            <tr style="background-color:#01bb5d">
	    <td colspan="7"><p align="center" style="color:#363636; font-size: 14px"><b>OFICIALES DE COMAPAÑÍA</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center"> <b>Compañía</b></font> </td> 
        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>Cargo</font> </b></td> 
        <td align="center"> <b>Ingreso</font> </b></td> 
        <td align="center"> <b>Estado</font> </b></td> 

      </tr>';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql5 = "SELECT * FROM registro,nomina WHERE registro.evento='$estado' AND registro.rut = nomina.rut AND oficial='Si' AND ofgral='No' AND registro.compania='$compania' ORDER BY nomina.clave IS NOT NULL ASC, registro.rut";

    if ($result = $conn->query($sql5)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row[compania];
            $field2name = $row[nombres];
            $field3name = $row[apellido_paterno];
            $field4name = $row[apellido_materno];
            $field5name = $row[cargo];
            $field6name = $row[ingreso];
            $field7name = $row[estado];

            echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				
             </tr>';

        }
    }
    echo '</table><br>';
    /* PERSONAL CIVIL */
    echo '	<table border="0" cellspacing="6" width="100%" cellpadding="10"> 
      <tr></tr>
	  <tr></tr>
	  </table>';

    echo '	
		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="2" width="100%" cellpadding="2"> 
      <tr style="background-color:#f8ff1e">
	    <td colspan="6"><p align="center" style="color:#363636; font-size: 14px"><b>COLABORADORES
	    </b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center"> <b>RUT</b></font> </td> 
        

        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>Cargo</font> </b></td> 
        <td align="center"> <b>Ingreso</font> </b></td> 

      </tr>';


    $sql6 = "SELECT * FROM registro,nomina WHERE registro.evento='Ingreso' AND registro.rut = nomina.rut AND nomina.civil='Si' AND registro.compania='$compania'  ORDER BY nomina.clave IS NOT NULL ASC ";


    if ($result = $conn->query($sql6)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row[rut];
            $field2name = $row[dv];
            $field3name = $row[nombres];
            $field4name = $row[apellido_paterno];
            $field5name = $row[apellido_materno];
            $field6name = $row[cargo];
            $field7name = $row[ingreso];

            echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '-' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				
             </tr>';

        }
    }

    $sql7 = "SELECT * FROM registro, nomina WHERE registro.evento='$estado' AND registro.rut = nomina.rut AND cargo='cuartelero' AND registro.compania='$compania'   ORDER BY 1 ASC ";


    if ($result = $conn->query($sql7)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row[reg_cpo];
            $field2name = $row[nombres];
            $field3name = $row[apellido_paterno];
            $field4name = $row[apellido_materno];
            $field5name = $row[cargo];
            $field6name = $row[ingreso];

            echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				
             </tr>';

        }
    }
    echo '</table><br>';

    /* BRIGADIERES */

  include('../includes/brigadieres.php');

    /* VISITAS */

    echo '	<table border="0" cellspacing="2" width="100%" cellpadding="10"> 
      <tr></tr>
	  <tr></tr>
	  </table>';

    echo '	
		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="2" width="100%" cellpadding="2"> 
            <tr style="background-color:lightgrey">
	    <td colspan="8" style="color:black; font-size: 14px"><p align="center"><b>VISITAS & EXTERNOS</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center" > <b>RUT</b></font> </td> 
        <td align="center" > <b>Nombres</b></font> </td> 
        <td align="center" > <b>Apellido Paterno</b></font> </td> 
        <td align="center" > <b>Apellido Materno</b></font> </td> 
        <td align="center" > <b>Motivo de Ingreso</font> </b></td> 
        <td align="center" > <b>Autorizado Por</font> </b></td> 
        <td align="center" > <b>Fecha/Hora Ingreso</font> </b></td> 
        <td align="center" > <font face="Arial" color="grey"><b>Temp.</font> </b></td> 
      </tr>';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql8 = "SELECT * FROM Registro_Visitas WHERE Registro_Visitas.evento='$estado' AND registro.compania='$compania' ORDER BY ingreso ASC ";

    if ($result = $conn->query($sql8)) {
        while ($row = $result->fetch_assoc()) {
            $field1name = $row[rut];
            $field2name = $row[dv];
            $field3name = $row[nombres];
            $field4name = $row[apellido_paterno];
            $field5name = $row[apellido_materno];
            $field6name = $row[motivo];
            $field7name = $row[autoriza];
            $field8name = $row[ingreso];
            $field9name = $row[temp_ingreso];
            echo '<tr style="color:#585858"> 
                 <td align=center>' . $field1name . '-' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				 <td align="center">' . $field9name . '</td> 
				
             </tr>';

        }
    }
}
?>	

<br>

</body>
</html>	
