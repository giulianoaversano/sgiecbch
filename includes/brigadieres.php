<head>
    <style>
        body{
            font-family: Verdana;
        }
    </style>
</head>
<?php
echo '		<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="" width="100%" cellpadding=""> 
            <tr style="background-color:darkorange">
	    <td colspan="8"><p align="center" style="color:#22262a"><b>BRIGADIERES</b></p>
		</tr>
	  <tr style="color:#585858"> 
        <td align="center"> <b>RUT</b></font> </td> 
        <td align="center"> <b>Nombres</b></font> </td> 
        <td align="center"> <b>Apellido Paterno</b></font> </td> 
        <td align="center"> <b>Apellido Materno</b></font> </td> 
        <td align="center"> <b>Ingreso</font> </b></td> 
       

      </tr>';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ingreso = "Ingreso";
$disp = "Si";

$querydisp = "SELECT * FROM registro,nomina WHERE registro.evento='$ingreso' AND registro.rut = nomina.rut AND cargo='Brigadier' AND registro.compania = '$compania' ORDER BY nomina.clave AND registro.rut DESC";

if ($result = $conn->query($querydisp)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row['rut'];
        $field2name = $row['nombres'];
        $field3name = $row['apellido_paterno'];
        $field4name = $row['apellido_materno'];
        $field5name = $row['dv'];
        $field6name = $row['ingreso'];

        echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '-'.$field5name.'</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				
             </tr>';

    }
}
echo '</table>';
echo '<br>';
echo '<hr class="lineaverde">';
echo '<br>';
?>