<?php
header('Cache-Control: no cache');
include "./php/search.php";
?>

<!-- BARRA DE BUSQUEDA -->

<div class="container">
  <div class="mb-3"><?php include "./inc/navbar_main.php" ?></div>
  <form class="internal_form_search mx-auto text-center w-75" method="get" action="index.php">
    <input type="hidden" name="view" value="search" />
    <h5>Considera otras opciones:</h5>
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-6 col-xl-4 mb-3 form-group">
        <label><strong>Ciudad</strong></label>
        <select name="city" class="form-select">
          <?php while ($row = $cities->fetch()) : ?>
            <option value="<?php echo $row['city_name']; ?>" <?php if (($row['city_name'] == $city)) {
                                                                echo 'selected = "selected"';
                                                              } ?>>
              <?php echo $row['city_name'] ?> </option>
          <?php endwhile ?>
        </select>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-3 mb-3 form-group">
        <label><strong>Tipo</strong></label>
        <select name="type" class="form-select">
          <?php while ($row = $types->fetch()) : ?>
            <option value="<?php echo $row['type_name']; ?>" <?php if (($row['type_name'] == $type)) {
                                                                echo 'selected = "selected"';
                                                              } ?>>
              <?php echo $row['type_name'] ?> </option>
          <?php endwhile ?>
        </select>
      </div>
      <div class="col-md-6 col-lg-6 col-xl-3 mb-3 form-group">
        <label><strong>Transacción</strong></label>
        <select name="tr" class="form-select">
          <option value="Compra" <?php if (($tr == "Compra")) {
                                    echo 'selected = "selected"';
                                  } ?>>Compra</option>
          <option value="Alquiler" <?php if (($tr == "Alquiler")) {
                                      echo 'selected = "selected"';
                                    } ?>>Alquiler</option>
        </select>
      </div class>
      <button type="submit" class="mt-2 align-self-center btn btn-secondary btn-search btn-sm col-md-6 col-lg-2 col-xl-2 ">Buscar</button>
    </div>
  </form>
</div>

<!-- TITULOS Y TARJETAS DE RESULTADOS -->

<div class="container row justify-content-center mx-auto mb-4">
  <h3 class="mt-5"><?php echo $results ?> Resultados de
    <?php if (isset($_GET['trAll'])) {
      echo $tr;
    } else {
      echo $tr . " de " . $type . " en " . $city;
    }  ?>
  </h3>

  <?php if ($results < 1) {
    echo '<h5 class="my-5 text-center">De momento no hay resultados</h5>';
  } else {
    while ($row = $searchResult[0]->fetch()) : $i = $row['property_id']; ?>
      <div class="card col-lg-4 mx-auto mt-4 px-0 rounded-5" style="width: 300px">
        <div id="prop<?php echo $row['property_id']; ?>" class="carousel slide" data-bs-touch="false">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="<?php $image = thumb($row['property_url_photo']);
                        echo substr($image, 1); ?>" class="d-block rounded-top images-card" alt="...">
            </div>
            <?php
            $data = connect();
            $data = $data->query("SELECT * FROM photos WHERE property_id='$i'");
            $galphotos = $data;
            while ($gal = $galphotos->fetch()) :
              $image = thumb($gal['photos_name']); ?>
              <div class="carousel-item">
                <img src="
                    <?php echo substr($image, 1); ?>" class="d-block rounded-top images-card" alt="...">
              </div>
            <?php endwhile; ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#prop<?php echo $row['property_id']; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#prop<?php echo $row['property_id']; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="card-body row justify-content-center">
          <h5 class="card-title text-end fs-4"><strong><?php echo $row['property_price'] ?></strong></h5>
          <h5 class="card-title mb-3"><i class="bi bi-geo-alt-fill"></i> <?php echo $row['property_location'] . ", " . $row['property_city'] ?></h5>
          <p class="card-text col-3 fs-4 bg-light rounded-3 text-center"><i class="icon-bed"></i> <?php echo $row['property_rooms'] ?> </p>
          <p class="card-text col-3 fs-4 bg-light rounded-3 text-center mx-1"><i class="icon-bath"></i> <?php echo $row['property_banios'] ?></p>
          <p class="card-text col-5 fs-5 bg-light rounded-3 text-center"><i class="icon-measure"></i> <?php echo $row['property_size'] ?> </p>
          <?php $link = linkGenerate($row['property_id'], $row['property_type'], $row['property_location'], $row['property_price']); ?>
          <a href="index.php?view=property&p=<?php echo $link; ?>" class="btn btn-primary col-6">Detalles</a>
        </div>
      </div>
  <?php endwhile;
    $data = null;
  } ?>

<!---------------------------------------------------- PAGINADOR ------------------------------------------------>
<nav class="mt-4 ">
    <ul class="pagination justify-content-center">
        <?php for ($i=1; $i<=$pages; $i++){
        ?>
      <li class="page-item"><a class="page-link" href="
      <?php 
      if (isset($_GET['trAll'])){
        echo 'index.php?view=search&trAll='.$_GET['trAll'].'&page='.$i.'"';
      }else{?>
      index.php?view=search&city=<?php echo $_GET['city']?>&type=<?php echo $_GET['type']?>&tr=<?php echo $_GET['tr']?>&page=<?php echo $i?>"<?php }?>><?php echo $i?></a></li>   
      <?php }?>
    </ul>
  </nav>
</div>

<?php include "./inc/footer.php"; ?>