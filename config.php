<?php
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	$autoload = function($class) {
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);


	define('INCLUDE_PATH','http://localhost/TCC-2.0/');
	
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','nutribox');