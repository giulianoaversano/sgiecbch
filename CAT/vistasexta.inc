<?php
session_start();
header("Refresh: 60");
include('dbconnection.php');


$respuesta = "SI";
$estado="Ingreso";
$compania="Sexta";

/* INICIO TABLA*/

include('tablas.inc');


?>