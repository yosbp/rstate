<?php

//Requiriendo algunos datos de la BD

$id = $_POST["id"];
$img_route = $_POST["image"];

require_once "./main.php";
require_once "../inc/imageresize.php";

// Almacenando datos recibidos del formulario
$title = clean_data($_POST["title"]);
$description = clean_data($_POST["description"]);
$type = clean_data($_POST["type"]);
$transaction_type = clean_data($_POST["transaction_type"]);
$location = clean_data($_POST["location"]);
$rooms = clean_data($_POST["rooms"]);
$banios = clean_data($_POST["banios"]);
$floors = clean_data($_POST["floors"]);
$garage = clean_data($_POST["garage"]);
$size = clean_data($_POST["size"]);
$price = clean_data($_POST["price"]);
$currency = clean_data($_POST["currency"]);
$city = clean_data($_POST["city"]);
$owner = clean_data($_POST["owner"]);
$owner_phone = clean_data($_POST["owner_phone"]);
$publicby = clean_data($_POST["publicby"]);

//Tratando la imagen principal

// Directorio de imagenes
$img_dir = '../img/properties/' . 'property_' . $id;

// Comprobando si se ha seleccionado una imagen 
if ($_FILES['main_photo']['name'] != "" && $_FILES['main_photo']['size'] > 0) {

    //Eliminando la imagen anterior para crear la nueva
    if (!is_dir($img_dir)) {
        if (!mkdir($img_dir, 0777, true)) {
            echo '
                <div class="alert bg-danger bg-opacity-50 text-center">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Error al crear el directorio de imagenes
                </div>
                ';
            exit();
        }
    }


    if (is_file($img_route)) {
        unlink($img_route);
    };

    // Comprobando formato de las imagenes 
    if (mime_content_type($_FILES['main_photo']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['main_photo']['tmp_name']) != "image/png") {
        echo '
                <div class="alert bg-danger bg-opacity-50 text-center">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    La imagen que ha seleccionado es de un formato que no está permitido
                </div>
            ';
        exit();
    }

    // Comprobando que la imagen no supere el peso permitido 
    if (($_FILES['main_photo']['size'] / 1024) > 10000) {
        echo '
                <div class="alert bg-danger bg-opacity-50 text-center">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    La imagen que ha seleccionado supera el límite de peso permitido
                </div>
            ';
        exit();
    }

    //extension de las imagenes
    switch (mime_content_type($_FILES['main_photo']['tmp_name'])) {
        case 'image/jpeg':
            $img_ext = ".jpg";
            break;
        case 'image/png':
            $img_ext = ".png";
            break;
    }

    // Cambiando permisos al directorio
    chmod($img_dir, 0777);

    /* Nombre de la imagen */
    $img_name = 'Propiedad_' . $id . '_img1';

    /* Nombre final de la imagen */
    $main_img_name = $img_name . $img_ext;
    $img_route = $img_dir . '/' . $main_img_name;

    /* Moviendo imagen al directorio */
    if (!move_uploaded_file($_FILES['main_photo']['tmp_name'], $img_route)) {
        echo '
                <div class="alert bg-danger bg-opacity-50 text-center">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
	            </div>
	        ';
        exit();
    }

    thumbGenerate($img_route);
    imageResized($img_route);
}

//Acualizar Datos en la BD

$save_property = connect();
$save_property = $save_property->prepare("UPDATE property SET property_title=:title, property_description=:description, property_type=:type, property_transaction_type=:transaction_type, property_location=:location, property_rooms=:rooms, property_banios=:banios, property_floors=:floors, property_garage=:garage, property_size=:size, property_price=:price, property_currency=:currency, property_url_photo=:url_photo, property_city=:city, property_owner=:owner, property_owner_phone=:owner_phone, property_publicby=:publicby WHERE property_id=$id");

