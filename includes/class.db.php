<?php
	class db {
		//atributos
		private $db_host;
		private $db_user;
		private $db_pass;
		private $db_name;
		
		private $connect;
		private static $instancia;	
		private $recurso;		
		private $estado;
		
		//Funciones
		private function __construct(){
			$this->setParametros();
			$this->setConexion();
		}	
		private function setParametros(){
			require('config.php');
			$this->db_host = DB_HOST;
			$this->db_user = DB_USER;
			$this->db_pass = DB_PASS;
			$this->db_name = DB_NAME;
		}
		private function setConexion(){
			$this->connect = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
			mysql_select_db($this->db_name,$this->connect) or die('Error en la conexion');
		}
		public static function connect(){
			if(is_null($instancia)){
				$instancia = new db;
			}
			return $instancia;
		}	
		/*Ejecucion de consultas*/
		public function execute($query,array $arg = array()){
			if(sizeof($arg) != 0){
				for($i=0,$cantidad=sizeof($arg);$i<$cantidad;$i++){
					$arg[$i] = mysql_real_escape_string($arg[$i]);
				}
				$query = vsprintf($query,$arg);
			}
			$this->estado = true;
			return $this->recurso = @mysql_query($query,$this->connect) or $this->estado = false;		
		}			
		
		public function fetch_array(){
			$fetch_array = array();
			while ($fila = mysql_fetch_array($this->recurso, MYSQL_ASSOC)){$fetch_array[] = $fila;}	
			return $fetch_array;
		}	
		
		public function estado(){
			return $this->estado;
		}	
		public function close(){
			mysql_close($this->connect);
		}
		public function num_rows(){
			if($this->recurso){
				return @mysql_num_rows($this->recurso);
			}else{
				return false;
			}	
		}

	}
?>