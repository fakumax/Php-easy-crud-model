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
    $nombre_usuario = $resultado[0]['nombre_usuario'];
    $clave = $resultado[0]['clave'];
    $activo = $resultado[0]['activo'];
    $id_rol = $resultado[0]['id_rol'];
}


if (isset($_POST['submit']) || isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];

    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    $activo = $_POST['activo'];
    $id_rol = $_POST['id_rol'];

    $sql     = "UPDATE {$tabla} SET nombre_usuario='$nombre_usuario' ,clave='$clave' ,activo='$activo' ,id_rol='$id_rol' WHERE {$nombre_id}= $id";
    $stmt    = $db->prepare($sql);
    $ok      = $stmt->execute();
    header('Location: ' . $tabla . '.php');
}

if (isset($_POST['submit']) || isset($_POST['crear'])) {

    $campos = [
        "nombre_usuario"     => $_POST['nombre_usuario'],
        "clave"              => $_POST['clave'],
        "activo"             => $_POST['activo'],
        "id_rol"             => $_POST['id_rol'],
    ];

    $sql = "INSERT INTO usuarios (nombre_usuario,clave,activo,id_rol)";
    $sql .= "values (:" . implode(", :", array_keys($campos)) . ")";
    $query = $db->prepare($sql);
    $query->execute($campos);
    header('Location: usuarios.php');
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo isset($_GET['modificar']) ? "Modificar un usuario" : "Crear un usuario"; ?></h2>
            <hr>
            <form method="post">
                <div class="pb-4">
                    <div class="form-group">
                        <label for="nombre_usuario">Nombre usuario</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="<?php echo isset($_GET['modificar']) ? $nombre_usuario : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="text" name="clave" id="clave" class="form-control" value="<?php echo isset($_GET['modificar']) ? $clave : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="activo">Activo</label>
                        <select class="form-control" name="activo" id="activo">
                            <!-- Si apreto el boton editar cambia el valor al elegido en el select, agregando la etiqueta selected -->
                            <option value="0" <?php echo isset($_GET['modificar']) && ( '0' == $activo) ? "selected='selected'" : ""; ?>> No </option>
                            <option value="1" <?php echo isset($_GET['modificar']) && ( '1' == $activo) ? "selected='selected'" : ""; ?>> Si </option>
                            
                        </select>

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
                </div>
                <div class="form-group">
                    <input type="submit" name="<?php echo isset($_GET['modificar']) ? "actualizar" : "crear"; ?>" class="btn btn-dark" value="<?php echo isset($_GET['modificar']) ? "Actualizar" : "Crear"; ?>">
                    <a class="btn btn-dark" href="../../home.php">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>