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
    $nombre_persona = $resultado[0]['nombre'];
    $apellido_persona = $resultado[0]['apellido'];
    $apodo_persona = $resultado[0]['apodo'];
    $id_rol = $resultado[0]['id_rol'];
    $id_localidad = $resultado[0]['id_localidad'];
}


if (isset($_POST['submit']) || isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];

    $nombre_persona = $_POST['nombre_persona'];
    $apellido_persona = $_POST['apellido_persona'];
    $apodo_persona = $_POST['apodo_persona'];
    $id_rol = $_POST['id_rol'];
    $id_localidad = $_POST['id_localidad'];

    $sql     = "UPDATE {$tabla} SET nombre='$nombre_persona' ,apellido='$apellido_persona' ,apodo='$apodo_persona' ,id_rol='$id_rol' ,id_localidad='$id_localidad'  WHERE {$nombre_id}= $id";
    $stmt    = $db->prepare($sql);
    $ok      = $stmt->execute();
    header('Location: ' . $tabla . '.php');
}

if (isset($_POST['submit']) || isset($_POST['crear'])) {

    $campos = [
        "nombre"             => $_POST['nombre_persona'],
        "apellido"           => $_POST['apellido_persona'],
        "apodo"              => $_POST['apodo_persona'],
        "id_rol"             => $_POST['id_rol'],
        "id_localidad"       => $_POST['id_localidad'],
    ];

    $sql = "INSERT INTO personas (nombre,apellido,apodo,id_rol,id_localidad)";
    $sql .= "values (:" . implode(", :", array_keys($campos)) . ")";
    $query = $db->prepare($sql);
    $query->execute($campos);
    header('Location: personas.php');
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo isset($_GET['modificar']) ? "Modificar una persona" : "Crear una persona"; ?></h2>
            <hr>
            <form method="post">
                <div class="pb-4">
                    <div class="form-group">
                        <label for="nombre_persona">Nombre</label>
                        <input type="text" name="nombre_persona" id="nombre_persona" class="form-control" value="<?php echo isset($_GET['modificar']) ? $nombre_persona : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido_persona">Apellido</label>
                        <input type="text" name="apellido_persona" id="apellido_persona" class="form-control" value="<?php echo isset($_GET['modificar']) ? $apellido_persona : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="apodo_persona">Apodo</label>
                        <input type="text" name="apodo_persona" id="apodo_persona" class="form-control" value="<?php echo isset($_GET['modificar']) ? $apodo_persona : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_rol">Rol</label>
                        <select class="form-control" name="id_rol" id="id_rol">
                            <?php
                            $sqlSelect = "SELECT * FROM roles";
                            $querySelect = $db->query($sqlSelect);
                            while ($row = $querySelect->fetch()) {  ?>
                                <!-- Si apreto el boton editar cambia el valor al elegido en el select, agregando la etiqueta selected -->
                                <option value="<?php echo $row['id_rol'] ?>" <?php echo isset($_GET['modificar']) && ($row['id_rol'] == $id_rol) ? "selected='selected'" : ""; ?>>
                                    <?php echo $row['nombre_rol'] ?> </option>

                            <?php } ?>

                        </select>

                    </div>
                    <div class="form-group">
                        <label for="id_localidad">Localidad</label>
                        <select class="form-control" name="id_localidad" id="id_localidad">
                            <?php
                            $sqlSelect = "SELECT * FROM localidades";
                            $querySelect = $db->query($sqlSelect);
                            while ($row = $querySelect->fetch()) {  ?>
                                <!-- Si apreto el boton editar cambia el valor al elegido en el select, agregando la etiqueta selected -->
                                <option value="<?php echo $row['id_localidad'] ?>" <?php echo isset($_GET['modificar']) && ($row['id_localidad'] == $id_localidad) ? "selected='selected'" : ""; ?>>
                                    <?php echo $row['nombre_ciudad'] ?> </option>

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