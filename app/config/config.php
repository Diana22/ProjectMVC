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
if (file_exists(APP_PATH . '/config/config.local.php')) {
	@include_once APP_PATH . '/config/config.local.php';
}