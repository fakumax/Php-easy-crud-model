<?php
include "../../includes/conexion.php";

if (isset($_GET['modificar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];
    $sql = "SELECT * FROM {$tabla} WHERE {$nombre_id} =" . $id;
    $query = $db->prepare($sql);
    $query->execute();
    $resultado  = $query->fetchAll();
    $nombre_provincia = $resultado[0]['nombre_provincia'];
    $codigo_pais = $resultado[0]['id_pais'];
}


if (isset($_POST['submit']) || isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];
    $nombre_provincia = $_POST['nombre_provincia'];
    $codigo_pais = $_POST['codigo_pais'];
    $sql     = "UPDATE {$tabla} SET nombre_provincia='$nombre_provincia' , id_pais=$codigo_pais WHERE {$nombre_id}= $id";
    $stmt    = $db->prepare($sql);
    $ok      = $stmt->execute();
    header('Location: ' . $tabla . '.php');
}

if (isset($_POST['submit']) || isset($_POST['crear'])) {

    $campos = [
        "nombre_provincia"   => $_POST['nombre_provincia'],
        "id_pais"   => $_POST['id_pais'],
    ];

    $sql = "INSERT INTO provincias (nombre_provincia,id_pais)";
    $sql .= "values (:" . implode(", :", array_keys($campos)) . ")";
    $query = $db->prepare($sql);
    $query->execute($campos);
    header('Location: provincias.php');
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo isset($_GET['modificar']) ? "Modificar una Provincia" : "Crear una Provincia"; ?></h2>
            <hr>
            <form method="post">
                <div class="pb-4">
                    <div class="form-group">
                        <label for="nombre_provincia">Nombre Provincia</label>
                        <input type="text" name="nombre_provincia" id="nombre_provincia" class="form-control" value="<?php echo isset($_GET['modificar']) ? $nombre_provincia : ""; ?>">
                    </div>
                    <!-- <div class="form-group">
                        <label for="codigo_pais">Código pais</label>
                        <input type="text" name="codigo_pais" id="codigo_pais" class="form-control" value="<?php echo isset($_GET['modificar']) ? $codigo_pais : ""; ?>">
                    </div> -->
                    <div class="form-group">
                        <label for="id_pais">Código pais</label>
                        <select class="form-control" name="id_pais" id="id_pais">
                            <?php
                                $sqlSelect = "SELECT * FROM paises";
                                $querySelect = $db->query($sqlSelect);
                                while ($row = $querySelect->fetch()) {
                                    echo "<option value='" . $row['id_pais'] . "'>" . $row['nombre'] . "</option>";
                                }
                               
                            ?>
                         </select>
                      
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