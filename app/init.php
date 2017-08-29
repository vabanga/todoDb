<?php

session_start();
$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=todo;host=127.0.0.1:3306', 'root','');

if(!isset($_SESSION['user_id'])){
	die('Вы не вошли в аккаунт.');
}

?>