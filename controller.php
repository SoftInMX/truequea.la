<?php
	require_once('core/settings.php');
	
	$logController = isset($_SESSION['user']);
	$actionsController = array('login','rpass');
	
	$pval = array_values($_POST);
	$pkey = array_keys($_POST);
	$gval = array_values($_GET);
	$gkey = array_keys($_GET);
	
	for ($i=0,$t=count($pkey); $i < $t; $i++) {
		$_POST["$pkey[$i]"] = helper::sanitize($pval[$i]);
	}
	
	for ($i=0,$t=count($gkey); $i < $t; $i++) {
		$_GET["$gkey[$i]"] = helper::sanitize($gval[$i]);
	}
	
	#Validamos que la peticion sea de un modulo y que la acción no exista
	if ( isset($_GET['modulo']) && !isset($_GET['action']) ) {
		$modulo = 'modulos/' . $_GET['modulo'] . '/controller/' . $_GET['modulo'] . 'Controller.php';
		if ( is_file($modulo) ) {
			require_once($modulo);
			$class = $_GET['modulo'] . 'Controller';
			$class = new $class();
			$class->index();
		} else {
			header('Location: ' .WEB_RAIZ.'404');
		}
	} else if ( isset($_GET['modulo'],$_GET['action']) ) { #Si viene un modulo y una accion lo llama	
		$controller = 'modulos/' . $_GET['modulo'] . '/controller/' . $_GET['modulo'] . 'Controller.php';
		$clase = $_GET['modulo'].'Controller';
		$method = $_GET['action'];
		if ( is_file($controller) ) {
			require_once ($controller);
			$class = new $clase();
			$validar = array($class,$method);
			if( is_callable($validar) ) {
				$class->$method();
			} else {
				header('Location: ' .WEB_RAIZ.'404');
			}
		} else {
			header('Location: ' .WEB_RAIZ.'404');
		}
	} else {#Si no viene ningun parametro entonces es la raiz del sitio
		$modulo = 'modulos/user/controller/userController.php';
		if ( is_file($modulo) ) {
			require_once($modulo);
			$class = new userController();
			if( isset($_SESSION['user']) && $_SESSION['user'] != NULL ) {
				$class->timeline();
			} else {
				$class->index();
			}	
		} else {
			header('Location: ' .WEB_RAIZ.'404');
		}
	}
?>