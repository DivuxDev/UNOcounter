<?php 
class Resultados{
    private $id;
    private $nombre;
    private $jugadorid;
    private $puntos;

    public function __construct($newId,$newNombre,$newjugadorid,$newpuntos)
    {
        $this->id=$newId;
        $this->nombre=$newNombre;  
        $this->jugadorid=$newjugadorid;
        $this->puntos=$newpuntos;  
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