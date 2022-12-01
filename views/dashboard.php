<?php 
include_once "./php/tables.php";
require_once "./inc/session.php";

?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container">
        <h1 class="dashboard_title">Dashboard</h1>
        <div class="dashboard_cards">
            <div class="dashboard_card"><strong>Total Propiedades</strong> <br> <?php echo $quantity_property ?> <br><a href="index.php?view=property_list">Detalles</a></div>
            <div class="dashboard_card"><strong>Total tipo de Propiedades</strong> <br><?php echo $quantity_type ?> <br><a href="index.php?view=type_list">Detalles</a></div>
            <div class="dashboard_card"><strong>Total Ciudades</strong> <br> <?php echo $quantity_city ?> <br><a href="index.php?view=city_list">Detalles</a></div>
        </div>
    </div>
</div>

