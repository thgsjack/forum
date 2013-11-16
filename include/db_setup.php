<?php
include("db_mysql.php");
$config=array('dbname'=>'forum',
'hostname'=>'localhost',
'username'=>'root',
'password'=>'Ncue7267141');
$db = new MySQLControl();
$db->database = $config['dbname'];
$db->connect($config['hostname'], $config['username'], $config['password'], 0);
$db->query("SET NAMES utf8;");
$db->query("SET CHARACTER_SET_CLIENT=utf8;");
$db->query("SET CHARACTER_SET_RESULTS=utf8;");
?>