<div class="pt-3">
    <div class=><?php include "./inc/navbar_main.php"?></div>

<section class="contact">
  <h2 class="mb-5">Contáctanos</h2>

  <div class="contact__container ">
    <div class="contact__content">
      <h3 class="contact__title">Escribenos</h3>

      <div class="contact__info">
        <div class="contact__card">
          <i class="bx bx-mail-send contact__card-icon"></i>
          <h3 class="contact__card-title">Correo</h3>
          <span class="contact__card-data">inmobiliaria@gmail.com</span>

          <a href="mailto:examplemail@correo.com" target="_blank" class="contact__button">
          Escríbenos
            <i class="bi bi-arrow-right contact__button-icon"></i>
          </a>
        </div>

        <div class="contact__card">
          <i class="bx bxl-whatsapp contact__card-icon"></i>
          <h3 class="contact__card-title">Whatsapp</h3>
          <span class="contact__card-data">999-999-999</span>

          <a href="https://api.whatsapp.com/send?phone=51123456789&text=Hola!, quiero más información" target="_blank" class="contact__button">
          Escríbenos
            <i class="bi bi-arrow-right contact__button-icon"></i>
          </a>
        </div>

        <div class="contact__card">
          <i class="bx bxl-messenger contact__card-icon"></i>
          <h3 class="contact__card-title">Messenger</h3>
          <span class="contact__card-data">user.fb123</span>

          <a href="#" target="_blank" class="contact__button">
            Escríbenos
            <i class="bi bi-arrow-right contact__button-icon"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="contact__content">
      <h3 class="contact__title">En qué estás interesado?</h3>

      <form action="" class="contact__form">
        <div class="contact__form-div">
          <label class="contact__form-tag">Names</label>
          <input type="text" placeholder="Ingresa tu nombre completo" class="contact__form-input" />
        </div>

        <div class="contact__form-div">
          <label class="contact__form-tag">Mail</label>
          <input type="email" placeholder="Ingresa tu correo" class="contact__form-input" />
        </div>

        <div class="contact__form-div contact__form-area">
          <label class="contact__form-tag">Correo</label>
          <textarea name="" id="" cols="30" rows="10" placeholder="Write your project" class="contact__form-input"></textarea>
        </div>

        <button class="contact__button-form">Enviar Correo</button>
      </form>
    </div>
  </div>
</section>
</div>

<?php include "./inc/footer.php"; ?>