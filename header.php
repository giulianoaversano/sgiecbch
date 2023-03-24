<head>
<style>
    body{
        font-family: Verdana;
 }
</style>
</head>
<?php
session_start();

include ('clock.php');
include ('dbconnection.php');
include ('compania.php');
include('../dbconnection.php');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
if ($compania!="Comandancia"){
echo'
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="148"><img src="../img/'.$compania.'.png" width="148" height="135" alt=""/></td>
      <td width="">
      <h2 align=center style=color:darkgray><b></b>CUERPO DE BOMBEROS CONCHALÍ-HUECHURABA<b></b></h2>
      <h3 align=center style=color:darkslategray><strong>Registro Temperatura Ingreso/Egreso</strong></h3>
     
      </td>
		<td><p align="right">Usuario Registrado: <b>' . htmlspecialchars($_SESSION["username"]). '</b> (' . htmlspecialchars($_SESSION["nombres"]) . ' ' . htmlspecialchars($_SESSION["apellido_paterno"]) . ' '. htmlspecialchars($_SESSION["apellido_materno"]).')</p>
<p align="right">Nivel: <b>' . htmlspecialchars($_SESSION["nivel"]).'</b></p>
<p align="right" style="color: #d62516"> <a style="color: #d62516;" href="../logout.php"> <<< Salir >>> </b></a></p><p align="center">Hora Actual:<br> <span id="datetime"></span>
			<span id="theTime" ></span>
			
			</p> </td>
      <td width="147"><img src="../img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
    </tr>
  </tbody>
</table>';
}else{
    echo'
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="147"><img src="../img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
      <td width="">
      <h2 align=center style=color:darkgray><b></b>CUERPO DE BOMBEROS CONCHALÍ-HUECHURABA<b></b></h2>
      <h3 align=center style=color:darkslategray><strong>Registro Temperatura Ingreso/Egreso</strong></h3>
     
      </td>
		<td><p align="right">Usuario Registrado: <b>' . htmlspecialchars($_SESSION["username"]). '</b> (' . htmlspecialchars($_SESSION["nombres"]) . ' ' . htmlspecialchars($_SESSION["apellido_paterno"]) . ' '. htmlspecialchars($_SESSION["apellido_materno"]).')</p>
<p align="right">Nivel: <b>' . htmlspecialchars($_SESSION["nivel"]).'</b></p>
<p align="right" style="color: #d62516"> <a style="color: #d62516;" href="../logout.php"> <<< Salir >>> </b></a></p><p align="center">Hora Actual:<br> <span id="datetime"></span>
			<span id="theTime" ></span>
			
			</p> </td>
    </tr>
  </tbody>
</table>';


}
?>

