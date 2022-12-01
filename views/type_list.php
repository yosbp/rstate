<?php
require_once "./inc/session.php";
?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container mx-5 w-75">
        <h3 class="text-center mt-5">Lista de Tipos</h3>
        <?php
        if (isset($_GET['type_id_del'])) {
            require_once  "./php/type_delete.php";
        }
        ?>
        <div id="table_type"></div>
    </div>
</div>

<script type="module">
import { typetable } from "./js/tablas.js";
typetable(); 
</script>