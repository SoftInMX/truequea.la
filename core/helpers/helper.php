<?php
	class helper{
			
		public function __construct(){
			
		}
		
		public static function email($mail){
			$pattern = "/^[A-Za-z\'0-9]+([._-][A-Za-z\'0-9]+)*@([A-Za-z0-9]+([._-][A-Za-z0-9]+))+$/";

			if(preg_match($pattern,$mail)){
				$dns = explode('@', $mail);
				return checkdnsrr($dns[1]);
			}else{
				return false;
			}
		}
		
		public static function text($text){
			$pattern = '/^[a-zA-Z_áéíóúÁÉÍÓÚñÑüÜ.,-:\s]*$/';
			return preg_match($pattern,$text);
		}
		
		public static function number($number){
			$pattern = '/^[0-9.,]*$/';
			return preg_match($pattern,$number);
		}
		
		public static function encriptarURL($string, $key) {
		   $result = '';
		   for($i=0; $i<strlen($string); $i++) {
		      $char = substr($string, $i, 1);
		      $keychar = substr($key, ($i % strlen($key))-1, 1);
		      $char = chr(ord($char)+ord($keychar));
		      $result.=$char;
		   }
		   return base64_encode($result);
		}
		
		public static function desencriptarURL($string, $key) {
		   $result = '';
		   $string = base64_decode($string);
		   for($i=0; $i<strlen($string); $i++) {
		      $char = substr($string, $i, 1);
		      $keychar = substr($key, ($i % strlen($key))-1, 1);
		      $char = chr(ord($char)-ord($keychar));
		      $result.=$char;
		   }
		   return $result;
		}
		
		public static function sanitize($dato){
			$dato = trim($dato);
			$dato = strip_tags($dato);
			$dato = htmlentities($dato);
			return $dato;
		}
		
		public static function arrayToSql($type,$data,$table){
			$query = '';
			$total = count($data);
			$keys = array_keys($data);
			$i = 0;
			$first_key = $keys[0];
			
			if ($type == 'insert') {
				$query .= "INSERT INTO $table (". implode(',', $keys) . ') VALUES(';
				foreach ($data as $value) {
					$query .= "'$value'";
					$query .= $i+1 >= $total?');':',';
					$i++;
				}
				
			}else if ($type == 'update') {
				$query = "UPDATE $table SET ";
				for ($j=1; $j < $total; $j++) {
					$query .= $keys[$j] . '=' . "'" . $data["$keys[$j]"] . "'";
					$query .= isset($keys[$j + 1])?', ':' ';
				}				
				$query .= "WHERE $first_key = " . $data["$first_key"] . ';';
			}else if ($type == 'delete') {
				$query = "DELETE FROM $table WHERE $first_key = " . $data["$first_key"] . ';';
			}else if ($type == 'select') {
				$query .= 'SELECT ' . implode(',', $data['select']) . " FROM $table WHERE $first_key = " . $data["$first_key"] . ';';
			}
			
			return $query;
		}
		
		public static function subirImagen($pics){
			$ruta = 'static/uploads/'.$_SESSION['user']->id_datos.'/';
			$response = false;
			$dir = file_exists($ruta);
			
			if(!$dir){
				$dir = mkdir($ruta);
			}
			
			if ($dir) {
				if(strstr($pics['type'],'image/')){
					$imageinfo = getimagesize($pics['tmp_name']);
					
					if($imageinfo != false && strstr($imageinfo['mime'], 'image/')){
						$ext = array('jpg','png','gif','jpeg','JPG', 'PNG','GIF','JPEG');
						$e = substr($pics['name'], -3);
						$e = $e == 'peg' || $e == 'PEG'? substr($pics['name'], -4):$e;
						
					    if(in_array($e, $ext)){
					    	if(($pics['size']/1000) <= 3072){
					    		$nombre = md5(rand(1, 1000000).date("Y-m-dH:i:s").str_replace(' ', '-', $pics['name'])).".".$e;
								if(copy($pics['tmp_name'],$ruta.$nombre)){
									$response = $ruta.$nombre;
								}
					    	}
					    }
					}
				}
			}
			
			return $response;
		}
		
		public static function getTemplateList($key,$html){
			$template = '';
			$template = explode($key, $html);
			$template = explode($key, $template[1]);
			$template = $template[0];
			
			return $template;
		}
		
	}
?>