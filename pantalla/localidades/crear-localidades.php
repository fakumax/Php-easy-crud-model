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
    $nombre_ciudad = $resultado[0]['nombre_ciudad'];
    $codigo_postal = $resultado[0]['codigo_postal'];
    $codigo_provincia = $resultado[0]['id_provincia'];
}


if (isset($_POST['submit']) || isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];
    $nombre_ciudad = $_POST['nombre_localidad'];
    $codigo_postal = $_POST['codigo_postal'];
    $codigo_provincia = $_POST['id_provincia'];
    $sql     = "UPDATE {$tabla} SET nombre_ciudad='$nombre_ciudad', codigo_postal='$codigo_postal', id_provincia=$codigo_provincia WHERE {$nombre_id}= $id";
    $stmt    = $db->prepare($sql);
    $ok      = $stmt->execute();
    header('Location: ' . $tabla . '.php');
}

if (isset($_POST['submit']) || isset($_POST['crear'])) {

    $campos = [
        "nombre_ciudad"   => $_POST['nombre_localidad'],
        "codigo_postal"   => $_POST['codigo_postal'],
        "id_provincia"   => $_POST['id_provincia'],

    ];

    $sql = "INSERT INTO localidades (nombre_ciudad,codigo_postal,id_provincia)";
    $sql .= "values (:" . implode(", :", array_keys($campos)) . ")";
    $query = $db->prepare($sql);
    $query->execute($campos);
    header('Location: localidades.php');
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo isset($_GET['modificar']) ? "Modificar una Localidad" : "Crear una Localidad"; ?></h2>
            <hr>
            <form method="post">
                <div class="pb-4">
                    <div class="form-group">
                        <label for="nombre_localidad">Nombre Localidad</label>
                        <input type="text" name="nombre_localidad" id="nombre_localidad" class="form-control" value="<?php echo isset($_GET['modificar']) ? $nombre_ciudad : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal">Código Postal</label>
                        <input type="text" name="codigo_postal" id="codigo_postal" class="form-control" value="<?php echo isset($_GET['modificar']) ? $codigo_postal : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_provincia">Provincia</label>
                        <select class="form-control" name="id_provincia" id="id_provincia">
                            <?php
                            $sqlSelect = "SELECT * FROM provincias";
                            $querySelect = $db->query($sqlSelect);
                            while ($row = $querySelect->fetch()) {  ?>
                                <!-- Si apreto el boton editar cambia el valor al elegido en el select, agregando la etiqueta selected -->
                                <option value="<?php echo $row['id_provincia'] ?>" 
                                    <?php echo isset($_GET['modificar']) && ($row['id_provincia'] == $codigo_provincia) ? "selected='selected'" : ""; ?>>
                                    <?php echo $row['nombre_provincia'] ?> </option>

                            <?php } ?>

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