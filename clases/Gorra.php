<?php

class Gorra extends Producto {
    private $tamaño;

    public function __construct($nombre, $precio, $cantidad, $tamaño) {
        parent::__construct($nombre, $precio, $cantidad);
        $this->tamaño = $tamaño;
    }

    public function getTamaño() {
        return $this->tamaño;
    }

    public function calcularDescuento($porcentaje) {
        $total = $this->calcularTotal();
        $descuento = $total * ($porcentaje / 100);
        return $total - $descuento;
    }
}
