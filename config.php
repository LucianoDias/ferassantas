<?php
session_start();
$dbname ='dealership';
$dbuser ='LoopDias' ;
$dbpass ='';
$host = 'localhost';
$dns ="mysql:dbname={$dbname};host={$host}";
global $pdo;

try{
    $pdo = new PDO($dns,$dbuser,$dbpass); 
}catch(PDOEXception $e){
	echo"Falied: " .$e->getMessage();exit;
}