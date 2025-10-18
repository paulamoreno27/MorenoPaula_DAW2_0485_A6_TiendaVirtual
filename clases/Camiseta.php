<?php

class Camiseta extends Producto {
    private $talla;

    public function __construct($nombre, $precio, $cantidad, $talla) {
        parent::__construct($nombre, $precio, $cantidad);
        $this->talla = $talla;
    }

    public function getTalla() {
        return $this->talla;
    }

    public function calcularDescuento($porcentaje) {
        $total = $this->calcularTotal();
        $descuento = $total * ($porcentaje / 100);
        return $total - $descuento;
    }
}
