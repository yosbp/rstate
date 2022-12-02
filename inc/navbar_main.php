<?php require_once "./php/main.php";
$socialdata=connect();
$socialdata=$socialdata->query("SELECT * FROM config WHERE config_id=1");
$info=$socialdata->fetch();
$socialdata=null; ?>

<nav class="navbar navbar-expand-lg mx-auto ">
    <div class="container">
      <a href='?'><img class="navbar_main_logo" src="img/Logo_prop-removebg-preview.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0 w-75">
          <li class="nav-item">
            <a class="navbar_main_link nav-link active" href="?view=search&trAll=Compra">Compra</a>
          </li>
          <li class="nav-item">
            <a class="navbar_main_link nav-link active" href="?view=search&trAll=Alquiler">Alquiler</a>
          </li>
          <li class="nav-item">
          <a class="navbar_main_link nav-link active" href="">Contacto</a>
          </li>
          <li class="nav-item">
          <p class="navbar_main_tel nav-link"><a href="<?php echo $info['config_link_whatsapp']?>" target="_blank"><i class="bi bi-telephone"></i> <?php echo $info['config_phone']?></a> </p>
          </li>
        </ul>
      </div>
    </div>
  </nav>
