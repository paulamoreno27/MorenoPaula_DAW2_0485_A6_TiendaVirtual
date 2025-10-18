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

    public function getNombre() { return $this->nombre; }
    public function getPrecio() { return $this->precio; }
    public function getCantidad() { return $this->cantidad; }

    public function calcularTotal() {
        return $this->precio * $this->cantidad;
    }

    // Mostramos toda la info del producto base
    public function __toString() {
        return "<div class='card-title'>
                    Producto: {$this->nombre}<br>
                    Precio unitario: " . number_format($this->precio, 2) . " €<br>
                    Cantidad: {$this->cantidad}<br>
                    Total: " . number_format($this->calcularTotal(), 2) . " €
                </div>";
    }


    public function __destruct() {
        echo "<!-- Objeto Producto '{$this->nombre}' destruido -->";
    }
    
}
