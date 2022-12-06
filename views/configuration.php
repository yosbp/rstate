<?php
require_once "./inc/session.php";
require_once "./php/main.php";

//Requerimos TODOS LOS DATOS para mostrarlos en el formulario


$config_data = connect();
$config_data = $config_data->query("SELECT * FROM config");
$data = $config_data->fetch();
$config_data = null;
?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container">
        <h3 class="mt-5 text-center">Configuracion</h3>
        <div class="form-rest"></div>
        <div class="text-center loader"><img src="./img/loader.gif" alt=""></div>
        <form action="./php/configuration_modify.php" class="FormularioAjax w-50 mx-auto mt-5" method="POST" autocomplete="off">
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Telefono</strong></label>
                <input type="text" name="phone" class="form-control" required value="<?php echo $data['config_phone']; ?>" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Link Whatsapp</strong></label>
                <input type="text" name="whatsapp" class="form-control" required value="<?php echo $data['config_link_whatsapp']; ?>" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Instagram</strong></label>
                <input type="text" name="instagram" class="form-control" required value="<?php echo $data['config_instagram']; ?>" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Facebook</strong></label>
                <input type="text" name="facebook" class="form-control" required value="<?php echo $data['config_facebook']; ?>" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Twitter</strong></label>
                <input type="text" name="twitter" class="form-control" required value="<?php echo $data['config_twitter']; ?>" />
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block mb-4 text-center ">Enviar</button>
            </div>
        </form>
    </div>
</div>