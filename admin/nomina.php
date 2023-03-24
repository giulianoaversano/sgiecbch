<html>
<head>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
</head>
<style type="text/css" media="screen">
    .boton {
        border: 1px solid #2e518b; /*anchura, estilo y color borde*/
        padding: 10px; /*espacio alrededor texto*/
        background-color: #2e518b; /*color botón*/
        color: #ffffff; /*color texto*/
        text-decoration: none; /*decoración texto*/
        text-transform: uppercase; /*capitalización texto*/
        font-family: 'Helvetica', sans-serif; /*tipografía texto*/
        border-radius: 50px; /*bordes redondos*/
    }
</style>

<table width="100%" border="0">
    <tbody>
    <tr>
        <td width="147"><img src="../img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
        <td width=""><p>&nbsp;</p>
            <H1 align=center style=color:darkgray><b>CUERPO DE BOMBEROS DE CONCHALÍ-HUECHURABA</b></h1>
            <h2 align=center style=color:darkslategray><strong>Registro Temperatura Ingreso/Egreso</strong></h2>
            <p>&nbsp;</p></td>
    </tr>
    </tbody>
</table>
<h1 align=center><u>NÓMINA  DE PERSONAL ACTIVO</u> </h1><br>
<p align="right"> <a align="right" href="logout.php"><b>->salir<-</b></a></p>
<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

echo '
<form method="POST" action="#mostrar">
<table>
<tr>
<td style="vertical-align: central;">
<h3 align="center"><label>Seleccione Compañía</label></h3>
 <select  name="compania" id="compania">
  		<optgroup label="Seleccione">
	    <option value="Comandancia">Comandancia</option>
	    <option value="Primera">Primera</option>
    	<option value="Segunda">Segunda</option>
		<option value="Tercera">Tercera</option>
		<option value="Cuarta">Cuarta</option>
		<option value="Quinta">Quinta</option>
		<option value="Sexta">Sexta</option>
		<option value="Septima">Séptima</option>
		<option value="Octava">Octava</option>
		<option value="Todas">Todas</option>
		  </optgroup>
			</select>
</td>
<td style="vertical-align:bottom;"><input type="submit" name="mostrar" value="Mostrar" formaction=#mostrar></td>
</tr>
</table>
</form>
';
?>

<?php

include('dbconnection.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if (isset($_POST['mostrar'])) {
    $compania = $_POST['compania'];

    echo '<p><b> Compañía Consultada:</b> ' . "$compania" . '</p>';
    echo '<table border="1" cellspacing="2" width=100% cellpadding="2"> 
      <tr> 
        <td align="center"> <b>RUT</b></font> </td> 
        <td align="center"> <b>Reg. Cpo.</b></font> </td> 
        <td align="center"> <b>Reg. Cia.</b></font> </td> 
		<td align="center"> <b>Compañía</b></font> </td> 
        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>e-mail</b></font> </td> 
		<td align="center"> <b>Cargo</font> </b></td> 
        <td align="center"> <b>Estado</font> </b></td> 
        <td align="center"> <b>Oficial</font> </b></td> 
        <td align="center"> <b>Conductor</font> </b></td> 

      </tr>';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql3 = "SELECT * FROM nomina WHERE compania = '$compania' order by reg_cia ASC";
    $sql4 = "SELECT * FROM nomina order by compania";

    if ($compania == "Todas") {
        if ($result = $conn->query($sql4)) {
            while ($row = $result->fetch_assoc()) {
                $field1name = $row['rut'];
                $field2name = $row['reg_cpo'];
                $field3name = $row['reg_cia'];
                $field4name = $row['compania'];
                $field5name = $row['nombres'];
                $field6name = $row['apellido_paterno'];
                $field7name = $row['apellido_materno'];
                $field8name = $row['email'];
                $field9name = $row['cargo'];
                $field10name = $row['status'];
                $field11name = $row['oficial'];
                $field12name = $row['conductor'];
                $field13name = $row['dv'];

                echo '<tr> 
                 <td align=center>' . $field1name . '-' . $field13name . '</td> 
                 <td align=center>' . $field2name . '</td> 
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
    } else {
        if ($compania != "Todas") {
            if ($result = $conn->query($sql3)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row['rut'];
                    $field2name = $row['reg_cpo'];
                    $field3name = $row['reg_cia'];
                    $field4name = $row['compania'];
                    $field5name = $row['nombres'];
                    $field6name = $row['apellido_paterno'];
                    $field7name = $row['apellido_materno'];
                    $field8name = $row['email'];
                    $field9name = $row['cargo'];
                    $field10name = $row['status'];
                    $field11name = $row['oficial'];
                    $field12name = $row['conductor'];
                    $field13name = $row['dv'];

                    echo '<tr> 
                 <td align=center>' . $field1name . '-' . $field13name . '</td> 
                 <td align=center>' . $field2name . '</td> 
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
        }
    }
}


#$result = mysql_query("SELECT count(*) from Personal_Presente");


?>
</body>
</html>	
