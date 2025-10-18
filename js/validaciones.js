// Mostrar campos según el tipo
const productoSelect = document.getElementById("producto");
const camposDiv = document.getElementById("campos-especificos");

productoSelect.addEventListener("change", () => {
  const tipo = productoSelect.value;
  let campos = "";

  if (tipo === "camiseta") {
    campos = `
      <div class="mb-3">
        <label for="talla" class="form-label">Talla</label>
        <input type="text" name="talla" id="talla" class="form-control" placeholder="Ej: 12-13, XS, S, XL">
        <div id="talla-error" class="text-danger small mt-1"></div>
      </div>`;
  } else if (tipo === "pantalon") {
    campos = `
      <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de pantalón</label>
        <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Ej: Pantalón tejano campana">
        <div id="tipo-error" class="text-danger small mt-1"></div>
      </div>`;
  } else if (tipo === "gorra") {
    campos = `
      <div class="mb-3">
        <label for="tamano" class="form-label">Tamaño</label>
        <input type="text" name="tamano" id="tamano" class="form-control" placeholder="Ej: Gorra NBA">
        <div id="tamano-error" class="text-danger small mt-1"></div>
      </div>`;
  }

  camposDiv.innerHTML = campos;

  // Reasignar eventos en tiempo real para los campos dinámicos
  asignarEventosTiempoReal();
});

// Función genérica de validación
function validarCampo(campo, tipo = "texto") {
  const errorDiv = document.getElementById(campo.id + "-error");
  const valor = campo.value.trim();

  campo.classList.remove("error-input");
  if (errorDiv) errorDiv.textContent = "";

  if (valor === "") {
    campo.classList.add("error-input");
    if (errorDiv) errorDiv.textContent = "*Este campo no puede estar vacío";
    return false;
  }

  if (tipo === "numero") {
    const num = parseFloat(valor.replace(/,/g, "."));
    if (isNaN(num)) {
      campo.classList.add("error-input");
      if (errorDiv) errorDiv.textContent = "*Introduce un número válido";
      return false;
    }
    if (num <= 0) {
      campo.classList.add("error-input");
      if (errorDiv) errorDiv.textContent = "*Debe ser un número positivo";
      return false;
    }
  }

  if (campo.id === "descuento") {
    const num = parseFloat(valor.replace(/,/g, "."));
    if (num < 0 || num > 100) {
      campo.classList.add("error-input");
      if (errorDiv) errorDiv.textContent = "*Debe estar entre 0 y 100";
      return false;
    }
  }

  return true;
}

// Asignar validación en tiempo real
function asignarEventosTiempoReal() {
  const inputs = document.querySelectorAll("#formulario input, #formulario select");

  inputs.forEach((input) => {
    input.addEventListener("blur", () => {
      // Valida al salir del campo
      if (input.type === "number" || input.id === "precio" || input.id === "cantidad" || input.id === "descuento") {
        validarCampo(input, "numero");
      } else {
        validarCampo(input);
      }
    });

    input.addEventListener("input", () => {
      // Si el usuario escribe algo válido, se limpia el error
      if (input.type === "number" || input.id === "precio" || input.id === "cantidad" || input.id === "descuento") {
        if (validarCampo(input, "numero")) {
          input.classList.remove("error-input");
          const errorDiv = document.getElementById(input.id + "-error");
          if (errorDiv) errorDiv.textContent = "";
        }
      } else {
        if (validarCampo(input)) {
          input.classList.remove("error-input");
          const errorDiv = document.getElementById(input.id + "-error");
          if (errorDiv) errorDiv.textContent = "";
        }
      }
    });
  });
}

// Inicializa los eventos
asignarEventosTiempoReal();

// Validar formulario al enviar
document.getElementById("formulario").addEventListener("submit", function (e) {
  let formularioValido = true;

  const producto = document.getElementById("producto");
  const nombre = document.getElementById("nombre");
  const precio = document.getElementById("precio");
  const cantidad = document.getElementById("cantidad");
  const descuento = document.getElementById("descuento");

  if (!validarCampo(producto)) formularioValido = false;
  if (!validarCampo(nombre)) formularioValido = false;
  if (!validarCampo(precio, "numero")) formularioValido = false;
  if (!validarCampo(cantidad, "numero")) formularioValido = false;
  if (!validarCampo(descuento, "numero")) formularioValido = false;

  const tipoProducto = producto.value;
  if (tipoProducto === "camiseta") {
    const talla = document.getElementById("talla");
    if (!validarCampo(talla)) formularioValido = false;
  } else if (tipoProducto === "pantalon") {
    const tipo = document.getElementById("tipo");
    if (!validarCampo(tipo)) formularioValido = false;
  } else if (tipoProducto === "gorra") {
    const tamano = document.getElementById("tamano");
    if (!validarCampo(tamano)) formularioValido = false;
  }

  if (!formularioValido) {
    e.preventDefault();
    alert("Valida los campos antes de continuar.");
    document.querySelector(".error-input")?.scrollIntoView({ behavior: "smooth" });
  }
});
