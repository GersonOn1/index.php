<?php
   class Database{
    private $con;
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "proyecto_juegos";

    function __construct()
    {
        $this->conectar();
    }

    public function conectar(){
        $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if(mysqli_connect_error()){
         die("Conexion a la base de datos fallo."
         . mysqli_connect_error()
         . mysqli_connect_error()
        );
        }
    }
    public function sanitize($var){
      $return = mysqli_real_escape_string($this->con, $var);
      return $return;
    }
    public function insertarJuego($id, $nombre, $fechalanzamiento, $descripcion, $consola){
        $sql = "INSERT INTO `juegos`
          (`id`, `nombre`, `fechalanzamiento`, `descripcion`, `consola`) 
          VALUES ('$id', '$nombre', '$fechalanzamiento', '$descripcion', '$consola')";
          $res = mysqli_query($this->con, $sql);
          if($res){
            return true;
          }else{
            return false;
          }
    }
    public function mostrarJuegos(){
        $sql = "SELECT * FROM juegos";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }

    public function mostrarConsolas(){
        $sql = "SELECT * FROM consolas";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }
    public function InsertarConsolas($id, $nombre, $fechalanzamiento, $descripcion){
    $sql = "INSERT INTO `consolas` (`id`, `nombre`, `fechalanzamiento`, `descripcion` ) 
            VALUES ('$id', '$nombre', '$fechalanzamiento', '$descripcion')";
    $res = mysqli_query($this->con, $sql);
    if($res){
        return true;
    } else {
        return false;
    }
}

    public function actualizarJuego($id, $nombre, $fechalanzamiento, $descripcion, $consola){
      $sql = "UPDATE `juegos` SET 
      `nombre` = '$nombre', 
      `fechalanzamiento` = '$fechalanzamiento', 
      `descripcion` = ' $descripcion', 
      `consola` = '$consola' 
      WHERE `juegos`.`id` = '$id'";
      $res = mysqli_query($this->con, $sql);
      if($res){
        return true;
      }else{
        return false;
      }
      }
      public function buscarJuegos($id){
        $sql = "SELECT * FROM juegos WHERE id = '$id'";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_object($res);
        return $return;
      }

      public function eliminarJuego($id){
        $sql = "DELETE FROM juegos WHERE id = '$id'";
        $res = mysqli_query($this->con, $sql);
        if($res){
          return true;
        }else{
          return false;
        }

      }
      public function eliminarConsola($id){
        $sql = "DELETE FROM consolas WHERE id = '$id'";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        } else {
            return false;
        }
    }
    public function actualizarConsolas($id, $nombre, $fechalanzamiento, $descripcion, ){
      $sql = "UPDATE `consolas` SET 
      `nombre` = '$nombre', 
      `fechalanzamiento` = '$fechalanzamiento', 
      `descripcion` = ' $descripcion'
      WHERE `consolas`.`id` = '$id'";
      $res = mysqli_query($this->con, $sql);
      if($res){
        return true;
      }else{
        return false;
      }
      }
      public function buscarConsolas($id){
        $sql = "SELECT * FROM consolas WHERE id = '$id'";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_object($res);
        return $return;
      }
    }
?>