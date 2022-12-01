<?php

require_once "main.php";
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
$currency = clean_data($_POST["currency"]);
$price = number_format($_POST["price"], 0, ',', '.')." ".$currency;
$city = clean_data($_POST["city"]);
$owner = clean_data($_POST["owner"]);
$owner_phone = clean_data($_POST["owner_phone"]);
$publicby = clean_data($_POST["publicby"]);


//Obteniendo el ultimo ID para sacar el siguiente y crear la carpeta
$getnewid = connect();
$getnewid = $getnewid->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'property'");
$getnewid = $getnewid->fetch();
$newid = intval($getnewid['auto_increment']);
$getnewid = null;

//Tratando la imagen principal

// Directorio de imagenes
$img_dir = '../img/properties/' . 'property_' . $newid;

// Comprobando si se ha seleccionado una imagen 
if ($_FILES['main_photo']['name'] != "" && $_FILES['main_photo']['size'] > 0) {

    // Creando directorio de imagenes 
    if (!mkdir($img_dir, 0777, true)) {
        echo '
            <div class="alert bg-danger bg-opacity-50 text-center">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Error al crear el directorio de imagenes
            </div>
            ';
        exit();
    }


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
    $img_name = 'Propiedad_' . $newid . '_img1';

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

//Guardando datos en la BD

$save_property = connect();
$save_property = $save_property->prepare("INSERT INTO property (property_title, property_description, property_type, property_transaction_type, property_location, property_rooms, property_banios, property_floors, property_garage, property_size, property_price, 	property_currency, property_url_photo, property_city, property_owner, property_owner_phone, property_publicby) VALUES (:title, :description, :type, :transaction_type, :location, :rooms, :banios, :floors, :garage, :size, :price, :currency, :url_photo, :city, :owner, :owner_phone, :publicby)");

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


//Galeria de imagenes

// Directorio de imagenes
$img_dir = '../img/properties/' . 'property_' . $newid;

// Comprobando si se ha seleccionado una imagen 
if ($_FILES['gal_photos']['name'][0] != " " && $_FILES['gal_photos']['size'][0] > 0) {

    $i = 2;
    foreach ($_FILES['gal_photos']['tmp_name'] as $key => $value) {
        // Comprobando formato de las imagenes 
        if (mime_content_type($_FILES['gal_photos']['tmp_name'][$key]) != "image/jpeg" && mime_content_type($_FILES['main_photo']['tmp_name'][$key]) != "image/png") {
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
        $img_name = 'Propiedad_' . $newid . '_img' . $i;

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
        $save_img_gal = $save_img_gal->query("INSERT INTO photos (photos_name, property_id) VALUES ('$img_route', '$newid')");

        $i++;
    }
}

//Verifica y Ejecuta toda la operacion

$save_property->execute($marks);

if (($save_property->rowCount() == 1)) {
    echo '
        <div class="alert bg-success bg-opacity-50 text-center">
        <strong>PROPIEDAD REGISTRADA!</strong><br>
        La propiedad se registro exitosamente
        </div>
        ';
} else {
    echo '
        <div class="alert bg-danger bg-opacity-50 text-center">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No se pudo registrar la propiedad, por favor intente nuevamente.
        </div>
        ';
}

$save_property = null;
$save_img_gal = null;
