<?php
	session_start();
	
	# Para accesar a la base de datos
	const DBHOST = '';
	const DBUSER = '';
	const DBPASS = '';
	const DBNAME = '';
	const HTML = 'static/';
	const WEB_RAIZ = '/truequeala/';
	const TEMPLATE = 'static/template.html';
	const PRODUCCION = false;
	
	if(!PRODUCCION) {
	    ini_set('error_reporting', E_ALL | E_STRICT);
	    error_reporting(E_ALL ^ E_NOTICE);
	    ini_set('display_errors', '1');
	    ini_set('track_errors', 'On');
	} else {
	    ini_set('display_errors', '0');
	}
	
	require_once('helpers/helper.php');
	require_once('helpers/mail.php');
?>