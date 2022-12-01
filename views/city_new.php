<?php
require_once "./inc/session.php";
?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container">
        <h3 class="mt-5 text-center">Nueva Ciudad</h3>
        <div class="form-rest"></div>
        <form action="./php/city_save.php" class="FormularioAjax w-50 mx-auto mt-5" method="POST" autocomplete="off">
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Ciudad</strong></label>
                <input type="text" name="city_new" class="form-control" required />
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block mb-4 text-center ">Enviar</button>
            </div>
        </form>
    </div>
</div>