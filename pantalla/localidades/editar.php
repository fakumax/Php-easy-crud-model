<?php
include "../../includes/conexion.php";

 
    $id = $_GET['modificar'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];

    $sql = "SELECT * FROM {$tabla} WHERE {$nombre_id} =". $id;
    
    $query = $db->prepare($sql);
    $query->execute();
    $result  = $query->fetchAll();
  
    header('Location: ../'.$tabla.'/'. $tabla .'.php?modificar=ok'.'&tabla='.$tabla.'&nombre_id='. $nombre_id.'&id='.$id);

?>