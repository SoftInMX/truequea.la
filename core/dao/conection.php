<?php
	/**
	 * Clase que define la conxion a base de datos
	 */
	class Conection {
		
		public function conect(){
			$mysqli = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
			if ($mysqli->connect_errno) {
				return false;
			}else{
				$mysqli->set_charset("utf8");
				return $mysqli;
			}
		}
		
	}
?>