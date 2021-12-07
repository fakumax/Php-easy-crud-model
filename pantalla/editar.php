<?php
include "../includes/conexion.php";

 
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];

    $sql = "SELECT * FROM {$tabla} WHERE {$nombre_id} =". $id;
    
    $query = $db->prepare($sql);
    $query->execute();
    $result  = $query->fetchAll();
  
    $campo = $result[0]['nombre_rol'];

    //var_dump($result[0]['nombre_rol'] );
    header('Location: '.$tabla.'/'. $tabla .'.php?modificar='.$campo.'&tabla='.$tabla.'&nombre_id='. $nombre_id.'&id='.$id);
    // $campos = [
    //     "nombre_rol"   => $_POST['nombre_rol'],
    // ];
?>