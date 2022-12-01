<?php
require_once "main.php";

$data = connect();
$data = $data->query("SELECT * FROM property");

$datos_property = $data->fetchAll();
$datos_property = json_encode($datos_property);
$quantity_property = $data->rowCount();

$data=null;

$data = connect();
$data = $data->query("SELECT * FROM type");

$datos_type = $data->fetchAll();
$datos_type=json_encode($datos_type);
$quantity_type = $data->rowCount();

$data=null;


$data = connect();
$data = $data->query("SELECT * FROM city");

$datos_city = $data->fetchAll();
$datos_city=json_encode($datos_city);
$quantity_city = $data->rowCount();

$data=null;
