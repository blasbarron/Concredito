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

?>