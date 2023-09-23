<?php
include_once('conexion.php');

class general {
  var $successLimit = false;
  var $passengersLimit;
  /**
   * void
   */
  function __construct() {
    // return 'Hello world';
  }

  function setPassengersLimit($limit) {
    $conexion = new conexion();
    $sql= 'update general set passengersLimit='.$limit.' where idgeneral=1';
    $result = $conexion->ejecutar_sentencia($sql);
    $this->successLimit = $result;
  }

  function getPassengersLimit() {
    $conexion = new conexion();
    $sql= 'select passengersLimit from general where idgeneral=1';
    $result = $conexion->ejecutar_sentencia($sql);
    while($row=mysqli_fetch_array($result))
    {
      $this->passengersLimit = $row['passengersLimit'];
    }
    }
}
?>