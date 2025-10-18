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

    public function __toString() {
        // Quitamos <div> porque ya está en el padre
        return str_replace(
            "</div>",                  // buscamos el cierre del div del padre
            "<br>Tipo: {$this->tipo}</div>", // insertamos la info de la hija antes del cierre
            parent::__toString()        // contenido del padre
        );
    } 
    
}
