<?php
require_once "./inc/session.php";
?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container mx-5 w-75">
        <h3 class="text-center mt-5">Lista de Ciudades</h3>
        <?php
        if (isset($_GET['city_id_del'])) {
            require_once  "./php/city_delete.php";
        }
        ?>
        <div id="table_city"></div>
    </div>
</div>

<script type="module">
import { cityTable } from "./js/tablas.js";
cityTable(); 
</script>