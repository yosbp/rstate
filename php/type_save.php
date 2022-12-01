<?php

require_once "main.php";

$type = clean_data($_POST["type_new"]);

$save_type = connect();
$save_type = $save_type->prepare("INSERT INTO type (type_name) VALUE (:type)");

$marks = [
    ":type" => $type,
];

$save_type->execute($marks);

if ($save_type->rowCount() == 1) {
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

$save_type = null;
