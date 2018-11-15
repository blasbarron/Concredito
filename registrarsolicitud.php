<?php  

session_start();
require "conexion.php";
//var_dump($_POST);
//var_dump($_SESSION);
$id_usuario = $_SESSION["cliente"];
$opcion = $_POST["opcion"];
if ($opcion == 'notificaciones') {
	$Consulta = $Conexion ->query("SELECT id_solicitud FROM web_solicitudes WHERE id_usuario != $id_usuario AND id_status = 0");
	$fila = $Consulta->fetch_array();
	$solicitud = $fila["id_solicitud"];
	//var_dump($Consulta);
	if ($solicitud != NULL){

		echo "1";
	}
	else
	{
		echo "0";
	}
}
if ($opcion == 'registrar') {
	$idCliente = $_POST["idCliente"];
	$plazo = $_POST["plazo"];
	$total2 = $_POST["total"];
	//Registrar Solicitud
	//var_dump($Conexion);
	$Consulta = $Conexion ->query("INSERT INTO web_solicitudes (id_solicitud,id_usuario,plazo,monto,id_status,comentarios,fecha_solicitud,fecha) VALUES(NULL,$id_usuario,$plazo,$total2,0,NULL,NOW(),NULL)");
	$Consulta = $Conexion ->query("INSERT INTO notificacion(id_notificacion,id_cliente,status) VALUES(NULL,$id_usuario,0)");
	echo "true";
	//var_dump($Consulta);
}
//Aceptar solicitud
if ($opcion == 'aceptada') {
	$idCliente = $_POST["idCliente"];
	$id_solicitud = $_POST["idsolicitud"];
	//var_dump($id_solicitud);
	$Consulta = $Conexion ->query("UPDATE web_solicitudes SET comentarios ='$opcion' , id_status = 1,fecha = NOW() WHERE id_solicitud = $id_solicitud");
	$insertarhistorial = $Conexion ->query("INSERT INTO historial (id_historial,id_usuario,id_solicitud,comentarios) VALUES(NULL,$idCliente,$id_solicitud,'$opcion')");
	echo "true";
	//var_dump($Consulta);
}
//Rechazar la solicitud
if ($opcion == 'rechazada') {
	$idCliente = $_POST["idCliente"];
	$id_solicitud = $_POST["idsolicitud"];
	$Consulta = $Conexion ->query("UPDATE web_solicitudes SET comentarios ='$opcion' , id_status = 1,fecha = NOW() WHERE id_solicitud = $id_solicitud");
	$insertarhistorial = $Conexion ->query("INSERT INTO historial (id_usuario,id_solicitud,comentarios) VALUES($idCliente,$id_solicitud,'$opcion')");
	echo "true";
	//var_dump($Consulta);
}

?>
