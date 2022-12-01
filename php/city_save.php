<?php

require_once "main.php";

//Limpia los datos para prevenir inyeccion sql
$city = clean_data($_POST["city_new"]);

//Conecta y envia la nueva informacion a la base de datos
$save_city = connect();
$save_city = $save_city->prepare("INSERT INTO city (city_name) VALUE (:city)");

$marks = [
    ":city" => $city,
];

$save_city->execute($marks);

if ($save_city->rowCount() == 1) {
    echo '
    <div class="alert bg-success bg-opacity-50 text-center">
    <strong>TIPO REGISTRADO!</strong><br>
    La propiedad se registro exitosamente
    </div>
    ';
} else {
    echo '
    <div class="alert bg-danger bg-opacity-50 text-center">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    No se pudo registrar, por favor intente nuevamente.
    </div>
    ';
}

$save_city = null;