<?php
class Guias
{
    public function consultarListaGuia() {
        $dwarves = array("Bashful", "Doc", "Dopey", "Grumpy", "Happy",
            "Sneezy", "Sleepy");
        return file_get_contents('xml/guias.xml');
    }
    public function consultarDetalleGuia() {
        return file_get_contents('xml/detalles-guia.xml');
    }
}