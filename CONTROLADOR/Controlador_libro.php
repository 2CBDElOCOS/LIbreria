<?php
require_once('../MODELO/LibroModel.php');

$libroModel = new LibroModel();

// SUBIR LIBRO
if (isset($_POST['subirLibro'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria_id'];
    $nueva_categoria = isset($_POST['nueva_categoria']) ? $_POST['nueva_categoria'] : null;

    // Procesar imagen
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $imagen = 'uploads/' . $nombreArchivo;
    $rutaImagen = __DIR__ . '/../uploads/' . $nombreArchivo;

    // Si la categoría es nueva y no existe, crearla
    if ($nueva_categoria && !$libroModel->categoriaExiste($nueva_categoria)) {
        $categoria = $libroModel->insertarCategoria($nueva_categoria);
    }

    // Subir la imagen y luego insertar el libro
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        if ($libroModel->insertarLibro($titulo, $autor, $descripcion, $precio, $stock, $imagen, $categoria)) {
            header("Location: ../VISTA/libros.php?mensaje=Libro subido exitosamente");
        } else {
            header("Location: ../VISTA/libros.php?mensaje=Error al insertar el libro");
        }
        exit();
    } else {
        header("Location: ../VISTA/libros.php?mensaje=Error al subir la imagen");
        exit();
    }
}

// ✅ Buscar libros por texto si se envía parámetro de búsqueda
if (isset($_GET['busqueda']) && !empty(trim($_GET['busqueda']))) {
    $busqueda = trim($_GET['busqueda']);
    $resultado = $libroModel->buscarLibros($busqueda);
}
// ✅ Si no hay búsqueda, filtrar por categoría si está presente
elseif (isset($_GET['categoria']) && is_numeric($_GET['categoria'])) {
    $resultado = $libroModel->obtenerLibrosPorCategoria($_GET['categoria']);
}
// ✅ Si no hay filtro, mostrar todos
else {
    $resultado = $libroModel->obtenerLibrosConCategoria();
}

// ✅ Siempre obtener las categorías
$categorias = $libroModel->obtenerCategorias();
