<?php

function linkGenerate($id, $type, $location, $price)
{
    $link = $id . " " . $type . " " . $location . " " . $price;
    $replacefrom = array(".", " ", "$");
    $replaceto = array("", "-", "USD");
    return str_replace($replacefrom, $replaceto, $link);
}
