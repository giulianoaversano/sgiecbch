<html>
<head>
<meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>
<style>

    body {
        font-size:80%;
    }

    /* porcentaje base, solo en el body */
    p {
        font-size:0.9em;
    }
    h1 {
        font-size:2em;
    }
    h2 {
        font-size:1.4em;
    }
    #pie {
        font-size:1.2em;
    }
    .epigrafes {
        font-size:1.1em;
    }

    /* fin de zona común a todas las resoluciones */
    @media screen and (min-width:800px) {
        body {
            font-size:100%;
            /* ampliamos los textos si mide más de 800px */
        }
    }

    /* fin de la zona para más de 800px de ancho de pantalla */
    @media screen and (min-width:1200px) {
        body {
            font-size:75%;
            /* ampliamos más aún los textos si mide más de 1200px */
        }
    }

    /* fin de la zona para más de 1200px de ancho de pantalla */
</style>
<style>
    @media screen and (max-width:480px){
        body {
        h1 {
            font-size: 20px;
        }
        body {
        h2 {
            font-size: 18px;
        }

        h3 {
            font-size: 16px;
        }
    }
    }
    }

</style>
<!-- BOTONES -->
<style type="text/css" media="screen">
    .botonIN {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 30px; /*espacio alrededor texto*/
        background-color: #2E9B2F; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos**/
        font-size: 30px;
    }

    .botonOUT {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 30px; /*espacio alrededor texto*/
        background-color: #C0080B; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
        font-size: 30px;
    }


    .botonAZUL {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 30px; /*espacio alrededor texto*/
        background-color: #0930C5; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
        font-size: 30px;
    }

</style>
<body>
	
<?php

session_start();
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

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
    echo '<script> alert("Tu usuario no cuenta con el permiso para acceder a esta página");window.location = "../index.php" </script>';
    exit;
}

