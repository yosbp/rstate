<?php

require "./php/main.php";

$data = connect();
$data = $data->query("SELECT * FROM type");
$types = $data;
$data = null;

$data = connect();
$data = $data->query("SELECT * FROM city");

$cities = $data;

$data = null;

$data = connect();
$data = $data->query("SELECT * FROM property ORDER BY property_id DESC LIMIT 5");
$last5 = $data;

$data = null;

$data = connect();
$data = $data->query("SELECT * FROM photos");
$galphotos = $data;

$data = null;


