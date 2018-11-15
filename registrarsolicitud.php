<?php  

session_start();
require "conexion.php";
//var_dump($_POST);
//var_dump($_SESSION);
$opcion = $_POST["opcion"];



$id_usuario = $_SESSION["cliente"];
$idCliente = $_POST["idCliente"];

if ($opcion == 'registrar') {
	$plazo = $_POST["plazo"];
	$total2 = $_POST["total"];
	//Registrar Solicitud
	//var_dump($Conexion);
	$Consulta = $Conexion ->query("INSERT INTO web_solicitudes (id_solicitud,id_usuario,plazo,monto,id_status,comentarios,fecha_solicitud,fecha) VALUES(NULL,$id_usuario,$plazo,$total2,0,NULL,NOW(),NULL)");
	$Consulta = $Conexion ->query("INSERT INTO notificacion(id_notificacion) VALUES(NULL)");
	echo "true";
	//var_dump($Consulta);
}
//Aceptar solicitud
if ($opcion == 'aceptada') {
	$id_solicitud = $_POST["idsolicitud"];
	$Consulta = $Conexion ->query("UPDATE web_solicitudes SET comentarios ='$opcion' , id_status = 1,fecha = NOW() WHERE id_solicitud = $id_solicitud");
	$insertarhistorial = $Conexion ->query("INSERT INTO historial (id_usuario,id_solicitud,comentarios) VALUES($idCliente,$id_solicitud,'$opcion')");
	echo "true";
	//var_dump($Consulta);
}
//Rechazar la solicitud
if ($opcion == 'rechazada') {
	$id_solicitud = $_POST["idsolicitud"];
	$Consulta = $Conexion ->query("UPDATE web_solicitudes SET comentarios ='$opcion' , id_status = 1,fecha = NOW() WHERE id_solicitud = $id_solicitud");
	$insertarhistorial = $Conexion ->query("INSERT INTO historial (id_usuario,id_solicitud,comentarios) VALUES($idCliente,$id_solicitud,'$opcion')");
	echo "true";
	//var_dump($Consulta);
}


}



?>
