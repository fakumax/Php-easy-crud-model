<?php
include "../../includes/conexion.php";


if (isset($_POST['submit']) || isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $nombre_id = $_GET['nombre_id'];
    $valorRol = $_POST['nombre_rol'];
    $sql     = "UPDATE `roles` SET `nombre_rol`=? WHERE `id_rol`=?";
    $stmt     = $db->prepare($sql);
    $ok     = $stmt->execute([$valorRol,  $id]);
    header('Location: roles.php');
}

if (isset($_POST['submit']) || isset($_POST['crear'])) {

    $campos = [
        "nombre_rol"   => $_POST['nombre_rol'],
    ];

    $sql = "INSERT INTO roles (nombre_rol)";
    $sql .= "values (:" . implode(", :", array_keys($campos)) . ")";

    $query = $db->prepare($sql);
    $query->execute($campos);

    header('Location: roles.php');
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo isset($_GET['modificar']) ? "Modificar un rol" : "Crear un Rol"; ?></h2>
            <hr>
            <form method="post">
                <div class="pb-4">
                    <div class="form-group">
                        <label for="nombre_rol">Nombre Rol</label>
                        <input type="text" name="nombre_rol" id="nombre_rol" class="form-control" value="<?php echo isset($_GET['modificar']) ? $_GET['modificar'] : ""; ?>">
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