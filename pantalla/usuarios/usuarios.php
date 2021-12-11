<?php include("../../includes/header.php") ?>
<?php include("../../includes/nav.php") ?>

<?php
include "../../includes/conexion.php";
$sql = 'SELECT * FROM usuarios
            INNER JOIN roles ON usuarios.id_rol = roles.id_rol';

$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll();
?>
<main>
    <div class="d-flex align-items-center m-4">
        <?php include("crear-usuarios.php") ?>

        <div class="container ">
            <table id="table_id" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Usuario</th>
                        <th>Clave</th>
                        <th>Activo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $query->rowCount() > 0) {
                        foreach ($result as $fila) {
                    ?>
                            <tr>
                                <td><?php echo $fila["id_usuario"]; ?></td>
                                <td><?php echo $fila["nombre_usuario"]; ?></td>
                                <td><?php echo $fila["clave"]; ?></td>
                                <td><?php echo ($fila['activo']==1 ? "Si": "No") ?></td>
                                <td><?php echo $fila["nombre_rol"]; ?></td>
                          
                                <td>
                                    <a href="<?= '../borrar.php?id=' . $fila["id_usuario"] . '&tabla=' . 'usuarios' . '&nombre_id=' . 'id_usuario' ?>">🗑️Borrar</a>
                                    <a href="<?= 'editar.php?modificar=' . $fila["id_usuario"] . '&tabla=' . 'usuarios' . '&nombre_id=' . 'id_usuario' ?>"> ✏️Editar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                <tbody>
            </table>
        </div>
    </div>
</main>

<!-- FOOTER -->
<?php include("../../includes/footer.php") ?>