<?php
	class conexion
	{
		private $servidor;
		private $usuario;
		private $contraseña;
		private $basedatos;
		public  $conexion;

		public function __construct(){
			// $this->servidor   = "34.211.45.98";
			$this->servidor   = "localhost";
			$this->usuario	  = "safwin";
			$this->contraseña = "trm000";
			$this->basedatos  = "proyecto_blas";
		}

		function conectar(){
			$this->conexion= new mysqli($this->servidor,$this->usuario,$this->contraseña,$this->basedatos);
		}

		function cerrar(){
			$this->conexion->close();
		}
	}

?>