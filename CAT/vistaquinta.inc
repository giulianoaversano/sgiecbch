<?php
session_start();
header("Refresh: 60");
include('dbconnection.php');


$respuesta = "SI";
$estado="Ingreso";
$compania="Quinta";

/* INICIO TABLA*/

include('tablas.inc');


?>