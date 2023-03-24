<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
<script type="text/javascript"> 
			var clockID;
var yourTimeZoneFrom = -4.00; //time zone value where you are at

var d = new Date();  
//get the timezone offset from local time in minutes
var tzDifference = yourTimeZoneFrom * 60 + d.getTimezoneOffset();
//convert the offset to milliseconds, add to targetTime, and make a new Date
var offset = tzDifference * 60 * 1000;

function UpdateClock() {


	var tDate = new Date(new Date().getTime()+offset);
    var in_day = tDate.getDate();
	var in_month = tDate.getMonth() + 1;
	var in_year = tDate.getFullYear(); 
	
	var in_hours = tDate.getHours();
    var in_minutes=tDate.getMinutes();
    var in_seconds= tDate.getSeconds();

    if(in_minutes < 10)
        in_minutes = '0'+in_minutes;
    if(in_seconds<10)   
        in_seconds = '0'+in_seconds;
    if(in_hours<10) 
        in_hours = '0'+in_hours;

   document.getElementById('theTime').innerHTML = "" 
				   +  in_day + "/" 
	   			   + in_month + "/" 
					+ in_year + " "
	   				+ in_hours + ":" 
                   + in_minutes + ":" 
                   + in_seconds;

}
function StartClock() {
   clockID = setInterval(UpdateClock, 500);
}

function KillClock() {
  clearTimeout(clockID);
}
window.onload=function() {
  StartClock();
}
</script>





</head>
	<style>

		body {
            font-family: 'Verdana', sans-serif
	font-size:80%;
}

/* porcentaje base, solo en el body */
p {
    font-family: 'Verdana', sans-serif

    font-size:0.9em;
}
h1 {
    font-family: 'Verdana', sans-serif
    font-size:2em;
}
h2 {
    font-family: 'Verdana', sans-serif

    font-size:1.4em;
}
#pie {
    font-family: 'Verdana', sans-serif

    font-size:1.2em;
}
.epigrafes {
    font-family: 'Verdana', sans-serif

    font-size:1.1em;
}

/* fin de zona común a todas las resoluciones */
@media screen and (min-width:800px) {
	body {
        font-family: 'Verdana', sans-serif

        font-size:200%;
		/* ampliamos los textos si mide más de 800px */
	}
}

/* fin de la zona para más de 800px de ancho de pantalla */
@media screen and (min-width:1200px) {
	body {
        font-family: 'Verdana', sans-serif

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
            font-family: 'Verdana', sans-serif

            font-size: 20px;
}
	body {
    font-family: 'Verdana', sans-serif

                            h2 {
font-size: 18px;
}
 
h3 {
    font-family: 'Verdana', sans-serif

    font-size: 16px;
  }       
} 
	}
}

</style>




<body>

<?php
session_start();
header("Refresh: 60");
include('compania.php');
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


if (!isset($_SESSION["nivel"]) || (($_SESSION["nivel"] >= 1) )) {


    $respuesta = "SI";
    $estado = "Ingreso";

    /* INICIO TABLA*/


    echo '
  <table width="100%" border="1">
  <tbody>
    <tr>
      <td width="25%" valign="top">';
    include('vistaprimera.inc');
    echo '</td>
     
      <td width="25%" valign="top">';
    include('vistasegunda.inc');
    echo '</td>

      <td width="25%" valign="top">';
    include('vistatercera.inc');
    echo '</td>

      <td width="25%" valign="top">';
    include('vistacuarta.inc');
    echo '</td>
    </tr> 
	  
  </tbody>
</table>
<table border="0" style="height: 30px"><tr></tr></table>

  <table width="100%" border="1">
  <tbody>
    <tr>
      <td width="25%" valign="top">';
    include('vistaquinta.inc');
    echo '</td>
     
      <td width="25%" valign="top">';
    include('vistasexta.inc');
    echo '</td>

      <td width="25%" valign="top">';
    include('vistaseptima.inc');
    echo '</td>

      <td width="25%" valign="top">';
    include('vistaoctava.inc');
    echo '</td>
    </tr> 
	  
  </tbody>
</table>

<table border="0" style="height: 30px"><tr></tr></table>
  <table width="100%" border="1">

<td width="100%" valign="top">';
    include('salud.inc');
    echo '</td>

</table>

<table border="0" style="height: 30px"><tr></tr></table>
  <table width="100%" border="1">

<td width="100%" valign="top">';
    include('vistacg.inc');
    echo '</td>

</table>

';
}

?>	

<br>

</body>
</html>	
