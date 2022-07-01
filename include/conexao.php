<?php

$db_servidor="localhost";
$db_usuario="root";
$db_senha=""; 
$db_banco="uso";
$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$dsn = "mysql:host=$db_servidor;dbname=$db_banco";
$pdo = new PDO($dsn, $db_usuario, $db_senha,$options);








?>


