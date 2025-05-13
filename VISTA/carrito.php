<?php
session_start();
require_once('../CONTROLADOR/Controlador_libro.php');
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
  <body class="d-flex flex-column min-vh-100">
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
            <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <br><br><br>
    <!-- CARRITO -->
    <div class="container d-flex justify-content-center my-5">
      <div class="card shadow-lg rounded-4 col-md-8">
        <div class="card-header bg-primary text-white rounded-top-4">
          <h4 class="mb-0 text-center">🛒 Tu Carrito de Compras</h4>
        </div>
        <div class="card-body">
          <?php if (!empty($_SESSION['carrito'])): ?>
            <div class="table-responsive">
              <table class="table align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Libro</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                  foreach ($_SESSION['carrito'] as $id => $item):
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($item['titulo']) ?></td>
                      <td>$<?= number_format($item['precio'], 2) ?></td>
                      <td>
                        <form method="POST" action="../CONTROLADOR/ControladorCarrito.php" class="d-flex align-items-center">
                          <input type="hidden" name="accion" value="actualizar">
                          <input type="hidden" name="id" value="<?= $id ?>">
                          <input type="number" name="cantidad" value="<?= $item['cantidad'] ?>" min="1" class="form-control form-control-sm me-2" style="width: 80px;">
                          <button type="submit" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                        </form>
                      </td>
                      <td>$<?= number_format($subtotal, 2) ?></td>
                      <td>
                        <form method="POST" action="../CONTROLADOR/ControladorCarrito.php" class="m-0">
                          <input type="hidden" name="accion" value="eliminar">
                          <input type="hidden" name="id" value="<?= $id ?>">
                          <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash3-fill"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <h5 class="mb-0">Total: $<?php echo number_format($total, 2); ?></h5>
              <a href="thanks.php" class="btn btn-success px-4">Finalizar Compra</a>
            </div>
          <?php else: ?>
            <p class="text-muted text-center mb-0">Tu carrito está vacío.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- SCRIPTS -->
    <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
