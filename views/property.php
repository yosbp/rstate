<?php
include "./php/main.php";
$id = explode("-", $_GET['p']);
$id = $id[0];
$data = connect();
$data = $data->query("SELECT * FROM property WHERE property_id='$id'");
$data = $data->fetch();
?>

<div class="pt-3">
    <div class=><?php include "./inc/navbar_main.php"?></div>
    <div class="container mt-4">
        <a href="javascript:history.go(-1)"> <i class="bi bi-arrow-left-short"></i> Pagina anterior</a>
        <h1 class="mt-4"> <?php echo $data['property_city']; ?></h1>
            <h4> <?php echo $data['property_location']; ?></h4>
                <div id="carouselExampleControls" class="carousel carousel-dark slide mx-auto my-5 w-75" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $data['property_url_photo']; ?>" class="d-block property_img" alt="...">
                        </div>
                        <?php
                        $galdata = connect();
                        $galdata = $galdata->query("SELECT * FROM photos WHERE property_id='$id'");
                        while ($gal = $galdata->fetch()) : ?>
                            <div class="carousel-item">
                                <img src="
                            <?php echo substr($gal['photos_name'], 1); ?>" class="d-block property_img" alt="...">
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="property_details">
                    <div class="property_info row property_details_info mx-0">
                        <div class="col-6 col-md-3"> <strong>Habitaciones</strong><br> <i class="icon-bed"></i> <?php echo $data['property_rooms']; ?> </div>
                        <div class="col-6 col-md-3"> <strong>Baños</strong> <br> <i class="icon-bath"></i> <?php echo $data['property_banios']; ?> </div>
                        <div class="col-6 col-md-3"> <strong>Medida</strong> <br> <i class="icon-measure"></i> <?php echo $data['property_size']; ?> </div>
                        <div class="col-6 col-md-3"> <strong>Estacionamiento</strong> <br> <i class="icon-measure"></i> <?php echo $data['property_garage']; ?> </div>
                    </div>
                    <div class="property_info property_details_price">
                        <h5 class="price_title">Precio:</h5>
                        <h3 class="price_price"><?php echo $data['property_price'] ?></h5>
                        <button type="button" class="price-btn btn btn-dark mt-3">Contactanos</button>
                    </div>
                    
                    <div class="property_info property_details_description">
                        <h5 class="description_title">Detalles:</h5>
                        <textarea disabled class=" description_text" name="description" rows="10"><?php echo $data['property_description'];?></textarea>
                    </div>
                </div>
    </div>
</div>

<?php include "./inc/footer.php";?>