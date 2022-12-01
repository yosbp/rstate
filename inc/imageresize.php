<?php

function imageResized($image)
{
    $type = explode('.', $image);

    list($width, $height) = getimagesize($image);
    $newwitdh = intval($width * 0.50);
    $newheight = intval($height * 0.50);
    $newimage = imagecreatetruecolor($newwitdh, $newheight);
    $source = imagecreatefromjpeg($image);
    imagecopyresized($newimage, $source, 0, 0, 0, 0, $newwitdh, $newheight, $width, $height);
    $file_name = $image;
    imagejpeg($newimage, $file_name);
}

function thumbGenerate($image)
{

    $type = explode('.', $image);

    $lenght = intval(strlen($type[3]));
    $lenght = $lenght - $lenght - $lenght - 1;
    $final = substr($image, 0, $lenght);

    list($width, $height) = getimagesize($image);
    $newwitdh = intval($width * 0.10);
    $newheight = intval($height * 0.10);
    $newimage = imagecreatetruecolor($newwitdh, $newheight);
    $source = imagecreatefromjpeg($image);
    imagecopyresized($newimage, $source, 0, 0, 0, 0, $newwitdh, $newheight, $width, $height);
    $file_name = $final . '_thumb' . '.' . $type[3];
    imagejpeg($newimage, $file_name);
}


function thumb($image)
{
    if($image==null || $image==''){
        $image="../img/no-image.png";
    }
    $type = explode('.', $image);
    $lenght = intval(strlen($type[3]));
    $lenght = $lenght - $lenght - $lenght - 1;
    $final = substr($image, 0, $lenght);
    $file_name = $final . '_thumb' . '.' . $type[3];
    return $file_name;
 
}
