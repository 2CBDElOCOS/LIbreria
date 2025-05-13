<?php
session_start();
require_once('../MODELO/LibroModel.php'); // ✅ Asegúrate de requerir el modelo aquí

$libroModel = new LibroModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $id = $_POST['id'];

    switch ($accion) {
        case 'agregar':
            $cantidad = (int) $_POST['cantidad'];

            // ✅ Verificar stock antes de agregar
            $libro = $libroModel->obtenerLibroPorId($id);

            if (!$libro) {
                header("Location: ../VISTA/libros.php?error=Libro no encontrado");
                exit;
            }

            if ($libro['stock'] < $cantidad) {
                header("Location: ../VISTA/libros.php?error=Stock insuficiente");
                exit;
            }

            // ✅ Agregar al carrito (como ya lo haces)
            if (!isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id] = [
                    'titulo' => $_POST['titulo'],
                    'autor' => $_POST['autor'],
                    'precio' => $_POST['precio'],
                    'imagen' => $_POST['imagen'],
                    'cantidad' => $cantidad
                ];
            } else {
                $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
            }

            // ✅ Actualizar stock en la base de datos
            $nuevoStock = $libro['stock'] - $cantidad;
            $libroModel->actualizarStock($id, $nuevoStock);

            header("Location: ../VISTA/libros.php#Libros");
            break;

        case 'eliminar':
            if (isset($_SESSION['carrito'][$id])) {
                // Obtener la cantidad del libro que se va a eliminar del carrito
                $cantidadEliminada = $_SESSION['carrito'][$id]['cantidad'];
                // Obtener los datos del libro
                $libro = $libroModel->obtenerLibroPorId($id);

                // Restaurar el stock en la base de datos
                $nuevoStock = $libro['stock'] + $cantidadEliminada;
                $libroModel->actualizarStock($id, $nuevoStock);

                // Eliminar del carrito
                unset($_SESSION['carrito'][$id]);
            }
            header("Location: ../VISTA/carrito.php");
            break;

        case 'actualizar':
            $nuevaCantidad = (int) $_POST['cantidad'];
            if ($nuevaCantidad > 0 && isset($_SESSION['carrito'][$id])) {
                $libro = $libroModel->obtenerLibroPorId($id);

                if ($nuevaCantidad <= $libro['stock']) {
                    // Obtener la cantidad anterior en el carrito
                    $cantidadAnterior = $_SESSION['carrito'][$id]['cantidad'];

                    // Actualizar la cantidad en el carrito
                    $_SESSION['carrito'][$id]['cantidad'] = $nuevaCantidad;

                    // Actualizar el stock en la base de datos
                    $nuevoStock = $libro['stock'] - ($nuevaCantidad - $cantidadAnterior);
                    $libroModel->actualizarStock($id, $nuevoStock);
                } else {
                    // Si la cantidad deseada es mayor que el stock, se puede mostrar un mensaje de error
                    header("Location: ../VISTA/carrito.php?error=Stock insuficiente");
                    exit;
                }
            }
            header("Location: ../VISTA/carrito.php");
            break;
    }

    exit;
}
