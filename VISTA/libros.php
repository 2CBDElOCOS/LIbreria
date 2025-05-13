<?php
session_start();
require_once('../CONTROLADOR/Controlador_libro.php');
$contador = 0;
if (isset($_SESSION['carrito'])) {
  foreach ($_SESSION['carrito'] as $item) {
    $contador += $item['cantidad'];
  }
}
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Punto y Coma - Librería</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <br>
  <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top">
      <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../assets/img/LO.ico" alt="Logo" width="60" height="60" class="me-2">
        Punto y Coma
      </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="#Libros">Catálogo</a></li>
            <li class="nav-item"><a class="nav-link" href="#Contacto">Contacto</a></li>
          </ul>
          <!-- Button trigger modal -->
      
          <button type="button" class="btn btn-primary" id="btnSubirLibro" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-file-earmark-arrow-up"></i> Cargar libro
            <span class="spinner-border spinner-border-sm d-none" id="spinner" role="status" aria-hidden="true"></span>
          </button>          
          &nbsp;
          <a href="carrito.php" class="btn btn-primary position-relative">
          <i class="bi bi-cart"></i>
            Carrito
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?= $contador ?>
              <span class="visually-hidden">items en carrito</span>
            </span>
          </a>
          &nbsp;
          <form class="d-flex" role="search" method="GET" action="index.php">
            <input class="form-control me-2" type="search" name="busqueda" placeholder="Buscar libros..." />
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
          </form>
        </div>
      </div>
    </nav>
    <div class="mb-3">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sube tu libro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../CONTROLADOR/Controlador_libro.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input type="text" class="form-control" id="autor" name="autor" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select class="form-select" id="categoria_id" name="categoria_id" required>
                                <option value="">Selecciona una categoría</option>
                                <?php while ($cat = $categorias->fetch_assoc()) { ?>
                                  <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nombre']; ?></option>
                                <?php } ?>

                            </select>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="nuevaCategoriaCheck">
                                <label class="form-check-label" for="nuevaCategoriaCheck">
                                    Agregar nueva categoría
                                </label>
                            </div>
                            <div id="nuevaCategoriaDiv" class="mt-3" style="display: none;">
                                <label for="nueva_categoria" class="form-label">Nueva Categoría</label>
                                <input type="text" class="form-control" id="nueva_categoria" name="nueva_categoria" placeholder="Escribe una nueva categoría">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del libro</label>
                            <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="subirLibro" class="btn btn-primary">Subir libro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
      <!-- HERO SECTION -->
      <header class="text-white full-height d-flex align-items-center">
        <div class="container">
          <div class="row align-items-center">
            <!-- Texto -->
            <div class="col-md-6 text-center text-md-start">
              <h1 class="display-4">Bienvenido a Punto y Coma</h1>
              <p class="lead">Tu librería online favorita. ¡Descubre, compra y disfruta!</p>
              <a href="#Libros" class="btn btn-light mt-3">Explorar libros</a>
            </div>
            <!-- Imagen -->
            <div class="col-md-6 text-center">
              <img src="../assets/img/libro.png" alt="Libros" class="img-fluid" style="max-height: 600px;" />
            </div>
          </div>
        </div>
      </header>
<!-- SECCIÓN DE FILTRO Y TÍTULO -->
<section class="container my-5" id="Libros">
  <div class="row align-items-center">
    <!-- Título a la izquierda -->
    <div class="col-12 col-md-8 mb-2 mb-md-0">
      <h2 class="mb-4">Nuestros libros</h2>
    </div>
        <!-- Filtro de categoría a la derecha -->
        <div class="col-12 col-md-4">
          <form id="form-busqueda" class="d-flex justify-content-end" method="GET" action="">
            <select id="filtro-categoria" name="categoria" class="form-select">
              <option value="">Categorías</option>
              <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"
                  <?= isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($categoria['nombre']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary ms-1">
              <i class="bi bi-search"></i>
            </button>
          </form>
        </div>
      </div>
    </section>
    <!-- SECCIÓN DE LIBROS -->
    <section class="container" id="Libros">           
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($resultado as $libro) { ?>
          <div class="col">
            <div class="card h-100">
              <img src="<?php echo '../uploads/' . basename($libro['imagen']); ?>" class="card-img-top img-libro" alt="Libro" />
              <div class="card-body">
                <h5 class="card-title"><?php echo $libro['titulo']; ?></h5>
                <p class="card-text"><?php echo $libro['descripcion']; ?></p>
                <p class="text-muted"><strong>Categoría:</strong> <?php echo $libro['categoria_nombre'] ?? 'Sin categoría'; ?></p>
                <p class="text-muted"><strong>Stock:</strong> <?php echo $libro['stock']; ?></p>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <!-- Precio alineado a la izquierda -->
                <span class="fw-bold">$<?php echo number_format($libro['precio'], 2); ?></span>

                <?php if ($libro['stock'] <= 0): ?>
                  <button class="btn btn-secondary" disabled>Agotado</button>
                <?php else: ?>
                  <!-- Contenedor para separar el precio de los otros elementos -->
                  <div class="d-flex gap-3">
                    <!-- Formulario para cantidad y botón de compra alineados a la derecha -->
                    <form action="../CONTROLADOR/ControladorCarrito.php" method="POST" class="d-flex align-items-center">
                      <input type="hidden" name="accion" value="agregar">
                      <input type="hidden" name="id" value="<?= $libro['id'] ?>">
                      <input type="hidden" name="titulo" value="<?= $libro['titulo'] ?>">
                      <input type="hidden" name="autor" value="<?= $libro['autor'] ?>">
                      <input type="hidden" name="precio" value="<?= $libro['precio'] ?>">
                      <input type="hidden" name="imagen" value="<?= $libro['imagen'] ?>">

                      <!-- Campo cantidad -->
                      <input type="number" name="cantidad" value="1" min="1" max="<?= $libro['stock'] ?>" class="form-control me-2" style="width: 70px;">
                      <!-- Botón de compra -->
                      <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-cart-plus"></i> Comprar</button>
                    </form>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-4 mt-5" id="Contacto">
      <div class="container">
        <p class="mb-1">&copy; 2025 Punto y Coma - Todos los derechos reservados.</p>
        <small>Desarrollado por Salvador Pores</small>
      </div>
    </footer>
    <!-- SCRIPTS -->
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

