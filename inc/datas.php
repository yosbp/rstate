<?php
    require_once "../php/main.php";
    require_once "../php/tables.php";
    $datos=(isset($_GET['datas'])) ? $_GET['datas'] : '' ;
   

    if ($datos == "property") {
        echo $datos_property;
    };

    if ($datos == "type") {
        echo $datos_type;
    };

    if ($datos == "city") {
        echo $datos_city;
    };

