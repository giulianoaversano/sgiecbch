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
      <td width="148"><img src="img/logo_cia.jpeg" width="148" height="135" alt=""/></td>
      <td width=""><p>&nbsp;</p>
      <H1 align=center style=color:darkgray><b></b>BOMBA HUECHURABA<b></b></h1>
      <h2 align=center style=color:darkslategray><strong>Registro Temperatura Ingreso/Egreso</strong></h2>
      <p>&nbsp;</p></td>
      <td width="147"><img src="img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
	<p><br>
</p>
<p>
  <?php
$username = "root";
$password = "Maru.2010";
$database = "registro_asistencia";
$mysqli = new mysqli("localhost", $username, $password, $database);

$query = "select * FROM nomina WHERE reg_cpo = $_POST[reg_cpo]";	
	
$reg_cpo = $_GET[reg_cpo];
$fecha_ingreso = date(Y-mm-dd);
$hora_ingreso = time();
$fecha_egreso = date(Y-mm-dd);
$temperatura = time();
$evento = $_GET[evento]
	
	$sql1 = "INSERT INTO registro (reg_cpo, fecha_ingreso, hora_ingreso, evento, temperatura) VALUES ($reg_cia, $fecha_ingreso, $hora_ingreso, $evento,$temperatura)";
	$sql2 = "INSERT INTO registro (reg_cia, fecha_egreso, hora_egreso, evento, temperatura) VALUES ($reg_cia, $fecha_egreso, $hora_egreso, $evento,$temperatura)";
	$result = $mysqli->query($sql);
	
	
	if ($evento = 'Ingreso') {$sql1 };
	if ($evento = 'Egreso') {$sql2};
		
	
		
	if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["reg_cia"];
        $field2name = $row["nombres"];
        $field3name = $row["apellido_paterno"];
		$field4name = $row["apellido_materno"];
		$field5name = $row["email"];

		
echo '<table style="background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px red solid;" cellspacing="2" cellpadding="2"> 
      <tr> 
      <td> Reg. Cia</font> </td> 
         <td>'.$field1name.'</td> 
		 
		 <tr>
		 <td>Nombres</font> </td> 
         <td>'.$field2name.'</td> 
		 
		 <tr>
		 <td> Apellido Paterno</font> </td> 
           <td>'.$field3name.'</td> 
		   
		  <tr>
		  <td> Apellido Materno</font> </td> 
          <td>'.$field4name.'</td> 
		  
		  <tr>
		  <td> e-mail</font> </td> 
		  <td>'.$field5name.'</td> 
		  </tr> 
		  
	 </table>';
		
	}
		
	}
	
		echo '<br><br> <table>
	<tr>
		  <td> Temperatura</font> </td> 
		  <td> '.$_POST[temperatura].'°C </font></td>
		  </tr>
		  <br><br>
		  <tr>
		  <td> Tipo Evento</font> </td> 
		  <td> '.$_POST[evento].'</font></td>
		  </tr>
		  </table>';

	$conn->close();
?>
</p>

	</body>
</html>	
