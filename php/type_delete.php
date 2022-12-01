<?php

require_once "./php/main.php";

$id = clean_data($_GET['type_id_del']);

// Verificando que la categoria exista para eliminarla

$check_type = connect();
$check_type = $check_type->query("SELECT type_id FROM type WHERE type_id='$id'");

if ($check_type->rowCount() == 1) {

    $delete_type = connect();
    $delete_type = $delete_type->prepare("DELETE FROM type WHERE type_id=:id");

    $delete_type->execute([":id" => $id]);

    if ($delete_type->rowCount() == 1) {
        echo
        '<div class="alert bg-success bg-opacity-50 text-center">
            <strong>TIPO ELIMINADO!</strong><br>
            El tipo de propiedad se elimino exitosamente.
            </div>
            ';
    } else {
        echo
        '<div class="alert bg-danger bg-opacity-50 text-center">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Hubo un error al intentar eliminar el tipo de propiedad, intente de nuevo.
            </div>';
    }

    $delete_type = null;
} else {
    echo
    '<div class="alert bg-danger bg-opacity-50 text-center">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    No existe el tipo de propiedad seleccionado
    </div>';
};

$check_type = null;
