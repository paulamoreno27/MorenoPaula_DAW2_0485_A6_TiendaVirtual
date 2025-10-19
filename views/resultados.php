<?php
// Incluimos las clases necesarias
include_once '../clases/Producto.php';
include_once '../clases/Camiseta.php';
include_once '../clases/Pantalon.php';
include_once '../clases/Gorra.php';

// Capturamos los datos del formulario
$producto = $_POST['producto'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$precio = (float)($_POST['precio'] ?? 0);
$cantidad = (int)($_POST['cantidad'] ?? 1);
$descuento = isset($_POST['descuento']) && $_POST['descuento'] !== '' ? (float)$_POST['descuento'] : null;

// Creamos el objeto correcto según el tipo
switch ($producto) {
    case 'camiseta':
        $talla = $_POST['talla'] ?? '';
        $objeto = new Camiseta($nombre, $precio, $cantidad, $talla);
        break;
    case 'pantalon':
        $tipo = $_POST['tipo'] ?? '';
        $objeto = new Pantalon($nombre, $precio, $cantidad, $tipo);
        break;
    case 'gorra':
        $tamano = $_POST['tamano'] ?? '';
        $objeto = new Gorra($nombre, $precio, $cantidad, $tamano);
        break;
    default:
        header('Location: ../index.php');
        exit;
}

// Totales (sin modificar el __toString)
$totalSinDescuento = $objeto->calcularTotal();
$totalConDescuento = $descuento !== null ? $objeto->calcularDescuento($descuento) : $totalSinDescuento;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen del pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Resumen del pedido</h1>

    <div class="card shadow p-4">
        <div class='card-title'>
        <!-- AQUÍ se usa tu __toString() -->
        <?= $objeto ?>

        <p><strong>Total sin descuento:</strong> <?= number_format($totalSinDescuento, 2) ?> €</p>

        <!-- Aquí complementamos con datos que dependen del usuario -->
        <?php if ($descuento !== null): ?>
            <p><strong>Descuento aplicado:</strong> <?= number_format($descuento, 2) ?>%</p>
            <p><strong>Total con descuento:</strong> <?= number_format($totalConDescuento, 2) ?> €</p>
        <?php endif; ?>
        <div class="text-center mt-4">
            <a href="../index.php" class="btn btn-secondary w-100 mt-3">Volver al inicio</a>
        </div>
    </div>
    <div>
</div>

</body>
</html>
