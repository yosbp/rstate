<?php require_once "./inc/datas_main.php";
require_once "./inc/imageresize.php";
require_once "./inc/linkgenerator.php"; ?>

<div class="header_main w-100 container-fluid">
  <div><?php include "./inc/navbar_main.php" ?></div>
  <div class="header_content">
    <div class="header_content_text ">
      <h2 class="header_content_title">Consigue el Hogar <br> que se adapte a ti.</h2>
      <p class="header_content_subtitle">A medida que su familia crece, también lo hace su hogar. Elija entre una amplia gama de opciones para encontrar el estilo, ublicación y el tamaño perfectos que complementen su estilo de vida.</p>
      <div class="header_value">
        <div>
          <h1 class="header_value-number">
            1k <span class="header_value-plus">+</span>
          </h1>
          <span class="header_value-description">
            Propiedades <br> Vendidas
          </span>
        </div>
        <div>
          <h1 class="header_value-number">
            1.5k <span class="header_value-plus">+</span>
          </h1>
          <span class="header_value-description">
            Clientes <br> Felices
          </span>
        </div>
        <div>
          <h1 class="header_value-number">
            15 <span class="header_value-plus">+</span>
          </h1>
          <span class="header_value-description">
            Ciudades
          </span>
        </div>
      </div>
    </div>

    <div class="container text-center search-mod">
      <form class="form_search" method="post" action="index.php?view=search">
        <h4>Busca según lo que necesites:</h3>
          <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 mb-3 form-group">
              <label><strong>Ciudad</strong></label>
              <select name="city" class="form-select">
                <?php while ($row = $cities->fetch()) : ?>
                  <option value="<?php echo $row['city_name'] ?>">
                    <?php echo $row['city_name'] ?> </option>
                <?php endwhile ?>
              </select>
            </div>
            <div class="col-sm-6 col-md-3 form-group">
              <label><strong>Tipo</strong></label>
              <select name="type" class="form-select">
                <?php while ($row = $types->fetch()) : ?>
                  <option value="<?php echo $row['type_name'] ?>">
                    <?php echo $row['type_name'] ?> </option>
                <?php endwhile ?>
              </select>
            </div>
            <div class="col-sm-6 col-md-3 form-group">
              <label><strong>Transacción</strong></label>
              <select name="tr" class="form-select">
                <option value="Compra">Compra</option>
                <option value="Alquiler">Alquiler</option>
              </select>
            </div class>
            <button type="submit" class="mt-2 align-self-center btn btn-secondary btn-search btn-sm col-sm-6 col-md-2 ">Buscar</button>
          </div>
      </form>
    </div>
  </div>
</div>


<div class="container-fluid row justify-content-center mx-auto">
  <h1 class="text-center mt-5">Ultimas propiedades listadas</h1>
  <?php while ($row = $last5->fetch()) : $i = $row['property_id']; ?>
    <div class="card col-lg-4 mx-3 mt-4 px-0 rounded-5" style="width: 320px">
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
  $data = null; ?>
</div>

<div class="container my-5">
  <h1 class="text-center my-5">Servicios</h1>
  <div class="services">
    <div class="services_photo"> <img class="services_img" src="./img/imgservice1.jpg" alt=""> </div>
    <div class="services_info">
      <h3>Compra con nosotros</h3>
      <p>Busque en nuestra amplia selección de propiedades, casas y terrenos para encontrar el lugar perfecto para usted. Le ayudaremos a ponerse en contacto con el agente, a reservar visita y todo el tramite legal.</p>
      <a href="index.php?view=search&trAll=Compra" class="w-25">Explora Ofertas</a>
    </div>
  </div>

  <div class="services">
    <div class="services_photo img-disabled"> <img class="services_img" src="./img/imgservice2.jpg" alt=""> </div>
    <div class="services_info">
      <h3>Alquileres disponibles para ti!</h3>
      <p>No vas a encontrar un lugar mejor para vivir que con nosotros. Ofrecemos la mejor calidad y servicio para cualquier persona que necesite un hogar y un excelente lugar para vivir.</p>
      <a href="index.php?view=search&trAll=Alquiler" class="w-25">Explora Ofertas</a>
    </div>
    <div class="services_photo img-active"> <img class="services_img" src="./img/imgservice2.jpg" alt=""> </div>
  </div>

  <div class="services">
    <div class="services_photo"> <img class="services_img" src="./img/imgservice3.jpg" alt=""> </div>
    <div class="services_info">
      <h3>Oferta tu propiedad</h3>
      <p>Contamos con un equipo de expertos que se encargan de ayudarte en cada paso del proceso. Brindamos valoración, mercadeo y negociación de propiedades. No más llamadas telefónicas estresantes con extraños.</p>
      <a href="index.php?view=search&trAll=Compra" class="w-25">Contactanos</a>
    </div>
  </div>

</div>

<?php include "./inc/footer.php"; ?>