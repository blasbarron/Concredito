<?php
	require "conexion.php";
	//var_dump($_POST);
	$monto = $_POST['monto'];
	$plazo = $_POST['plazo'];
	if ($plazo == 1 ) {
		$interes = 0.05;
	}elseif ($plazo == 2) {
		$interes = 0.07;
	}else{
		$interes = 0.12;
	}
	//var_dump($monto);
	//var_dump($interes);
	$calculo = ($monto * $interes);
	//var_dump($calculo);
	$total = ($calculo + $monto);
	//var_dump($total);
	echo "<input class='form-control input-sm' id='total' name='total' value = '$total' type='text' placeholder='Total'>";
	//echo $total;
?>