$marks = [
    ":title" => $title,
    ":description" => $description,
    ":type" => $type,
    ":transaction_type" => $transaction_type,
    ":location" => $location,
    ":rooms" => $rooms,
    ":banios" => $banios,
    ":floors" => $floors,
    ":garage" => $garage,
    ":size" => $size,
    ":price" => $price,
    ":currency" => $currency,
    ":url_photo" => $img_route,
    ":city" => $city,
    ":owner" => $owner,
    ":owner_phone" => $owner_phone,
    ":publicby" => $publicby
];

$save_property->execute($marks);


//Galeria de imagenes

// Directorio de imagenes
$img_dir = '../img/properties/' . 'property_' . $id;

// Comprobando si se ha seleccionado alguna imagen 
if ($_FILES['gal_photos']['name'][0] != "" && $_FILES['gal_photos']['size'][0] > 0) {

    //Elimina todos los registros de la BD y las fotos de la carpeta
    $delete_img_gal = connect();
    $gal_imgs = $delete_img_gal->query("SELECT * FROM photos WHERE property_id=$id");

    if ($gal_imgs->rowCount() > 1) {

        $gal_imgs = $gal_imgs->fetchAll();

        foreach ($gal_imgs as $image) {
            unlink($image['photos_name']);
        };
    }
    $delete_img_gal = $delete_img_gal->query("DELETE FROM photos WHERE property_id=$id");

    //Añade las imagenes de la galeria
    $i = 2;
    foreach ($_FILES['gal_photos']['tmp_name'] as $key => $value) {
        // Comprobando formato de las imagenes 
        if (mime_content_type($_FILES['gal_photos']['tmp_name'][$key]) != "image/jpeg" && mime_content_type($_FILES['main_photo']['tmp_name']) != "image/png") {
            echo '
                    <div class="alert bg-danger bg-opacity-50 text-center">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen que ha seleccionado es de un formato que no está permitido
                    </div>
                ';
            exit();
        }

        // Comprobando que la imagen no supere el peso permitido 
        if (($_FILES['gal_photos']['size'][$key] / 1024) > 10000) {
            echo '
                    <div class="alert bg-danger bg-opacity-50 text-center">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        La imagen que ha seleccionado supera el límite de peso permitido
                    </div>
                ';
            exit();
        }

        //extension de las imagenes
        switch (mime_content_type($_FILES['gal_photos']['tmp_name'][$key])) {
            case 'image/jpeg':
                $img_ext = ".jpg";
                break;
            case 'image/png':
                $img_ext = ".png";
                break;
        }

        // Cambiando permisos al directorio
        chmod($img_dir, 0777);

        /* Nombre de la imagen */
        $img_name = 'Propiedad_' . $id . '_img' . $i;

        /* Nombre final de la imagen */
        $gal_img_name = $img_name . $img_ext;
        $img_route = $img_dir . '/' . $gal_img_name;

        /* Moviendo imagen al directorio */
        if (!move_uploaded_file($_FILES['gal_photos']['tmp_name'][$key], $img_route)) {
            echo '
                    <div class="alert bg-danger bg-opacity-50 text-center">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
                    </div>
                ';
            exit();
        }

        thumbGenerate($img_route);
        imageResized($img_route);

        //Guardando en la BD
        $save_img_gal = connect();
        $save_img_gal = $save_img_gal->query("INSERT INTO photos (photos_name, property_id) VALUES ('$img_route', '$id')");

        $i++;
    }
}

//Verifica Todo y envia el mensaje

if (($save_property->rowCount() == 1) || ($save_img_gal->rowCount() == 1)) {
    echo '
        <div class="alert bg-success bg-opacity-50 text-center">
        <strong>PROPIEDAD MODIFICADA!</strong><br>
        La propiedad se modifico exitosamente
        </div>
        ';
} else {
    echo '
        <div class="alert bg-danger bg-opacity-50 text-center">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No se pudo modificar los datos, por favor intente nuevamente.
        </div>
        ';
}

//Cerrando las conexiones a la BD

$save_property = null;
$save_img_gal = null;
$delete_img_gal = null;
