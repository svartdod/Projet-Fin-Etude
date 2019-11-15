<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


$user='root';
$password='';
$dbname='mysql:host=localhost;dbname=pfe_final';
$database=new PDO($dbname,$user,$password);


?>