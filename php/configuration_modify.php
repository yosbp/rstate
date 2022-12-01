<?php

require_once "./main.php";

// Almacenando datos recibidos del formulario
$phone = clean_data($_POST["phone"]);
$whatsapp = clean_data($_POST["whatsapp"]);
$instagram = clean_data($_POST["instagram"]);
$twitter = clean_data($_POST["twitter"]);
$facebook = clean_data($_POST["facebook"]);

//Acualizar Datos en la BD

$save_config = connect();
$save_config = $save_config->prepare("UPDATE config SET config_phone=:phone, config_link_whatsapp=:whatsapp, config_instagram=:instagram, config_twitter=:twitter, config_facebook=:facebook");

$marks = [
    ":phone" => $phone,
    ":whatsapp" => $whatsapp,
    ":instagram" => $instagram,
    ":twitter" => $twitter,
    ":facebook" => $facebook,
];

$save_config->execute($marks);

//Verifica Todo y envia el mensaje

if (($save_config->rowCount() == 1)) {
    echo '
        <div class="alert bg-success bg-opacity-50 text-center">
        <strong>DATOS MODIFICADOS!</strong><br>
        Los datos se modificaron exitosamente
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

$save_config=null;
