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

    public function __toString() {
        // Quitamos <div> porque ya está en el padre
        return str_replace(
            "</div>",                 // buscamos el cierre del div del padre
            "<br>Tamaño: {$this->tamaño}</div>", // insertamos la info de la hija antes del cierre
            parent::__toString()       // contenido del padre
        );
    }

}
