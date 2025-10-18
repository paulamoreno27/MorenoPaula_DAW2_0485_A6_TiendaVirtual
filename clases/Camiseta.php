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

  public function __toString() {
        // Quitamos <div> porque ya está en el padre
        return str_replace(
            "</div>",             // buscamos el cierre del div
            "<br>Talla: {$this->talla}</div>", // insertamos la info de la hija justo antes
            parent::__toString()
        );
    }

}
