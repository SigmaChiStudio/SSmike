<?php
include '../controller/carrito.php';
require_once '../controller/conexion.php'; // Ajusta la ruta si es necesario

// Consulta todos los productos
$productos = $conexion->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_OBJ);

// Agrupa productos por categoría
$categorias = [
    'maquillaje' => [],
    'skincare' => [],
    'fragancias' => [],
    'accesorios' => []
];

foreach ($productos as $prod) {
    $cat = strtolower($prod->categoria);
    if (isset($categorias[$cat])) {
        $categorias[$cat][] = $prod;
    }
}
?>
<body>
<!-- COLECCIÓN -->
  <section class="page-section" id="collection">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">COLECCIÓN</h2>
        <h3 class="section-subheading text-muted">
          Encuentra los mejores productos de belleza femenina: maquillaje, skincare, fragancias y accesorios. ¡Elige tu estilo y luce increíble!
        </h3>
      </div>
      <hr>

      <div class="text-center mb-4" id="products-grid">
        <div class="btn-group" role="group" aria-label="Filtros de categoría">
          <button type="button" class="btn btn-primary filter-btn active" data-filter="all">Todos</button>
          <button type="button" class="btn btn-outline-primary filter-btn" data-filter="maquillaje">Maquillaje</button>
          <button type="button" class="btn btn-outline-primary filter-btn" data-filter="skincare">Skincare</button>
          <button type="button" class="btn btn-outline-primary filter-btn" data-filter="fragancias">Fragancias</button>
          <button type="button" class="btn btn-outline-primary filter-btn" data-filter="accesorios">Accesorios</button>
        </div>
      </div>

      <!-- GRID DE PRODUCTOS -->
      <div class="row">
        <!-- Ejemplo de producto con funcionalidad de agregar al carrito -->
        <?php foreach ($productos as $prod): ?>
          <div class="col-lg-3 col-sm-6 mb-4 product-item" data-category="<?php echo strtolower($prod->categoria); ?>">
            <div class="card h-100">
              <img class="card-img-top" src="<?php echo htmlspecialchars($prod->imagen); ?>" alt="<?php echo htmlspecialchars($prod->nombre); ?>" />
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($prod->nombre); ?></h5>
                <p class="card-text">$<?php echo number_format($prod->precio, 0, ',', '.'); ?> COP</p>
              </div>
              <div class="card-footer text-center">
                <form action="../controller/carrito.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $prod->id; ?>">
                  <input type="hidden" name="cantidad" value="1">
                  <button type="submit" name="btnAccion" value="Agregar" class="btn btn-sm btn-primary">Agregar al Carrito</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ¿QUIÉNES SOMOS? -->
  <section class="page-section" id="about">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">¿QUIÉNES SOMOS?</h2>
        <hr>
        <h3 class="section-subheading text-muted">
          Somos una tienda especializada en productos de belleza femenina. Trabajamos con marcas reconocidas y te ofrecemos atención personalizada, precios justos y productos de calidad.
        </h3>
      </div>
    </div>
  </section>

   <!-- NUESTRO EQUIPO -->
<section class="page-section bg-light2" id="team">
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase">NUESTRO EQUIPO DE TRABAJO</h2>
      <h3 class="section-subheading text-muted">"El que tenga miedo a morir que no nazca".</h3>
    </div>
    <div class="row">
      <div class="col-lg-3">
        <div class="team-member">
          <img class="mx-auto rounded-circle" src="model/img/team/1.jpg" alt="" />
          <h4>Valentina Gómez</h4>
          <p class="text-muted">Líder de Proyecto</p>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fa fa-paper-plane"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="team-member">
          <img class="mx-auto rounded-circle" src="model/img/team/2.jpg" alt="" />
          <h4>Camila Torres</h4>
          <p class="text-muted">Desarrolladora Web</p>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fa fa-paper-plane"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="team-member">
          <img class="mx-auto rounded-circle" src="model/img/team/3.jpg" alt="" />
          <h4>Juan Pérez</h4>
          <p class="text-muted">Diseñador Gráfico</p>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fa fa-paper-plane"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="team-member">
          <img class="mx-auto rounded-circle" src="model/img/team/4.jpg" alt="" />
          <h4>Sofía Ramírez</h4>
          <p class="text-muted">Productora Visual</p>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fa fa-paper-plane"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="col-lg-12 d-flex justify-content-center mt-4">
        <div class="team-member">
          <img class="mx-auto rounded-circle" src="model/img/team/55.jpg" alt="" />
          <h4>Andrés Castillo</h4>
          <p class="text-muted">Analista de Datos</p>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fa fa-paper-plane"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <p class="large text-muted">"El talento gana partidos, pero el trabajo en equipo y la inteligencia gana campeonatos".</p>
      </div>
    </div>
  </div>
</section>

  <!-- CONTACTO -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Contáctanos</h2>
        <h3 class="section-subheading text-muted">
          Registra tus datos para poder contactar con nuestro personal si tienes inquietudes o deseas más información sobre nuestros productos.
        </h3>
      </div>
      <form id="contactForm" name="sentMessage" novalidate="novalidate" action="controller/mensaje.php">
        <div class="row align-items-stretch mb-5">
          <div class="col-md-6">
            <div class="form-group">
              <input class="form-control" id="name" type="text" placeholder="Nombre completo *" required="required" data-validation-required-message="Por favor ingresa tu nombre completo." />
            </div>
            <div class="form-group">
              <input class="form-control" id="email" type="email" placeholder="Correo Electrónico *" required="required" data-validation-required-message="Por favor ingresa tu correo electrónico." />
            </div>
            <div class="form-group mb-md-0">
              <input class="form-control" id="phone" type="tel" placeholder="Teléfono / Celular *" required="required" data-validation-required-message="Por favor ingresa tu número de teléfono o celular." />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-group-textarea mb-md-0">
              <textarea class="form-control" id="message" placeholder="Mensaje / Comentario *" required="required" data-validation-required-message="Por favor ingresa tu mensaje."></textarea>
            </div>
          </div>
        </div>
        <div class="text-center">
          <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">ENVIAR MENSAJE</button>
        </div>
      </form>
    </div>
  </section>

  <!-- SCRIPT FILTROS -->
  <script>
    (function(){
      const buttons = document.querySelectorAll('.filter-btn');
      const items = document.querySelectorAll('.product-item');
      function setActiveButton(clicked){
        buttons.forEach(b => {
          b.classList.remove('active','btn-primary');
          b.classList.add('btn-outline-primary');
        });
        clicked.classList.add('active','btn-primary');
        clicked.classList.remove('btn-outline-primary');
      }
      function filter(cat){
        items.forEach(it => {
          const itemCat = it.getAttribute('data-category');
          it.style.display = (cat === 'all' || itemCat === cat) ? '' : 'none';
        });
      }
      buttons.forEach(b => b.addEventListener('click',function(){
        setActiveButton(this);
        filter(this.getAttribute('data-filter'));
      }));
      filter('all');
    })();
  </script>
</body>