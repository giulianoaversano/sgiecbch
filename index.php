<head>
    <?php include('includes/title.inc');?>
    <style>
        .center{
            text-align: center;
            color: ghostwhite;

        }
        body{
            background-image: url('img/logo_cuerpo.png');
            background-repeat: no-repeat;
            background-position: center;
            font-family: Verdana;

        }
    </style>
</head>
<body>
<div class="container">



<?php

session_start();
include ('compania.php');
include('header_home.php');
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");

}



$user = "SELECT compania FROM Users where username='$_SESSION[username]'";
if ($resuser = $conn->query($user)) {
    while ($ruser = $resuser->fetch_assoc()) {
        $usrcia = $ruser['compania'];
    }
}


    echo '<h1 align="center" style="color: #005cbf">Sistema de Gestión de Cuarteles</h1><br>';

if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] < 1 )) {
    echo '<script> alert("Tu usuario no cuenta con el permiso para acceder a esta página");window.location = "../index.php" </script>';
    exit;
}

if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] > 0 AND $_SESSION["nivel"] < 2)) {

    $companias = $conn->query("SELECT * FROM companias");

    echo '
<form action="redirect" method="get"></form>
<table><tr>
<td style="margin: 15px"><h1><b>Seleccione la Compañía</b></h1></td>
   	<td><h1><select style="height: 30px; font-size: 16px" name="compania" onchange="location = this.value;">
  		<optgroup label="Seleccione">
  		<option selected=""></option>
	    ';
    while ($setcia = mysqli_fetch_array($companias)) {
        echo '<option value="' . $setcia["compania"] . '">' . $setcia["compania"] . '</option>';
    }
    echo '
    <option value="CAT">CAT</option>

		  </optgroup>
			</select></h1>
			    </td>

			        </tr>
			            </table>
			                </form>
			                
			              
			                
			                
			                
			                ';
}

if(!isset($_SESSION["nivel"]) || $_SESSION["nivel"] > 1) {

    $companias = $conn->query("SELECT * FROM companias");

    echo '
<form action="redirect" method="get"></form>
<table><tr>
<td style="margin: 15px"><h1><b>Seleccione la Compañía</b></h1></td>
   	<td><h1><select style="height: 30px; font-size: 16px" name="compania" onchange="location = this.value;">
  		<optgroup label="Seleccione">
  		<option selected=""></option>
	    ';
    while ($setcia = mysqli_fetch_array($companias)) {
        echo '<option value="' . $setcia["compania"] . '">' . $setcia["compania"] . '</option>';
    }
    echo '
    <option value="CAT">CAT</option>
    <option value="admin">Gestión Administrativa</option>

		  </optgroup>
			</select></h1>
			    </td>

			        </tr>
			            </table>
			                </form>
			                
			              
			                
			                
			                
			                ';
}

?>
</div>
</body>