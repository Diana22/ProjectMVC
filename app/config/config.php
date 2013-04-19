<?php

// Global config

// App domain
$config['domain'] = NULL;

// App folder
$config['folder'] = NULL;

// Database
$config['database']['server'] =   'localhost';
$config['database']['user'] =     NULL;
$config['database']['password'] = NULL;
$config['database']['name'] =     NULL;

// Default page
$config['default_controller'] = 'home';
$config['default_action'] =     'index';

// Include local config
<<<<<<< HEAD
if (file_exists( __DIR__. '/config.local.php')) {
	@include_once __DIR__.'/config.local.php';
=======
if (file_exists(APP_PATH . '/config/config.local.php')) {
	@include_once APP_PATH . '/config/config.local.php';
>>>>>>> 1c016585f2512610d378e8703b516ce9487c3e92
}