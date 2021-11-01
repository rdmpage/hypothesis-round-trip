<?php


global $config;

// Date timezone--------------------------------------------------------------------------
date_default_timezone_set('UTC');

// Multibyte strings----------------------------------------------------------------------
mb_internal_encoding("UTF-8");

// Environment---------------------------------------------------------------------------
// In development this is a PHP file that is in .gitignore, when deployed these parameters
// will be set on the server
if (file_exists(dirname(__FILE__) . '/env.php'))
{
	include 'env.php';
}

?>
