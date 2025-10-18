<?php
class Producto {
    private $nombre;
    private $precio;
    private $cantidad;

    public function __construct($nombre, $precio, $cantidad) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function calcularTotal() {
        return $this->precio * $this->cantidad;
    }

    public function __toString() {
        return $this->nombre . " - " . $this->precio . " €";
    }

    public function __destruct() {
        echo "<!-- Objeto Producto '{$this->nombre}' destruido -->";
    }
}
