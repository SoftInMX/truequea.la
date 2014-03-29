<?php
	require_once('modulos/user/model/user.php');
	class userController{
		var $user = NULL;
		
		public function __construct(){
			$this->user = new user();
		}

		public function index(){
			$this->user->show('index');
		}
		
	}
?>