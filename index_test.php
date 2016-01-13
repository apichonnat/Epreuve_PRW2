<?php
require 'src/classes/App.php';
$config = include("src/config/config.php");

try
{
	App::init($config);
}
catch(Exception $e)
{
	die('Error: '.$e->getMessage());
}

$connection = App::db();
	var_dump($connection);


$data1 = $connection->listTables();
var_dump($data1);

$data = $connection->getFieldsNames("articles");
var_dump($data);

 ?>
