<?php
  include "../includes/conexion.php";
  $id = $_GET['id'];
  $tabla = $_GET['tabla'];
  $nombre_id = $_GET['nombre_id'];
  $query = "DELETE FROM {$tabla} WHERE {$nombre_id} =" . $id;
  $query = $db->prepare($query);
  $query->execute();
  
  header('Location: '.$tabla.'/'. $tabla .'.php');
//   $result = $query->fetchAll();
?>