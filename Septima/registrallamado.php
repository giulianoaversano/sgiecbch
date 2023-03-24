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
	<style>	
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
	
	</style>
<body>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="148"><img src="img/logo_cia.png" width="148" height="135" alt=""/></td>
      <td width=""><p>&nbsp;</p>
      <h1 align=center style=color:darkgray><b></b>BOMBA HUECHURABA<b></b></h1>
<h2 align="center" style="color:darkslategray"><strong>Registro de Asistencia a Actos de Servicio</strong></h2>
		  <p>&nbsp;</p></td>
      <td width="147"><img src="img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
    </tr>
  </tbody>
</table>
</p>
	<p><br>
</p>
<p>

<form>
    <input type="submit" value="regresar" class="boton" formaction="index.php" name="regresar" id="regresar" >
</form>

<?php

include('dbconnection.php');


$reg_cpo1 = $_POST['reg_cpo1'];
$reg_cpo2 = $_POST['reg_cpo2'];
$reg_cpo3 = $_POST['reg_cpo3'];
$reg_cpo4 = $_POST['reg_cpo4'];
$reg_cpo5 = $_POST['reg_cpo5'];
$reg_cpo6 = $_POST['reg_cpo6'];
$reg_cpo7 = $_POST['reg_cpo7'];
$reg_cpo8 = $_POST['reg_cpo8'];
$reg_cpo9 = $_POST['reg_cpo9'];

$temp1 = $_POST['temp1'];
$temp2 = $_POST['temp2'];
$temp3 = $_POST['temp3'];
$temp4 = $_POST['temp4'];
$temp5 = $_POST['temp5'];
$temp6 = $_POST['temp6'];
$temp7 = $_POST['temp7'];
$temp8 = $_POST['temp8'];
$temp9 = $_POST['temp9'];


$temp1 = doubleval(str_replace(",",".",$temp1));
$temp2 = doubleval(str_replace(",",".",$temp2));
$temp3 = doubleval(str_replace(",",".",$temp3));
$temp4 = doubleval(str_replace(",",".",$temp4));
$temp5 = doubleval(str_replace(",",".",$temp5));
$temp6 = doubleval(str_replace(",",".",$temp6));
$temp7 = doubleval(str_replace(",",".",$temp7));
$temp8 = doubleval(str_replace(",",".",$temp8));
$temp9 = doubleval(str_replace(",",".",$temp9));


/*$date = $_POST[fecha];*/
$fecha = date('Y-m-d H:i:s', strtotime($_POST['fecha']));
$llamado = $_POST['llamado'];
$direccion = $_POST['direccion'];
$comuna = $_POST['comuna'];
$sanitizado = $_POST['sanitizado'];
$observaciones = $_POST['observaciones'];



$query1 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo1', '$llamado', '$fecha', '$direccion', '$comuna', '$temp1', '$sanitizado', '$observaciones')";
$query2 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo2', '$llamado', '$fecha', '$direccion', '$comuna', '$temp2', '$sanitizado', '$observaciones')";
$query3 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo3', '$llamado', '$fecha', '$direccion', '$comuna', '$temp3', '$sanitizado', '$observaciones')";
$query4 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo4', '$llamado', '$fecha', '$direccion', '$comuna', '$temp4', '$sanitizado', '$observaciones')";
$query5 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo5', '$llamado', '$fecha', '$direccion', '$comuna', '$temp5', '$sanitizado', '$observaciones')";
$query6 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo6', '$llamado', '$fecha', '$direccion', '$comuna', '$temp6', '$sanitizado', '$observaciones')";
$query7 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo7', '$llamado', '$fecha', '$direccion', '$comuna', '$temp7', '$sanitizado', '$observaciones')";
$query8 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo8', '$llamado', '$fecha', '$direccion', '$comuna', '$temp8', '$sanitizado', '$observaciones')";
$query9 = "INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo9', '$llamado', '$fecha', '$direccion', '$comuna', '$temp9', '$sanitizado', '$observaciones')";

echo 'Asistencia a llamado <b>' .$llamado. '</b> en<b> ' .$direccion. ' (' .$comuna. ')</b> generada para: <br>';

if (empty($_POST['reg_cpo1'])){
    die;
} if (!empty($_POST['reg_cpo1'])){
        $q1 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo1");
        while ($row = $q1->fetch_assoc()) {
            $n1 = $row['nombres'];
            $ap1 = $row['apellido_paterno'];
            $am1 = $row['apellido_materno'];
        }
        $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo1', '$llamado', '$fecha', '$direccion', '$comuna', '$temp1', '$sanitizado', '$observaciones')");
    echo $reg_cpo1 . ' - ' . $n1 . ' ' . $ap1 . ' ' . $am1. ' [Temp: ' . $temp1.']<br>';
} else {
	die;
	}

if (empty($_POST['reg_cpo2'])){
    die;
} if (!empty($_POST['reg_cpo2'])){
    $q2 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo2");
    while ($row = $q2->fetch_assoc()) {
        $n2 = $row['nombres'];
        $ap2 = $row['apellido_paterno'];
        $am2 = $row['apellido_materno'];
    }
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo2', '$llamado', '$fecha', '$direccion', '$comuna', '$temp2', '$sanitizado', '$observaciones')");
    echo $reg_cpo2 . ' - ' . $n2 . ' ' . $ap2 . ' ' . $am2. '[Temp: ' . $temp2.']<br>';

}else {
    die;
}

