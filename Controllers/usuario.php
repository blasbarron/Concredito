<?php
	require_once('../Models/usuario.php');
	$boton=$_POST['boton'];

	switch ($boton) {
		case 'cerrar':
				session_start();
				session_destroy();
			break;
		case 'ingresar':
				$email = $_POST['email'];
				$password = $_POST['password'];

				$ins = new usuario();
				$array=$ins->identificar($email,$password);
				if ($array[0]==0) 
				{
					echo '0';
				}
				else
				{
					session_start();
					$_SESSION['ingreso']='YES';
					$_SESSION['nombre']=$array[1];
				}
			break;
		default:
			break;
	}		
?>