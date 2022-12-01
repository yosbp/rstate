<?php

require_once "./php/main.php";

$id = clean_data($_GET['city_id_del']);

// Verificando que la categoria exista para eliminarla

$check_city = connect();
$check_city = $check_city->query("SELECT city_id FROM city WHERE city_id='$id'");

if ($check_city->rowCount() == 1) {

    $delete_city = connect();
    $delete_city = $delete_city->prepare("DELETE FROM city WHERE city_id=:id");

    $delete_city->execute([":id" => $id]);

    if ($delete_city->rowCount() == 1) {
        echo
        '<div class="alert bg-success bg-opacity-50 text-center">
            <strong>TIPO ELIMINADO!</strong><br>
            La ciudad se elimino exitosamente.
            </div>
            ';
    } else {
        echo
        '<div class="alert bg-danger bg-opacity-50 text-center">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Hubo un error al intentar eliminar la ciudad, intente de nuevo.
            </div>';
    }

    $delete_city = null;
} else {
    echo
    '<div class="alert bg-danger bg-opacity-50 text-center">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    No existe la ciudad seleccionada.
    </div>';
};

$check_city = null;