if (empty($_POST['reg_cpo3'])){
    die;
} if (!empty($_POST['reg_cpo3'])){
    $q3 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo3");
    while ($row = $q3->fetch_assoc()) {
        $n3 = $row['nombres'];
        $ap3 = $row['apellido_paterno'];
        $am3 = $row['apellido_materno'];
    }
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo3', '$llamado', '$fecha', '$direccion', '$comuna', '$temp3', '$sanitizado', '$observaciones')");
    echo $reg_cpo3 . ' - ' . $n3 . ' ' . $ap3 . ' ' . $am3. '[Temp: ' . $temp3.']<br>';

}else {
    die;
}

if (empty($_POST['reg_cpo4'])){
    die;
} if (!empty($_POST['reg_cpo4'])){
    $q4 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo4");
    while ($row = $q4->fetch_assoc()) {
        $n4 = $row['nombres'];
        $ap4 = $row['apellido_paterno'];
        $am4 = $row['apellido_materno'];
    }
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo4', '$llamado', '$fecha', '$direccion', '$comuna', '$temp4', '$sanitizado', '$observaciones')");
    echo $reg_cpo4 . ' - ' . $n4 . ' ' . $ap4 . ' ' . $am4. '[Temp: ' . $temp4.']<br>';

}else {
    die;
}

if (empty($_POST['reg_cpo5'])){
    die;
} if (!empty($_POST['reg_cpo5'])){
    $q5 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo5");
    while ($row = $q5->fetch_assoc()) {
        $n5 = $row['nombres'];
        $ap5 = $row['apellido_paterno'];
        $am5 = $row['apellido_materno'];
    }
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo5', '$llamado', '$fecha', '$direccion', '$comuna', '$temp5', '$sanitizado', '$observaciones')");
    echo $reg_cpo5 . ' - ' . $n5 . ' ' . $ap5 . ' ' . $am5. '[Temp: ' . $temp5.']<br>';

}

if (empty($_POST['reg_cpo6'])){
    die;
} if (!empty($_POST['reg_cpo6'])){
    $q6 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo6");
    while ($row = $q6->fetch_assoc()) {
        $n6 = $row['nombres'];
        $ap6 = $row['apellido_paterno'];
        $am6 = $row['apellido_materno'];
    }
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo6', '$llamado', '$fecha', '$direccion', '$comuna', '$temp6', '$sanitizado', '$observaciones')");
    echo $reg_cpo6 . ' - ' . $n6 . ' ' . $ap6 . ' ' . $am6. '[Temp: ' . $temp6.']<br>';
}else {
    die;
}

if (empty($_POST['reg_cpo7'])){
    die;
} if (!empty($_POST['reg_cpo7'])){
$q7 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo7");
while ($row = $q7->fetch_assoc()) {
    $n7 = $row['nombres'];
    $ap7 = $row['apellido_paterno'];
    $am7 = $row['apellido_materno'];
}
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo7', '$llamado', '$fecha', '$direccion', '$comuna', '$temp7', '$sanitizado', '$observaciones')");
    echo $reg_cpo7 . ' - ' . $n7 . ' ' . $ap7 . ' ' . $am7 . '[Temp: ' . $temp7.']<br>';

}else {
    die;
}

if (empty($_POST['reg_cpo8'])){
    die;
} if (!empty($_POST['reg_cpo8'])){
    $q8 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo8");
    while ($row = $q8->fetch_assoc()) {
        $n8 = $row['nombres'];
        $ap8 = $row['apellido_paterno'];
        $am8 = $row['apellido_materno'];

    }
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo8', '$llamado', '$fecha', '$direccion', '$comuna', '$temp8', '$sanitizado', '$observaciones')");
    echo $reg_cpo8 . ' - ' . $n8 . ' ' . $ap8 . ' ' . $am8. '[Temp: ' . $temp8.']<br>';

}else {
    die;
}

if (empty($_POST['reg_cpo9'])){
    die;
} if (!empty($_POST['reg_cpo9'])){
    $q9 = $conn->query("SELECT nombres,apellido_paterno,apellido_materno FROM nomina WHERE reg_cpo=$reg_cpo9");
    while ($row = $q8->fetch_assoc()) {
        $n9 = $row['nombres'];
        $ap9 = $row['apellido_paterno'];
        $am9 = $row['apellido_materno'];

}
    $conn->query("INSERT INTO Registro_Llamados (reg_cpo, llamado, fecha, direccion, comuna, temperatura, sanitizo, observaciones) VALUES ('$reg_cpo9', '$llamado', '$fecha', '$direccion', '$comuna', '$temp9', '$sanitizado', '$observaciones')");
    echo $reg_cpo9 . ' - ' . $n8 . ' ' . $ap9 . ' ' . $am9. '[Temp: ' . $temp9.']<br>';

}else {
    die;
}


	
	$conn->close();
	?>

	</body>
</html>

	