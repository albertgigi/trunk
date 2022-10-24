<?php

	ini_set('display_errors', 'On');

	error_reporting(E_ALL);

	//database connection config
	$dbHost = 'localhost';
	$dbUser = 'root';
	$dbPass = '';
	$dbName = 'panel';

	// setting up the web root and server root
	$thisFile = str_replace('\\', '/', __FILE__);
	$docRoot = $_SERVER['DOCUMENT_ROOT'];

	$webRoot = str_replace(array($docRoot, 'dropconfig.php'), '', $thisFile);
	$srvRoot = str_replace('dropconfig.php', '', $thisFile);

	define('WEB_ROOT', $webRoot);
	define('SRV_ROOT', $srvRoot);

	require_once 'dropdatabase.php';

/*
* End of file config.php
*/