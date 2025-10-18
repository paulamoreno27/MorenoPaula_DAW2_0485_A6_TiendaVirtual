<?php

class Pantalon extends Producto {
    private $tipo;

    public function __construct($nombre, $precio, $cantidad, $tipo) {
        parent::__construct($nombre, $precio, $cantidad);
        $this->tipo = $tipo;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function calcularDescuento($porcentaje) {
        $total = $this->calcularTotal();
        $descuento = $total * ($porcentaje / 100);
        return $total - $descuento;
    }
}
