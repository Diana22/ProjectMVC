<?php

// Global config
$config = array(

	// App domain
	'domain' => NULL,

	// App folder
	'folder' => NULL,

	// Database
	'database' => array(
		'server'   => 'localhost',
		'user'     => NULL,
		'password' => NULL,
		'name' => NULL,
	),

	'default_controller' => 'home',

	'default_action' => 'index',

);

// Include local config
if (file_exists(__DIR__ . '/config.local.php')) {
	@include_once __DIR__ . '/config.local.php';
}