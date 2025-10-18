<?php
// Incluimos las clases necesarias para crear objetos de los diferentes productos
include '../clases/Producto.php';
include '../clases/Camiseta.php';
include '../clases/Pantalon.php';
include '../clases/Gorra.php';

// Capturamos los datos enviados vía POST del formulario, usando valores por defecto si no existen
$producto = $_POST['producto'] ?? '';      // Tipo de producto (camiseta, pantalón, gorra)
$nombre = $_POST['nombre'] ?? '';          // Nombre del producto
$precio = (float)($_POST['precio'] ?? 0);  // Precio del producto (convertido a float)
$cantidad = (int)($_POST['cantidad'] ?? 1);// Cantidad del producto (convertido a int)

// Según el tipo de producto, creamos el objeto correspondiente
switch ($producto) {
    case 'camiseta':
        $talla = $_POST['talla'] ?? '';            // Captura la talla de la camiseta
        $objeto = new Camiseta($nombre, $precio, $cantidad, $talla); // Crea un objeto Camiseta
        break;
    case 'pantalon':
        $tipo = $_POST['tipo'] ?? '';               // Captura el tipo de pantalón
        $objeto = new Pantalon($nombre, $precio, $cantidad, $tipo);  // Crea un objeto Pantalon
        break;
    case 'gorra':
        $tamano = $_POST['tamano'] ?? '';           // Captura el tamaño de la gorra
        $objeto = new Gorra($nombre, $precio, $cantidad, $tamano);   // Crea un objeto Gorra
        break;
    default:
        // Si no se envió un producto válido, redirige al inicio
        header('Location: ../index.php');
        exit;
}
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
        <?= $objeto ?> <!-- Aquí se imprime TODO del __toString -->
        <div class="text-center mt-4">
            <a href="../index.php" class="btn btn-secondary w-100 mt-3">Volver al inicio</a>
        </div>
    </div>
</div>

</body>
</html>
