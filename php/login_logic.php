<?php

//Almacenando Datos
$user = clean_data($_POST["login_user"]);
$password = clean_data($_POST["login_password"]);

//Verificando Campos Obligatorios

if ($user == "" || $password == "") {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios
            </div>';
    exit();
};

//Verificando integridad de los datos

if (verify_data("[a-zA-Z0-9]{4,20}", $user)) {
    echo '<div class="alert alert-danger mt-3 text-center">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El USUARIO no coincide con el formato solicitado
        </div>';
    exit();
}

if (verify_data("[a-zA-Z0-9$@.-]{7,100}", $password)) {
    echo '<div class="alert alert-danger mt-3 text-center">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La CLAVE no coincide con el formato solicitado
        </div>';
    exit();
}

$check_user = connect();
$check_user = $check_user->query("SELECT * FROM admin WHERE user_user='$user'");

if ($check_user->rowCount() == 1) {
    $check_user = $check_user->fetch();

    if ($check_user['user_user'] == $user && $password==$check_user['user_password']) {
        
        session_start();
        $_SESSION['id'] = $check_user['user_id'];
        $_SESSION['name'] = $check_user['user_name'];
        $_SESSION['lastname'] = $check_user['user_lastname'];
        $_SESSION['user'] = $check_user['user_user'];

        if (headers_sent()) {
            echo "<script>window.location.href='index.php?view=dashboard'<script>";
        } else {
            header("Location: index.php?view=dashboard");
        }
    } else {
        echo '<div class="alert alert-danger mt-3 text-center">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Usuario o clave incorrectos.
            </div>';
    }
} else {
    echo '<div class="alert alert-danger mt-3 text-center">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        Usuario o clave incorrectos.
        </div>';
}

$check_user = null;
