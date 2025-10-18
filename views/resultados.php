<?php
// Cargar las clases
include '../clases/Producto.php';
include '../clases/Camiseta.php';
include '../clases/Pantalon.php';
include '../clases/Gorra.php';

// Recibir datos del formulario
$producto = $_POST['producto'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$precio = (float)($_POST['precio'] ?? 0);
$cantidad = (int)($_POST['cantidad'] ?? 1);
$descuento = (float)($_POST['descuento'] ?? 0);

// Según el tipo de producto, instanciamos la clase adecuada
$objeto = null;
$atributoExtra = '';

switch ($producto) {
    case 'camiseta':
        $talla = $_POST['talla'] ?? '';
        $objeto = new Camiseta($nombre, $precio, $cantidad, $talla);
        $atributoExtra = "Talla: $talla";
        break;

    case 'pantalon':
        $tipo = $_POST['tipo'] ?? '';
        $objeto = new Pantalon($nombre, $precio, $cantidad, $tipo);
        $atributoExtra = "Tipo: $tipo";
        break;

    case 'gorra':
        $tamano = $_POST['tamano'] ?? '';
        $objeto = new Gorra($nombre, $precio, $cantidad, $tamano);
        $atributoExtra = "Tamaño: $tamano";
        break;

    default:
        header('Location: ../index.php');
    exit;
}

// Cálculos
$totalSinDescuento = $objeto->calcularTotal();
$totalConDescuento = $descuento > 0 ? $objeto->calcularDescuento($descuento) : $totalSinDescuento;
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
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Resumen del pedido</h1>

    <div class="card shadow p-4">
        <h4 class="card-title mb-3"><?= htmlspecialchars($objeto->getNombre()) ?></h4>
        <p><strong>Precio unitario:</strong> <?= number_format($objeto->getPrecio(), 2) ?> €</p>
        <p><strong>Cantidad:</strong> <?= $objeto->getCantidad() ?></p>
        <p><strong><?= $atributoExtra ?></strong></p>
        <hr>
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
</div>

</body>
</html>
