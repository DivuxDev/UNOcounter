<?php
require 'jugadores.class.php';
require 'puntuaciones.class.php';


class DB
{

    const HOST = 'Your database provides';
    const DATABASE = 'schema name';
    const DNS = 'mysql:host=' . self::HOST . ';dbname=' . self::DATABASE;
    const USUARIO = 'user';
    const PASSWORD = 'password';


    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new DB();
        return self::$instance;
    }


    private function getConexion()
    {
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        try {
            $dwes = new PDO(self::DNS, self::USUARIO, self::PASSWORD, $opciones);
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $dwes;
        } catch (Exception $ex) {
            echo "<h4>{$ex->getMessage()}</h4>";
            return null;
        }
    }

    public function getJugadores()
    {
        $conexion = $this->getConexion();

        $consulta = "SELECT * FROM jugadores";
        $sentencia = $conexion->prepare($consulta);
        
        if ($sentencia->execute()) {
            while ($fila = $sentencia->fetchObject()) {
                $jugadores[] = new Jugadores($fila->id,$fila->nombre);
            }
            
            unset($sentencia);
            return $jugadores;
            
        }
    }

    public function aniadirPuntos($id,$puntuacion){
        $conexion = $this->getConexion();
        $insert = "insert into puntuaciones values(?,?)";

        $sentencia = $conexion->prepare($insert);
        
        $sentencia->bindParam(1, $id);
        $sentencia->bindParam(2, $puntuacion);

        if($sentencia->execute()){
            return true;
            
        }else{
            return false;
        }

    }

    function eliminarJugador($id){
        $conexion = $this->getConexion();
        
        $delete = "delete from jugadores where id = ?";
        
        $sentencia = $conexion->prepare($delete);
        $sentencia->bindValue(1, $id);

        if ($sentencia->execute()) {
            unset($sentencia);
            return true;
        }
            
    }

    function registrarJugador($nombre)
    {

        $conexion = $this->getConexion();

        $select = "select nombre from jugadores where nombre = ?";
        $sentencia = $conexion->prepare($select);
        $sentencia->bindParam(1, $nombre);

        $sentencia->execute();

        if ($sentencia->rowCount() > 0) {
            return false;
        } else {
            $insert = "insert into jugadores(nombre) values (?)";

            $sentencia = $conexion->prepare($insert);

            $sentencia->bindParam(1, $nombre);
            

            $sentencia->execute();
            unset($sentencia);
            return true;
        }

    }

    public function getPuntuaciones(){
        $conexion = $this->getConexion();

        $consulta = "SELECT jugadores.id, jugadores.nombre, SUM(puntuaciones.puntos) as total_puntos FROM `jugadores` INNER JOIN puntuaciones
        on puntuaciones.jugadorid = jugadores.id group by jugadores.nombre order by sum(puntos) asc ";
        
        $sentencia = $conexion->prepare($consulta);
        
        if ($sentencia->execute()) {
            while ($fila = $sentencia->fetchObject()) {
                $puntuaciones[] = new Puntuaciones($fila->id,$fila->nombre,$fila->total_puntos);
            }
            
            unset($sentencia);
            return $puntuaciones;
            
        }

    }

    public function getPuntuacionesPorID($id){
        $conexion = $this->getConexion();

        $consulta = "SELECT jugadores.id, jugadores.nombre, puntuaciones.puntos as total_puntos FROM `jugadores` INNER JOIN puntuaciones on puntuaciones.jugadorid = jugadores.id where jugadores.id = ?";
        
        $sentencia = $conexion->prepare($consulta);

        $sentencia->bindParam(1, $id);
        
        if ($sentencia->execute()) {
            while ($fila = $sentencia->fetchObject()) {
                $puntuaciones[] = new Puntuaciones($fila->id,$fila->nombre,$fila->total_puntos);
            }
            
            unset($sentencia);
            return $puntuaciones;
            
        }

    }

    public function vaciarPuntos(){
        $conexion = $this->getConexion();
        
        $delete = "delete from puntuaciones";
        
        $sentencia = $conexion->prepare($delete);

        if ($sentencia->execute()) {
            unset($sentencia);
            return true;
        }else{
            return false;
        }
    }

    

    
}
