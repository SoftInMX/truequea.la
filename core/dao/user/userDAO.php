<?php
	require_once('core/dao/conection.php');
	require_once('core/helpers/helper.php');
	
	/**
	 * 
	 */
	class userDAO {
		
		var $conection;
		var $mysqli;
		var $helper;
		
		function __construct() {
			$this->conection = new Conection();
			$this->helper = new helper();
			$this->mysqli = $this->conection->conect();
		}
		
	}	
?>