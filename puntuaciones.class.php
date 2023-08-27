<?php

// Definir la clase Jugador
class Puntuaciones {
  public $id;
  public $nombre;
  public $puntos;

  function __construct($id, $nombre, $puntos) {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->puntos = $puntos;
  }

  public function getId(){
    return $this->id;
}

public function getNombre(){
    return $this->nombre;
}

public function getPuntos(){
    return $this->puntos;
}


}

?>