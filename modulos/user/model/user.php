<?php
	require_once('core/dao/user/userDAO.php');
	require_once('modulos/user/view/userViews.php');
	
	class user{
			
		var $view = NULL;
		var $userDAO = NULL;
		
		public function __construct(){
			$this->view = new userViews();
			$this->userDAO = new userDAO();
		}
		
		public function show($view){
			$this->view->show($view);
		}
		
	}
?>