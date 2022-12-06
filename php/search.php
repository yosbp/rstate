<?php

require_once "./inc/datas_main.php";
require_once "./inc/imageresize.php";
require_once "./inc/linkgenerator.php";

//Funciones para generar el Query

function dataSearch($city, $type, $tr, $start, $perPage)
{
    $data=connect();
    $data = $data->query("SELECT * FROM property WHERE property_city='$city' AND property_type='$type' AND property_transaction_type='$tr' LIMIT $start,$perPage");

    $dataRes = connect();
    $dataRes = $dataRes->query("SELECT * FROM property WHERE property_city='$city' AND property_type='$type' AND property_transaction_type='$tr' ");

    return array($data, $dataRes);
};

function dataSearchAll($tr, $start, $perPage)
{
    $data = connect();
    $data = $data->query("SELECT * FROM property WHERE property_transaction_type='$tr' LIMIT $start,$perPage");

    $dataRes = connect();
    $dataRes = $dataRes->query("SELECT * FROM property WHERE property_transaction_type='$tr'");

    return array($data, $dataRes);
};

//Variables para paginador y Resultados de consulta

if (!isset($_GET['page'])) {
    $_GET['page'] = 1;
}

$city = "Charallave";
$type = "Apartamento";
$tr = "Compra";
$page = $_GET['page'];
$perPage = 8;
$start = ($page - 1) * $perPage;
$searchResult = dataSearch($city, $type, $tr, $start, $perPage);

if (isset($_GET['city']) && isset($_GET['type']) && isset($_GET['tr'])) {
    $city = $_GET['city'];
    $type = $_GET['type'];
    $tr = $_GET['tr'];
    $searchResult = dataSearch($city, $type, $tr, $start, $perPage);

} elseif (isset($_GET['trAll']) && ($_GET['trAll'] == "Compra" || $_GET['trAll'] == "Alquiler")) {
    
    $tr = $_GET['trAll'];
    $searchResult = dataSearchAll($tr, $start, $perPage);
}

$results = $searchResult[1]->rowCount();

$pages = ceil($results / $perPage);
