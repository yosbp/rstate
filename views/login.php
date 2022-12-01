<div class="container min-vh-100">
    <div class="mb-3"><?php include "./inc/navbar_main.php" ?></div>
    <div class="login_container mt-5">
        <form action="" method="POST" autocomplete="off">
            <p class="login_title">Iniciar Sesion</p>
            <div class="inputGroup">
                <input type="text" name="login_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                <label for="name">Correo</label>
            </div>
            <div class="inputGroup">
                <input type="password" name="login_password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                <label for="name">Contraseña</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>

            <?php
            if (isset($_POST['login_user']) && isset($_POST['login_password'])) {

                require_once "./php/main.php";
                require_once "./php/login_logic.php";
            }
            ?>
        </form>
    </div>
</div>