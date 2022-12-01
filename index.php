<?php
session_name("RE");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Inmobiliaria</title>
    <link rel="stylesheet" href="./styles/styles.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./node_modules/gridjs/dist/theme/mermaid.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Raleway:ital,wght@0,500;0,700;1,300&display=swap" rel="stylesheet">
</head>

<body>
    <?php

    if (!isset($_GET['view']) || $_GET['view'] == "") {
        $_GET['view'] = "site";
    };

    if (is_file("./views/" . $_GET['view'] . ".php") && $_GET['view'] != 404) {
        include "./views/" . $_GET['view'] . ".php";
    } else{
        include "./views/404.php";
    }

    ?>


    <script src="./js/ajax.js"></script>
    <script src="./node_modules/gridjs/dist/gridjs.umd.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>