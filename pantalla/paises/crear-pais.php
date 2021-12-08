<?php
include "../../includes/conexion.php";

if(isset($_GET['modificar']) ){

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];
    $sql = "SELECT * FROM {$tabla} WHERE {$nombre_id} =". $id;
    $query = $db->prepare($sql);
    $query->execute();
    $resultado  = $query->fetchAll();
    $nombre = $resultado[0]['nombre'];
    $codigo = $resultado[0]['codigo'];
}


if (isset($_POST['submit']) || isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];
    $nombre_pais = $_POST['nombre_pais'];
    $codigo_pais = $_POST['codigo_pais'];
    $sql     = "UPDATE {$tabla} SET nombre='$nombre_pais' , codigo='$codigo_pais' WHERE {$nombre_id}= $id";
    $stmt    = $db->prepare($sql);
    $ok      = $stmt->execute();
    header('Location: ' . $tabla . '.php');
}

if (isset($_POST['submit']) || isset($_POST['crear'])) {

    $campos = [
        "nombre"   => $_POST['nombre_pais'],
        "codigo"   => $_POST['codigo_pais'],
    ];

    $sql = "INSERT INTO paises (nombre,codigo)";
    $sql .= "values (:" . implode(", :", array_keys($campos)) . ")";

    $query = $db->prepare($sql);
    $query->execute($campos);

    header('Location: paises.php');
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo isset($_GET['modificar']) ? "Modificar un Pais" : "Crear un Pais"; ?></h2>
            <hr>
            <form method="post">
                <div class="pb-4">
                    <div class="form-group">
                        <label for="nombre_pais">Nombre pais</label>
                        <input type="text" name="nombre_pais" id="nombre_pais" class="form-control" value="<?php echo isset($_GET['modificar']) ? $nombre : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="codigo_pais">Código pais</label>
                        <input type="text" name="codigo_pais" id="codigo_pais" class="form-control" value="<?php echo isset($_GET['modificar']) ? $codigo: ""; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="<?php echo isset($_GET['modificar']) ? "actualizar" : "crear"; ?>" class="btn btn-dark" value="<?php echo isset($_GET['modificar']) ? "Actualizar" : "Crear"; ?>">
                    <a class="btn btn-dark" href="../../home.php">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>