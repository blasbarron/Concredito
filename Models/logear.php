<?php 
	class Entrar
	{
		private $conexion;
		public function __construct()
		{
			require_once 'conexion.php';
			$this->conexion= new conexion();
			$this->conexion->conectar();
		}

		function Identificar($usuario)
		{
			$Consulta_Usuario1 = $this->conexion->conexion->query("
				SELECT id_usuario,jerarquia FROM web_usuarios where username = '$usuario'");
			$Num = mysqli_num_rows($Consulta_Usuario1);
			//var_dump($Num);
			if ($Num > 0) {

				$r=$Consulta_Usuario1->fetch_array();
			}
			if ($Num == 0) {
				//var_dump("Entro");
				//Insertar a Usuario nuevo
				$Insertar_Usuario = $this->conexion->conexion->query("INSERT INTO web_usuarios (id_usuario,username,jerarquia) VALUES(NULL,'$usuario',1)");
				//var_dump($Insertar_Usuario);

				//Consultar de nuevo a usuario
				$Consulta_Usuario2 = $this->conexion->conexion->query("
				SELECT id_usuario,jerarquia FROM web_usuarios where username = '$usuario'");
				$Num = mysqli_num_rows($Consulta_Usuario2);
				//var_dump($Num);
				$r=$Consulta_Usuario2->fetch_array();
				//var_dump($r);
				//var_dump(die());
			}
			//var_dump($r);
			return $r;
			$this->conexion->cerrar();
		}

	}

	
	
?>