if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] >= 3)) {

// Consulta Ingresos
echo '
<br><br><br><br>
<form method="POST" name="#Ingresos">
	<table>
	<tr>
    <td> <label>
    <h3>Tipo de Reporte</h3>
    </label></td>
	  <td><h1 align="left">
	  <select  name="reporte" id="reporte">
  		<optgroup label="Seleccione">
	    <option value="ingreso_bomberos">Ingreso Bomberos</option>
    	<option value="ingreso_visitas">Ingreso Visitas</option>
    	<option value="conductores">Horas Conductores</option>
            <option value="llamados">Asistencia a Llamados</option>
    	
		  </optgroup>
			</select>
		    </h1></td>   
		   
	 </tr>
		<tr>
	 <td> <h3>Fecha Desde: </h3></td>
	  <td><h3><input name="fecha_desde" type="datetime-local" class="epigrafes" id="fecha_desde" size="30"></h3></td>
	  <td></td>
		<td><h3>Fecha Hasta: </h3></td>
	  <td><h3><input name="fecha_hasta" type="datetime-local" class="epigrafes" id="fecha_hasta" size="30"></h3></td>
	
	 
		<td><input type="submit" name="Ingresos" value="CONSULTAR" class=".boton" formaction="#Ingresos"></td>
</tr>
	</table>
</form>
	<br>';
$rut=$_POST['rut'];

    if (isset($_POST['Ingresos'])) {
        echo $_POST['reporte'];
        $fecha_desde = $_POST['fecha_desde'];
        $fecha_hasta = $_POST['fecha_hasta'];

        $sql_registro = "SELECT * FROM registro, nomina WHERE nomina.rut = registro.rut AND ingreso >= '$fecha_desde' AND ingreso <= '$fecha_hasta'";
        $sql_visitas = "SELECT * FROM Registro_Visitas WHERE Registro_Visitas.ingreso >= '$fecha_desde' AND Registro_Visitas.ingreso <= '$fecha_hasta'";
        $sql_llamados = "SELECT * FROM nomina, Registro_Llamados WHERE Registro_Llamados.reg_cpo = nomina.reg_cpo AND fecha >= '$fecha_desde' AND fecha <= '$fecha_hasta'";
        $sql_conductores = "SELECT * FROM nomina, Registro_Conductores WHERE Registro_Conductores.rut = nomina.rut AND ingreso >= '$fecha_desde' AND ingreso <= '$fecha_hasta'";


        if ($_POST['reporte'] === 'ingreso_bomberos') {
            echo $sql_registro;
            echo '
        <table border="1" cellspacing="2" width=100% cellpadding="2"> 
      <tr>
      <td colspan="7" align="center">Voluntario</td>
      <td colspan="3" align="center">Ingreso </td>
      <td colspan="2" align="center">Egreso</td>
</tr>
      <tr> 
        <td align="center"><b>RUT</b></td> 
        <td align="center"><b>Reg. Cpo.</b></td> 
        <td align="center"><b>Reg. Cia.</b></td> 
        <td align="center"><b>Compañía</b></td> 
        <td align="center"><b>Nombres</b></td> 
        <td align="center"><b>Apellido Paterno</b></td> 
        <td align="center"><b>Apellido Materno</b></td>
         
        <td align="center"><b>Ingreso</b></td> 
        <td align="center"><b>Temperatura de Ingreso</b></td>
        <td align="center"><b>DDJJ</b></td>
        
        <td align="center"><b>Egreso</b></td>
        <td align="center"><b>Tot. Hs.</b></td>

</tr>';
            if ($result = $conn->query($sql_registro)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["rut"];
                    $field2name = $row["reg_cpo"];
                    $field3name = $row["reg_cia"];
                    $field4name = $row["compania"];
                    $field5name = $row["nombres"];
                    $field6name = $row["apellido_paterno"];
                    $field7name = $row["apellido_materno"];
                    $field8name = $row["ingreso"];
                    $field9name = $row["temp_ingreso"];

                    $field24name = $row["s_ddjj"];

                    $field25name = $row["egreso"];
                    $field26name = $row["dv"];
                    $field27name = $row["toths"];



                    echo '<tr> 
                 <td align=center>' . $field1name . '-' . $field26name . '</td> 
                 <td>' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				  <td align="center">' . $field9name . '</td> 
				   <td align="center">' . $field24name . '</td> 
				   <td align="center">' . $field25name . '</td> 
				   <td align="center">' . $field27name . '</td> 
             </tr>';

                }
            }

            '</table>';
}


        if ($_POST['reporte'] === 'llamados') {
            echo '
        <table border="1" cellspacing="2" size=100% cellpadding="2"> 
      <tr> 
        <td align="center"><b>Fecha</b></td> 
        <td align="center"><b>Reg. Cpo.</b></td> 
        <td align="center"><b>Reg. Cia.</b></td> 
        <td align="center"><b>Llamado</b></td> 
        <td align="center"><b>Compañía</b></td> 
        <td align="center"><b>Nombres</b></td> 
        <td align="center"><b>Apellido Paterno</b></td> 
        <td align="center"><b>Apellido Materno</b></td> 
        <td align="center"><b>Dirección</b></td>
        <td align="center"><b>Comuna</b></td>
        <td align="center"><b>Temperatura</b></td>
        <td align="center"><b>Sanitizo</b></td>
        <td align="center"><b>Observaciones</b></td>

</tr>';
            if ($result = $conn->query($sql_llamados)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["fecha"];
                    $field2name = $row["rut"];
                    $field3name = $row["reg_cpo"];
                    $field4name = $row["reg_cia"];
                    $field5name = $row["llamado"];
                    $field6name = $row["compania"];
                    $field7name = $row["nombres"];
                    $field8name = $row["apellido_paterno"];
                    $field9name = $row["apellido_materno"];
                    $field10name = $row["direccion"];
                    $field11name = $row["comuna"];
                    $field12name = $row["temperatura"];
                    $field13name = $row["sanitizo"];
                    $field14name = $row["observaciones"];



                    echo '<tr> 
                 <td align=center>' . $field1name . '</td> 
                 <td>' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				 <td align="center">' . $field9name . '</td> 
				 <td align="center">' . $field10name . '</td> 
				 <td align="center">' . $field11name . '</td> 
				 <td align="center">' . $field12name . '</td> 
				 <td align="center">' . $field13name . '</td> 
				 <td align="center">' . $field14name . '</td> 
             </tr>';

                }
            }

            '</table>';
        }

        if ($_POST['reporte'] === 'ingreso_visitas') {
            echo '
        <table border="1" cellspacing="2" size=100% cellpadding="2"> 
      <tr> 
        <td align="center"><b>RUT</b></td> 
        <td align="center"><b>Nombres</b></td> 
        <td align="center"><b>Apellido Paterno</b></td> 
        <td align="center"><b>Apellido Materno</b></td> 
        <td align="center"><b>Teléfono</b></td> 
        <td align="center"><b>mail</b></td>
        <td align="center"><b>Ingreso</b></td>
        <td align="center"><b>Temp.  Ingreso</b></td>
        <td align="center"><b>Egreso</b></td>
        <td align="center"><b>Temp. Egreso</b></td>
        <td align="center"><b>Motivo</b></td>
        <td align="center"><b>Autorizó</b></td>

</tr>';
            if ($result = $conn->query($sql_visitas)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["rut"];
                    $field2name = $row["nombres"];
                    $field3name = $row["apellido_paterno"];
                    $field4name = $row["apellido_materno"];
                    $field5name = $row["telefono"];
                    $field6name = $row["email"];
                    $field7name = $row["ingreso"];
                    $field8name = $row["temp_ingreso"];
                    $field9name = $row["egreso"];
                    $field10name = $row["temp_egreso"];
                    $field11name = $row["motivo"];
                    $field12name = $row["autoriza"];



                    echo '<tr> 
                 <td align=center>' . $field1name . '</td> 
                 <td>' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				  <td align="center">' . $field9name . '</td> 
				   <td align="center">' . $field10name . '</td> 
				   <td align="center">' . $field11name . '</td> 
				   <td align="center">' . $field12name . '</td> 
             </tr>';

                }
            }

            '</table>';
}
        if ($_POST['reporte'] === 'conductores') {
            echo '
        <table border="1" cellspacing="2" width="100%" 100% cellpadding="2"> 
      <tr> 
      <td colspan="6"><p align="center" style="font-size: 14px;background: #336699; color: white">Registro Horas Conductor</p></td>
      </tr>
      <tr>
        <td align="center"><b>RUT</b></td> 
        <td align="center"><b>Compañía</b></td> 
        <td align="center"><b>Conductor</b></td> 
        <td align="center"><b>Ingreso</b></td>
        <td align="center"><b>Egreso</b></td>
        <td align="center"><b>Horas</b></td>

</tr>';
            if ($result = $conn->query($sql_conductores)) {
                while ($row = $result->fetch_assoc()) {
                    $field2name = $row["rut"];
                    $field3name = $row["compania"];
                    $field4name = $row["nombres"];
                    $field5name = $row["apellido_paterno"];
                    $field6name = $row["apellido_materno"];
                    $field7name = $row["ingreso"];
                    $field8name = $row["egreso"];
                    $field9name = $row["horas"];
                    $field10name = $row["dv"];

                    echo '<tr> 
                 <td align="center">' . $field2name . '-' . $field10name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . ' ' . $field5name . ' ' . $field6name . ' </td> 
                 <td align="center" align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				 <td align="center">' . $field9name . '</td> 
             </tr>';

                }
            }

            '</table>';
        }
        
        
        
        
        
        
        echo '<br><br><table><tr>
