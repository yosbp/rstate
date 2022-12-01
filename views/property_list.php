<?php
require_once "./inc/session.php";
?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container mx-5 w-75">
        <h3 class="text-center mt-5">Lista de Propiedades</h3>
        <?php
        if (isset($_GET['property_id_del'])) {
            require_once  "./php/property_delete.php";
        }
        ?>
        <div id="table_property"></div>
    </div>
</div>

<script type="module">
    import {
        propertytable
    } from "./js/tablas.js";

    propertytable();
</script>