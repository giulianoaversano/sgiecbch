<head>
    <style>
        body{
            font-family: Verdana;
        }
    </style>
</head>

<?php
echo '

<form method="POST" >
    <table width="100%" height="">

        <tr>
            <td width="10%"></td>
            <td><input type="submit" name="bomberos" value="INGRESO/EGRESO" class="botonIN" formaction="Registro.php"></td>
            <td></td>
            <td><input type="submit" name="bomberos" value="ACTOS SERVICIO" class="botonAZUL" formaction="registro_llamados.html"></td>
            <td></td>
            <td> <input type="submit" name="visitas" value="VISITAS" class="botonOUT" formaction="visitas.php"></td>
             <td></td>
            <td><input type="submit" name="conductores" value="REG. CONDUCTORES" class="botonIN" formaction="RegistroConductores.php"></td>
             <td></td>
            <td><input type="submit" name="cambioestado" value="CAMBIO DE ESTADO" class="botonIN" formaction="estado.php"></td>
             <td></td>
            <td><input type="submit" name="cat" value=" VISTA C.A.T." class="botonIN" formaction="../CAT/"></td>

        </tr>
    </table>
</form>';
?>

