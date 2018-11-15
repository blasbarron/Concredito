<?php
require "conexion.php";


   function Formato_Fecha($Fecha)
    {
		date_default_timezone_set("America/Mexico_City"); 
        $time = new DateTime($Fecha);
        $date = $time->format('d-m-Y');
        $time = $time->format('H:i');
        return $date." ".$time;
    }


$opcion = 0;
$opcion = $_POST["opcion"];

if ($opcion == 'notificaciones') {
	$Consulta = $Conexion ->query("SELECT id_notificacion FROM notificacion");
	$fila = $Consulta->fetch_array();
	//var_dump($Consulta);
	if ($fila["id_notificacion"] != NULL){

		echo "1";
	}else
	{
		echo "0";
	}
}

?>