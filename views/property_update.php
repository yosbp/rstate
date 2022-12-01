<?php
require_once "./inc/session.php";
require_once "./php/main.php";

$id = (isset($_GET['property_id_up'])) ? $_GET['property_id_up'] : 0;
$id = clean_data($id);

//Requerimos TODOS LOS DATOS para mostrarlos en el formulario
$cities = connect();
$cities = $cities->query("SELECT * FROM city");

$type = connect();
$type = $type->query("SELECT * FROM type");

$property_data = connect();
$property_data = $property_data->query("SELECT * FROM property WHERE property_id='$id' ");
$data = $property_data->fetch();
$property_data = null;

?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container">
        <h3 class="mt-5 text-center">Modificar Propiedad</h3>

        <div class="form-rest">
        <div class="text-center loader"><img src="./img/loader.gif" alt=""></div>
        </div>

        <form action="./php/property_modify.php" class="FormularioAjax w-50 mx-auto mt-5" method="POST" autocomplete="off">
            <div class="form-outline mb-4">
                <label class="form-label"><strong>Titulo de la Propiedad</strong></label>
                <input type="text" name="title" class="form-control" required value="<?php echo $data['property_title']; ?>" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label"><strong>Descripción</strong></label>
                <textarea class="form-control" name="description" rows="8"><?php echo $data['property_description']; ?></textarea>
            </div>

            <!--Parte 2-->
            <div class="row mb-4">
                <div class="col">
                    <label class="form-label"><strong>Tipo de propiedad</strong></label>
                    <select class="form-select" name="type">
                        <?php while ($row = $type->fetch()) : ?>
                            <option value="<?php echo $row['type_name']; ?>" <?php if (($row['type_name'] == $data['property_type'])) {
                                                                                echo 'selected = "selected"';
                                                                            } ?>>
                                <?php echo $row['type_name'] ?> </option>
                        <?php endwhile ?>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label"><strong>Estado de la propiedad</strong></label>
                    <select class="form-select" name="transaction_type">
                        <option value="Alquiler" <?php if (("Alquiler" == $data['property_transaction_type'])) {
                                                        echo 'selected = "selected"';
                                                    } ?>>Alquiler</option>
                        <option value="Compra" <?php if (("Compra" == $data['property_transaction_type'])) {
                                                    echo 'selected = "selected"';
                                                } ?>>Compra</option>
                    </select>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Ubicación</strong></label>
                        <input type="text" class="form-control" name="location" value="<?php echo $data['property_location']; ?>" />
                    </div>
                </div>
            </div>

            <!--Parte 3-->
            <div class="row mb-4">
                <div class="col">
                    <label class="form-label" name><strong>Habitaciones</strong></label>
                    <select class="form-select" name="rooms">
                        <?php $i = 1;
                        while ($i <= 10) : ?>
                            <option value="<?php echo $i; ?>" <?php if (($i == $data['property_rooms'])) {
                                                                    echo 'selected = "selected"';
                                                                } ?>>
                                <?php echo $i; ?> </option>
                        <?php $i++;
                        endwhile ?>
                    </select>
                </div>

                <div class="col">
                    <label class="form-label"><strong>Baños</strong></label>
                    <select class="form-select" name="banios">
                        <?php $i = 1;
                        while ($i <= 5) : ?>
                            <option value="<?php echo $i; ?>" <?php if (($i == $data['property_banios'])) {
                                                                    echo 'selected = "selected"';
                                                                } ?>>
                                <?php echo $i; ?> </option>
                        <?php $i++;
                        endwhile ?>
                    </select>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Pisos</strong></label>
                        <input type="text" name="floors" class="form-control" value="<?php echo $data['property_floors']; ?>" />
                    </div>
                </div>

                <div class="col">
                    <label class="form-label"><strong>Estacionamiento</strong></label>
                    <select class="form-select" name="garage">
                        <option value="Si" <?php if (("Si" == $data['property_garage'])) {
                                                echo 'selected = "selected"';
                                            } ?>>Si</option>
                        <option value="No" <?php if (("No" == $data['property_garage'])) {
                                                echo 'selected = "selected"';
                                            } ?>>No</option>
                    </select>
                </div>
            </div>

            <!--Parte 4-->
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Dimensiones</strong></label>
                        <input type="text" name="size" class="form-control" value="<?php echo $data['property_size']; ?>" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Precio (Alquiler o Venta)</strong></label>
                        <input type="text" name="price" class="form-control" value="<?php echo $data['property_price']; ?>" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Moneda ($ o Bsd)</strong></label>
                        <input type="text" name="currency" class="form-control" value="<?php echo $data['property_currency']; ?>" />
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col">
                    <label class="form-label"><strong>Foto Principal</strong></label>
                    <input type="file" class="form-control" accept=".jpg, .png, .jpeg" name="main_photo">
                </div>

                <div class="col">
                    <label class="form-label"><strong>Galeria de Fotos</strong></label>
                    <input type="file" class="form-control" accept="image/*" name="gal_photos[]" multiple>
                </div>
            </div>

            <!--Parte 5 - Propietario-->

            <h3 class="text-center mb-3">Datos del propietario</h1>

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label"><strong>Nombre y Apellido</strong></label>
                            <input type="text" name="owner" class="form-control" value="<?php echo $data['property_owner']; ?>" />
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label"><strong>Telefono</strong></label>
                            <input type="text" name="owner_phone" class="form-control" value="<?php echo $data['property_owner_phone']; ?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-outline mt-2 ">
                            <label class="form-label"><strong>Quien registra la propiedad?</strong></label>
                            <input type="text" name="publicby" class="form-control" value="<?php echo $data['property_publicby']; ?>" />
                        </div>
                        <div class="col form-outline mt-2 ">
                            <label class="form-label"><strong>Ciudad</strong></label>
                            <select class="form-select" name="city">
                                <?php while ($row = $cities->fetch()) : ?>
                                    <option value="<?php echo $row['city_name'] ?>" <?php if (($row['city_name'] == $data['property_city'])) {
                                                                                        echo 'selected = "selected"';
                                                                                    } ?>>
                                        <?php echo $row['city_name'] ?> </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div><input type="hidden" name="id" value="<?php echo $id; ?>" /></div>
                <div><input type="hidden" name="image" value="<?php echo $data['property_url_photo']; ?>" /></div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block mb-4 text-center ">Enviar</button>
                </div>
        </form>
    </div>
</div>

<?php
$type = null;
$cities = null
?>