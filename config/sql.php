<?php

if ( DEBUG_MODE ) {
	$sql_host = 'localhost';
	$sql_user = 'root';
	$sql_pass = '111';
	$sql_base = 'joe_alone';
} else {
	$sql_host = '';
	$sql_user = '';
	$sql_pass = '';
	$sql_base = '';
}	
	
$dsn = "mysql:host=$sql_host;dbname=$sql_base;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$db = new PDO($dsn, $sql_user, $sql_pass, $opt);
unset($dsn, $sql_user, $sql_pass, $opt); // Чистка мусора

// Для мобильности сделаем ссылку на БД
function db(){GLOBAL $db;return $db;}

?>