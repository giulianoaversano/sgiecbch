<head>
    <style>
        body{
            font-family: Verdana;
        }
    </style>
</head>

<?php
echo '<table border="1" style="border-collapse:collapse; border: 1px solid black" cellspacing="2" width="100%" cellpadding="2"> 
      <tr style="background-color:dodgerblue">
	    <td colspan="8"><p style="color:white" align="center"><b>OFICIALES DE MANDO</b></p>
		</tr>
		<tr style="color:#585858">
        <td align="center"> <b>Reg. Gral.</b></font> </td> 
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

#$sql = "SELECT * FROM Personal_Presente where presente = '$respuesta'";

// $sql2="select *,(
//select CONCAT(fecha_ingreso,' ',hora_ingreso) from registro r where r.reg_cpo = pp.reg_cpo  order by 1 desc limit 1
//) AS fecha from Personal_Presente pp where pp.presente='$respuesta'";

$sql3 = "SELECT * FROM registro,nomina WHERE registro.evento='$estado' AND registro.rut = nomina.rut AND (oficial='Si' OR ofgral='Si') AND registro.compania='$compania' ORDER BY clave ASC";


if ($result = $conn->query($sql3)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row[reg_cpo];
        $field2name = $row[compania];
        $field3name = $row[nombres];
        $field4name = $row[apellido_paterno];
        $field5name = $row[apellido_materno];
        $field6name = $row[cargo];
        $field7name = $row[ingreso];
        $field8name = $row[estado];

        echo '<tr style="color:#585858"> 
                 <td align="center">' . $field1name . '</td> 
                 <td align="center">' . $field2name . '</td> 
                 <td align="center">' . $field3name . '</td> 
                 <td align="center">' . $field4name . '</td> 
                 <td align="center">' . $field5name . '</td> 
				 <td align="center">' . $field6name . '</td> 
				 <td align="center">' . $field7name . '</td> 
				 <td align="center">' . $field8name . '</td> 
				
             </tr>';

    }
}
echo '</table>';
echo '<br>';
echo '<hr class="lineaverde">';
echo '<br>';
?>