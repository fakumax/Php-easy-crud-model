<?php
include("conexion.php");
// require_once 'conexion.php';
if (empty($_POST['usuario']) && empty($_POST['password'])) {
  echo "Algunos datos están vacios";
} else {
  $sql = 'SELECT * FROM usuarios WHERE nombre_usuario = "' . $_POST['usuario'] . '"';
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_ASSOC);

  //  print_r( password_verify($_POST['password'], $result['clave']));
  //$hashedpwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
  //print_r($hashedpwd);

  if (count($result) > 0 && ($_POST['password'] === $result['clave'])) {
    session_start();
    $_SESSION['usuario'] = $result['usuario'];
    print_r($_POST['password']);
    header('Location: ../home.php');
  } else {
    echo 'Usuario o contraseña incorrecta';
  }
}
