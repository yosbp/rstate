<?php

require_once "./php/main.php";

$id = clean_data($_GET['property_id_del']);
$imgdir = "./img/properties/property_" . $id;

// Verificando que la categoria exista para eliminarla

$check_property = connect();
$check_property = $check_property->query("SELECT property_id FROM property WHERE property_id='$id'");

if ($check_property->rowCount() == 1) {

    $delete_property = connect();
    $delete_property = $delete_property->prepare("DELETE FROM property WHERE property_id=:id");
    $delete_photos = connect();
    $delete_photos = $delete_photos->query("DELETE FROM photos WHERE property_id=$id");

    $delete_property->execute([":id" => $id]);

    if ($delete_property->rowCount() == 1) {

        if (is_dir($imgdir)) {
            foreach (glob($imgdir . '/*') as $file) {
                unlink($file);
            };
            rmdir($imgdir);
        };

        echo
        '<div class="alert bg-success bg-opacity-50 text-center">
            <strong>PROPIEDAD ELIMINADA!</strong><br>
            La propiedad se elimino exitosamente
            </div>
            ';
    } else {
        echo
        '<div class="alert bg-danger bg-opacity-50 text-center">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Hubo un error al intentar eliminar la propiedad, intente de nuevo.
            </div>';
    }

    $delete_property = null;
    $delete_photos = null;
} else {
    echo
    '<div class="alert bg-danger bg-opacity-50 text-center">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    No existe la propiedad seleccionada
    </div>';
};

$check_property = null;
