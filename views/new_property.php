<?php 
require_once "./php/main.php";
require_once "./inc/session.php";
    
    //Requerimos datos de la ciudad y tipos
    $cities=connect();
    $cities=$cities->query("SELECT * FROM city");

    $type=connect();
    $type=$type->query("SELECT * FROM type");
?>

<div class="pages_division">
    <div><?php include "./inc/navbar.php" ?></div>
    <div class="dashboard_container">
        <h3 class="mt-5 text-center">Nueva Propiedad</h3>

        <div class="form-rest">
        <div class="text-center loader"><img src="./img/loader.gif" alt=""></div>
        </div>

        <form action="./php/property_save.php" class="FormularioAjax w-50 mx-auto mt-5"  method="POST" autocomplete="off" >
            <div class="form-outline mb-4">
                <label class="form-label" ><strong>Titulo de la Propiedad</strong></label> 
                <input type="text" name="title" class="form-control" required />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label"><strong>Descripción</strong></label> 
                <textarea class="form-control" name="description" required rows="8"></textarea>
            </div>

            <!--Parte 2-->
            <div class="row mb-4">
                <div class="col">
                    <label class="form-label"><strong>Tipo de propiedad</strong></label> 
                    <select class="form-select" name="type">
                    <?php while ($row = $type->fetch()) : ?>
                        <option value="<?php echo $row['type_name'] ?>">
                        <?php echo $row['type_name'] ?> </option>
                        <?php endwhile ?>
                    </select>
                </div>

                <div class="col">
                    <label class="form-label"><strong>Estado de la propiedad</strong></label> 
                    <select class="form-select" name="transaction_type">
                        <option value="Alquiler">Alquiler</option>
                        <option value="Compra">Compra</option>
                    </select>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Ubicación</strong></label> 
                        <input type="text" class="form-control" required name="location"/>
                    </div>
                </div>
            </div>

            <!--Parte 3-->
            <div class="row mb-4">
                <div class="col">
                    <label class="form-label" name><strong>Habitaciones</strong></label> 
                    <select class="form-select" name="rooms">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6+">6+</option>
                    </select>
                </div>

                <div class="col">
                    <label class="form-label"><strong>Baños</strong></label>
                    <select class="form-select" name="banios">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6+">6+</option>
                    </select>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Pisos</strong></label> 
                        <input type="text" name="floors" required class="form-control" />
                    </div>
                </div>

                <div class="col">
                    <label class="form-label" ><strong>Estacionamiento</strong></label> 
                    <select class="form-select" name="garage">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

            <!--Parte 4-->
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Dimensiones</strong></label> 
                        <input type="text" name="size" class="form-control" required placeholder="Ej: 50mts" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Precio (Alquiler o Venta)</strong></label> 
                        <input type="number" name="price" class="form-control" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label class="form-label"><strong>Moneda ($ o Bsd)</strong></label> 
                        <select class="form-select" name="currency">
                        <option value="$">$</option>
                        <option value="Bsd">Bsd</option>
                    </select>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
            <div class="col">
                        <label class="form-label" ><strong>Foto Principal</strong></label> 
                        <input type="file" class="form-control" accept=".jpg, .png, .jpeg" name="main_photo" required>
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                    </div>

                <div class="col">
                        <label class="form-label" ><strong>Galeria de Fotos</strong></label> 
                        <input type="file" class="form-control" accept="image/*" name="gal_photos[]" multiple>
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                    </div>
            </div>

            <!--Parte 5 - Propietario-->

            <h3 class="text-center mb-3">Datos del propietario</h1> 

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label"><strong>Nombre y Apellido</strong></label> 
                            <input type="text" name="owner" required class="form-control" />
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label"><strong>Telefono</strong></label> 
                            <input type="text" name="owner_phone" required class="form-control" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-outline mt-2 ">
                            <label class="form-label"><strong>Quien registra la propiedad?</strong></label> 
                            <input type="text" name="publicby" required class="form-control" />
                        </div>
                        <div class="col form-outline mt-2 ">
                            <label class="form-label"><strong>Ciudad</strong></label> 
                            <select class="form-select" name="city">
                                <?php while ($row = $cities->fetch()) : ?>
                                <option value="<?php echo $row['city_name'] ?>">
                                    <?php echo $row['city_name'] ?> </option>
                                <?php endwhile ?>
                            </select>
                        </div>
                </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block mb-4 text-center ">Enviar</button>
                </div>
        </form>
    </div>
    
</div>

<?php 
$type=null; 
$cities=null 
?>