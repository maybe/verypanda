<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

//debug
ini_set('display_startup_errors', true);
ini_set('display_errors', true);
error_reporting( E_ERROR );

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
