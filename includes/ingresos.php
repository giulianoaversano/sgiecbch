<?php
echo $_POST['reporte'];
$fecha_desde = $_POST['fecha_desde'];
$fecha_hasta = $_POST['fecha_hasta'];

$sql_registro = "SELECT * FROM registro, nomina WHERE nomina.rut = registro.rut AND ingreso >= '$fecha_desde' AND ingreso <= '$fecha_hasta'";
$sql_visitas = "SELECT * FROM Registro_Visitas WHERE Registro_Visitas.ingreso >= '$fecha_desde' AND Registro_Visitas.ingreso <= '$fecha_hasta'";
$sql_llamados = "SELECT * FROM nomina, Registro_Llamados WHERE Registro_Llamados.reg_cpo = nomina.reg_cpo AND fecha >= '$fecha_desde' AND fecha <= '$fecha_hasta'";
$sql_conductores = "SELECT * FROM nomina, Registro_Conductores WHERE Registro_Conductores.rut = nomina.rut AND ingreso >= '$fecha_desde' AND ingreso <= '$fecha_hasta'";


if ($_POST['reporte'] === 'ingreso_bomberos') {
    echo '
        <table border="1" cellspacing="2" size=100% cellpadding="2"> 
      <tr>
      <td colspan="7" align="center">Voluntario</td>
      <td colspan="2" align="center">Ingreso </td>
      <td colspan="15" align="center">Síntomas Ultimas 24hs</td>
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
        
        <td align="center"><b>Ninguno</b></td>
        <td align="center"><b>Fiebre</b></td>
        <td align="center"><b>Olfato</b></td>
        <td align="center"><b>Gusto</b></td>
        <td align="center"><b>Tos</b></td>
        <td align="center"><b>Congestión</b></td>
        <td align="center"><b>Taquipnea</b></td>
        <td align="center"><b>D. Garganta</b></td>
        <td align="center"><b>D. Muscular</b></td>
        <td align="center"><b>Fatiga</b></td>
        <td align="center"><b>D. Pecho</b></td>
        <td align="center"><b>Diarrea</b></td>
        <td align="center"><b>Apetito</b></td>
        <td align="center"><b>D. Cabeza</b></td>
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
    ?>