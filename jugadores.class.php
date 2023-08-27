<?php 
class Jugadores{
    
    private $id;
    private $nombre;

    public function __construct($newId,$newNombre)
    {
        $this->id=$newId;
        $this->nombre=$newNombre;
        
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getId(){
        return $this->id;
    }
    
}
?>