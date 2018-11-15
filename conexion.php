<?php
$Conexion = new mysqli("localhost", "safwin", "trm000", "proyecto_blas");
$Conexion->set_charset("utf8");


if (mysqli_connect_errno())
{
    echo "<p class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>ERROR AL CONECTAR A BASE DE DATOS </b></p>";
}
?>