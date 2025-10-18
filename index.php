<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tienda Online de Ropa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="./img/bag-shopping-solid-full.ico">
</head>

<body class="bg-light"><!-- Fondo Bootstrap -->

<div class="container mt-5">

  <h1 class="text-center mb-4">Tienda Online de Ropa</h1>

  <!-- Formulario principal -->
    <!-- class="card p-4 shadow-sm": aplica estilos de tarjeta con sombra -->
  <form id="formulario" action="./views/resultados.php" method="POST" class="card p-4 shadow-sm">

    <!-- Campo: Tipo de producto -->
    <div class="mb-3">
      <label for="producto" class="form-label">Tipo de producto</label>
      <select name="producto" id="producto" class="form-select">
        <option value="">-- Selecciona --</option>
        <option value="camiseta">Camiseta</option>
        <option value="pantalon">Pantalón</option>
        <option value="gorra">Gorra</option>
      </select>
      <!-- Aquí aparecerán los mensajes de error si el usuario no selecciona nada -->
      <div id="producto-error" class="text-danger small mt-1"></div>
    </div>

    <!-- Campo: Nombre del producto -->
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre del producto</label>
      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: Camiseta rota negra">
      <div id="nombre-error" class="text-danger small mt-1"></div>
    </div>

    <!-- Campo: Precio unitario -->
    <div class="mb-3">
      <label for="precio" class="form-label">Precio unitario (€)</label>
      <input type="text" name="precio" id="precio" class="form-control">
      <div id="precio-error" class="text-danger small mt-1"></div>
    </div>

    <!-- Campo: Cantidad -->
    <div class="mb-3">
      <label for="cantidad" class="form-label">Cantidad</label>
      <input type="text" name="cantidad" id="cantidad" class="form-control">
      <div id="cantidad-error" class="text-danger small mt-1"></div>
    </div>

    <!-- Aquí se insertarán dinámicamente los campos específicos 
         (por ejemplo, talla o tipo) según el producto seleccionado -->
    <div id="campos-especificos"></div>

    <!-- Campo: Descuento -->
    <div class="mb-3">
      <label for="descuento" class="form-label">Descuento (%)</label>
      <input type="text" name="descuento" id="descuento" class="form-control" value="0">
      <div id="descuento-error" class="text-danger small mt-1"></div>
    </div>

    <!-- w-100 hace que ocupe todo el ancho -->
    <button type="submit" class="btn btn-primary w-100">Ver resumen</button>
  </form>
</div>

<script src="./js/validaciones.js"></script>

</body>
</html>
