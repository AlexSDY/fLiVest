<?php
use Medoo\Medoo;

	$db = new Medoo([
		'database_type' => 'mysql',
		'database_name' => 'feedBD',
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
	 
		'charset' => 'utf8'
	]);

?>