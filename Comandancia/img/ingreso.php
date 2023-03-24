<html>
<head>
<meta charset="UTF-8">
<title>Bomba Huechuraba - Ingreso/Egreso</title>
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
      <td width="148"><img src="img/logo_cia.png" width="148" height="135" alt=""/></td>
      <td width=""><p>&nbsp;</p>
      <H1 align=center style=color:darkgray><b></b>BOMBA HUECHURABA<b></b></h1>
      <h2 align=center style=color:darkslategray><strong>Registro Tempratura Ingreso/Egreso</strong></h2>
      <p>&nbsp;</p></td>
      <td width="147"><img src="img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
    </tr>
  </tbody>
</table>

<h2 align="center" style="color:blue"><b>INGRESO</b></h2></p>
	<p><br>
</p>
<p>
  <?php
include('dbconnection.php');


	

$query = "select * FROM nomina WHERE reg_cpo = $_POST[reg_cpo]";	

	
$reg_cia = $_post[reg_cpo];
$fecha_ingreso = date("Y-m-d");
$temperatura = $_POST[temperatura];
$temperatura = doubleval(str_replace(",",".",$temperatura));
$date = new DateTime("now", new DateTimeZone('America/Santiago') );
$hora_ingreso = $date->format('H:i');
	
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "INSERT INTO registro (reg_cpo, fecha_ingreso, hora_ingreso, evento, temp_ingreso) VALUES ($_POST[reg_cpo], '$fecha_ingreso', '$hora_ingreso', 'Ingreso', $temperatura)";
	
	if ($conn->query($sql) === TRUE or die($conn->error)){
  		echo "Su <b>INGRESO</b> ha sido Registrado correctamente.<br>
		<table>
		<tr>
		  <td><font color=blue face=Arial>Temperatura Registrada</font> </td> 
		  <td><font color=blue face=Arial> $_POST[temperatura]°C </font></td>
		  </tr>
		  </table> <br><br> ";
	} else {
	    echo "Error: Por Favor valide la información suministrada. <br><b>La operación no ha sido guardada</b><br>";
};
		
	if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["reg_cpo"];
        $field2name = $row["compania"];       
		$field3name = $row["nombres"];
        $field4name = $row["apellido_paterno"];
		$field5name = $row["apellido_materno"];
		$field6name = $row["email"];

		
echo '<table style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px red solid;" cellspacing="2" cellpadding="2"> 
      <tr> 
      <td> <font face="Arial">Reg. Cpo.</font> </td> 
         <td>'.$field1name.'</td> 
		 
		  <tr>
		  <td> <font face="Arial">Compañía</font> </td> 
		  <td>'.$field2name.'</td> 
		  </tr> 
		 
		 <tr>
		 <td><font face="Arial">Nombres</font> </td> 
         <td>'.$field3name.'</td> 
		 
		 <tr>
		 <td> <font face="Arial">Apellido Paterno</font> </td> 
           <td>'.$field4name.'</td> 
		   
		  <tr>
		  <td> <font face="Arial">Apellido Materno</font> </td> 
          <td>'.$field5name.'</td> 
		  
		  <tr>
		  <td> <font face="Arial">e-mail</font> </td> 
		  <td>'.$field6name.'</td> 
		  </tr> 
		  
	 </table>';
		
	}
		
	}
	

	# ACTUALIZAR TABLERO
	
	
	if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
	}
	
	$sql_dashboard = "update Personal_Presente set presente = 'SI' where reg_cpo = '$_POST[reg_cpo]'";
	
	if ($conn->query($sql_dashboard) === TRUE) {
  		echo "";
	} else {
  echo "Error: " . $sql_dashboard . "<br>" . $conn->error;
};
	$conn->close();
	
	?>

	
	
	
	
	</body>
</html>	
