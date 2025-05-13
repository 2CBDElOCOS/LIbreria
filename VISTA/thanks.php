<?php
session_start();
unset($_SESSION['carrito']); // 🧹 Vaciar el carrito
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gracias por tu compra</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/thanks.css">
</head>
<body>

  <div class="container thank-you-container">
    <h1>¡Gracias por tu compra!</h1>
    <p>Tu pedido ha sido procesado exitosamente. ¡Esperamos verte de nuevo pronto!</p>
    <a href="index.php" class="btn btn-home">Volver al inicio</a>
  </div>
</body>
</html>
