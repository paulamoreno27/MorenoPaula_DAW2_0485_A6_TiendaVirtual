<?php
// Incluimos los archivos donde están definidas las clases del proyecto
include '../clases/Producto.php';
include '../clases/Camiseta.php';
include '../clases/Pantalon.php';
include '../clases/Gorra.php';

// Se obtienen los datos enviados mediante POST desde el formulario
// El operador ?? evita errores si algún campo no existe
$producto = $_POST['producto'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$precio = (float)($_POST['precio'] ?? 0);
$cantidad = (int)($_POST['cantidad'] ?? 1);
$descuento = (float)($_POST['descuento'] ?? 0);

// Según el tipo de producto seleccionado, creamos el objeto correspondiente
$objeto = null;           // Aquí guardaremos el objeto final (Camiseta, Pantalon o Gorra)
$atributoExtra = '';      // Texto extra que se mostrará (talla, tipo o tamaño)

// Estructura switch para decidir qué clase crear
switch ($producto) {
    case 'camiseta':
        // Si el producto es una camiseta, obtenemos la talla y creamos el objeto
        $talla = $_POST['talla'] ?? '';
        $objeto = new Camiseta($nombre, $precio, $cantidad, $talla);
        $atributoExtra = "Talla: $talla";
        break;

    case 'pantalon':
        // Si el producto es un pantalón, obtenemos su tipo (jeans, chinos, etc.)
        $tipo = $_POST['tipo'] ?? '';
        $objeto = new Pantalon($nombre, $precio, $cantidad, $tipo);
        $atributoExtra = "Tipo: $tipo";
        break;

    case 'gorra':
        // Si el producto es una gorra, obtenemos su tamaño
        $tamano = $_POST['tamano'] ?? '';
        $objeto = new Gorra($nombre, $precio, $cantidad, $tamano);
        $atributoExtra = "Tamaño: $tamano";
        break;

    default:
        // Si el producto no coincide con ninguno (error o acceso directo),
        // redirigimos al index para evitar errores
        header('Location: ../index.php');
        exit;
}

// Total sin descuento = precio * cantidad (método de la clase Producto)
$totalSinDescuento = $objeto->calcularTotal();

// Si hay descuento, usamos el método calcularDescuento(), si no, el total normal
$totalConDescuento = $descuento > 0 ? 
    $objeto->calcularDescuento($descuento) : 
    $totalSinDescuento;

// Diferencia entre el total sin descuento y con descuento (lo que ahorra el cliente)
$ahorro = $totalSinDescuento - $totalConDescuento;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen del pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./img/cart-shopping-solid-full.ico">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Resumen del pedido</h1>

   <div class="card shadow p-4">

    <!-- Título del producto -->
    <h4 class="card-title mb-3"><?= htmlspecialchars($objeto->getNombre()) ?></h4>

    <!-- Mostrar __toString() -->
    <p><strong>Producto:</strong> <?= $objeto ?></p>

    <!-- Datos principales -->
    <p><strong>Precio unitario:</strong> <?= number_format($objeto->getPrecio(), 2) ?> €</p>
    <p><strong>Cantidad:</strong> <?= $objeto->getCantidad() ?></p>
    <p><strong><?= $atributoExtra ?></strong></p>

    <hr>

    <!-- Totales -->
    <p><strong>Total sin descuento:</strong> <?= number_format($totalSinDescuento, 2) ?> €</p>
    <p><strong>Descuento aplicado:</strong> <?= $descuento ?> %</p>
    <p><strong>Total con descuento:</strong> <?= number_format($totalConDescuento, 2) ?> €</p>

    <?php if ($ahorro > 0): ?>
        <p class="text-success"><strong>Has ahorrado:</strong> <?= number_format($ahorro, 2) ?> €</p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../index.php" class="btn btn-secondary w-100 mt-3">Volver al inicio</a>
    </div>
</div>
</body>
</html>