<td></td>
	<td> *** Reporte exportado entre ' . $fecha_desde . ' y ' . $fecha_hasta . '.</td>	
	</tr></table><br>';
    }
    }

// CONSULTA NIVEL 2 (SOLO POR COMPAÑIA)

if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] === 2)) {

// Consulta Ingresos
    echo '
<br><br><br><br>
<form method="POST" name="#Ingresos">
	<table>
	<tr>
    <td> <label>
    <h3>Tipo de Reporte</h3>
    </label></td>
	  <td><h1 align="left">
	  <select  name="reporte" id="reporte">
  		<optgroup label="Seleccione">
	    <option value="ingreso_bomberos">Ingreso Bomberos</option>
    	<option value="ingreso_visitas">Ingreso Visitas</option>
    	<option value="conductores">Horas Conductores</option>
            <option value="llamados">Asistencia a Llamados</option>
    	
		  </optgroup>
			</select>
		    </h1></td>   
		   
	 </tr>
		<tr>
	 <td> <h3>Fecha Desde: </h3></td>
	  <td><h3><input name="fecha_desde" type="datetime-local" class="epigrafes" id="fecha_desde" size="30"></h3></td>
	  <td></td>
		<td><h3>Fecha Hasta: </h3></td>
	  <td><h3><input name="fecha_hasta" type="datetime-local" class="epigrafes" id="fecha_hasta" size="30"></h3></td>
		<td><input type="submit" name="Ingresos" value="CONSULTAR" class=".boton" formaction="#Ingresos"></td>
</tr>
	</table>
</form>
	<br>';

    if (isset($_POST['Ingresos'])) {
        echo $_POST['reporte'];
        $fecha_desde = $_POST['fecha_desde'];
        $fecha_hasta = $_POST['fecha_hasta'];


        $sql_registro = "SELECT * FROM nomina, registro WHERE registro.rut = nomina.rut AND ingreso >= '$fecha_desde' AND ingreso <= '$fecha_hasta' AND registro.compania = '$usrcia'";
        $sql_visitas = "SELECT * FROM Registro_Visitas WHERE Registro_Visitas.ingreso >= '$fecha_desde' AND Registro_Visitas.ingreso <= '$fecha_hasta' AND Registro_Visitas.compania = '$usrcia'";
        $sql_llamados = "SELECT * FROM nomina, Registro_Llamados WHERE Registro_Llamados.reg_cpo = nomina.reg_cpo AND fecha >= '$fecha_desde' AND fecha <= '$fecha_hasta' AND Registro_Llamados.   compania = '$usrcia'";
        $sql_conductores = "SELECT * FROM nomina, Registro_Conductores WHERE Registro_Conductores.rut = nomina.rut AND ingreso >= '$fecha_desde' AND ingreso <= '$fecha_hasta' AND Registro_Conductores.compania = '$usrcia'";


        if ($_POST['reporte'] === 'ingreso_bomberos') {
            echo ' <br>
        <table border="1" cellspacing="2" width="" 100% cellpadding="2"> 
      <tr>
      <td colspan="7" align="center">Voluntario</td>
      <td colspan="3" align="center">Ingreso </td>
      <td colspan="2" align="center">Egreso</td>
</tr>
      <tr> 
        <td align="center"><b>RUT</b></td> 
        <td align="center"><b>Reg. Cpo.</b></td> 
        <td align="center"><b>Reg. Cia.</b></td> 
        <td align="center"><b>Compañía</b></td> 
        <td align="center"><b>Nombres</b></td> 
        <td align="center"><b>Apellido Paterno</b></td> 
        <td align="center"><b>Apellido Materno</b></td>
         
        <td align="center"><b>Ingreso</b></td> 
        <td align="center"><b>Temperatura de Ingreso</b></td>
        <td align="center"><b>DDJJ</b></td>
        
        <td align="center"><b>Egreso</b></td>
        <td align="center"><b>Tot. Hs.</b></td>

</tr>';
            if ($result = $conn->query($sql_registro)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["rut"];
                    $field2name = $row["reg_cpo"];
                    $field3name = $row["reg_cia"];
                    $field4name = $row["compania"];
                    $field5name = $row["nombres"];
                    $field6name = $row["apellido_paterno"];
                    $field7name = $row["apellido_materno"];

                    $field8name = $row["ingreso"];
                    $field9name = $row["temp_ingreso"];
                    $field24name = $row["s_ddjj"];

                    $field25name = $row["egreso"];
                    $field26name = $row["toths"];



                    echo '<tr> 
                 <td align=center>' . $field1name . '</td> 
                 <td>' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				  <td align="center">' . $field9name . '</td> 
				   <td align="center">' . $field24name . '</td> 
				   <td align="center">' . $field25name . '</td> 
				   <td align="center">' . $field26name . '</td> 
             </tr>';

                }
            }

            '</table>';
        }


        if ($_POST['reporte'] === 'llamados') {
            echo '
        <table border="1" cellspacing="2" size=100% cellpadding="2"> 
      <tr> 
        <td align="center"><b>Fecha</b></td> 
        <td align="center"><b>Reg. Cpo.</b></td> 
        <td align="center"><b>Reg. Cia.</b></td> 
        <td align="center"><b>Llamado</b></td> 
        <td align="center"><b>Compañía</b></td> 
        <td align="center"><b>Nombres</b></td> 
        <td align="center"><b>Apellido Paterno</b></td> 
        <td align="center"><b>Apellido Materno</b></td> 
        <td align="center"><b>Dirección</b></td>
        <td align="center"><b>Comuna</b></td>
        <td align="center"><b>Temperatura</b></td>
        <td align="center"><b>Sanitizo</b></td>
        <td align="center"><b>Observaciones</b></td>

</tr>';
            if ($result = $conn->query($sql_llamados)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["fecha"];
                    $field2name = $row["rut"];
                    $field3name = $row["reg_cpo"];
                    $field4name = $row["reg_cia"];
                    $field5name = $row["llamado"];
                    $field6name = $row["compania"];
                    $field7name = $row["nombres"];
                    $field8name = $row["apellido_paterno"];
                    $field9name = $row["apellido_materno"];
                    $field10name = $row["direccion"];
                    $field11name = $row["comuna"];
                    $field12name = $row["temperatura"];
                    $field13name = $row["sanitizo"];
                    $field14name = $row["observaciones"];



                    echo '<tr> 
                 <td align=center>' . $field1name . '</td> 
                 <td>' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				 <td align="center">' . $field9name . '</td> 
				 <td align="center">' . $field10name . '</td> 
				 <td align="center">' . $field11name . '</td> 
				 <td align="center">' . $field12name . '</td> 
				 <td align="center">' . $field13name . '</td> 
				 <td align="center">' . $field14name . '</td> 
             </tr>';

                }
            }

            '</table>';
        }

        if ($_POST['reporte'] === 'ingreso_visitas') {
            echo '
        <table border="1" cellspacing="2" size=100% cellpadding="2"> 
      <tr> 
        <td align="center"><b>RUT</b></td> 
        <td align="center"><b>Nombres</b></td> 
        <td align="center"><b>Apellido Paterno</b></td> 
        <td align="center"><b>Apellido Materno</b></td> 
        <td align="center"><b>Teléfono</b></td> 
        <td align="center"><b>mail</b></td>
        <td align="center"><b>Ingreso</b></td>
        <td align="center"><b>Temp.  Ingreso</b></td>
        <td align="center"><b>Egreso</b></td>
        <td align="center"><b>Temp. Egreso</b></td>
        <td align="center"><b>Motivo</b></td>
        <td align="center"><b>Autorizó</b></td>

</tr>';
            if ($result = $conn->query($sql_visitas)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["rut"];
                    $field2name = $row["nombres"];
                    $field3name = $row["apellido_paterno"];
                    $field4name = $row["apellido_materno"];
                    $field5name = $row["telefono"];
                    $field6name = $row["email"];
                    $field7name = $row["ingreso"];
                    $field8name = $row["temp_ingreso"];
                    $field9name = $row["egreso"];
                    $field10name = $row["temp_egreso"];
                    $field11name = $row["motivo"];
                    $field12name = $row["autoriza"];



                    echo '<tr> 
                 <td align=center>' . $field1name . '</td> 
                 <td>' . $field2name . '</td> 
                 <td>' . $field3name . '</td> 
                 <td>' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				  <td align="center">' . $field9name . '</td> 
				   <td align="center">' . $field10name . '</td> 
				   <td align="center">' . $field11name . '</td> 
				   <td align="center">' . $field12name . '</td> 
             </tr>';

                }
            }

            '</table>';
        }
        if ($_POST['reporte'] === 'conductores') {
            echo '
        <table border="1" cellspacing="2" width="100%" 100% cellpadding="2"> 
      <tr> 
      <td colspan="6"><p align="center" style="font-size: 14px;background: #336699; color: white">Registro Horas Conductor</p></td>
      </tr>
      <tr>
        <td align="center"><b>RUT</b></td> 
        <td align="center"><b>Compañía</b></td> 
        <td align="center"><b>Conductor</b></td> 
        <td align="center"><b>Ingreso</b></td>
        <td align="center"><b>Egreso</b></td>
        <td align="center"><b>Horas</b></td>

</tr>';
            if ($result = $conn->query($sql_conductores)) {
                while ($row = $result->fetch_assoc()) {
                    $field2name = $row["rut"];
                    $field3name = $row["compania"];
                    $field4name = $row["nombres"];
                    $field5name = $row["apellido_paterno"];
                    $field6name = $row["apellido_materno"];
                    $field7name = $row["ingreso"];
                    $field8name = $row["egreso"];
                    $field9name = $row["horas"];

                    echo '<tr> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . ' ' . $field5name . ' ' . $field6name . ' </td> 
                 <td align="center" align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				 <td align="center">' . $field9name . '</td> 
             </tr>';

                }
            }

            '</table>';
        }






        echo '<br><br><table><tr>
<td></td>
	<td> *** Reporte exportado entre ' . $fecha_desde . ' y ' . $fecha_hasta . '.</td>	
	</tr></table><br>';
    }
}



?>
</body>
</html>