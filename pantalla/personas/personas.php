<?php include("../../includes/header.php") ?>
<?php include("../../includes/nav.php") ?>

<?php
include "../../includes/conexion.php";
$sql = 'SELECT * FROM personas
            INNER JOIN localidades ON personas.id_localidad = localidades.id_localidad
            INNER JOIN roles ON personas.id_rol = roles.id_rol';

$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll();
?>
<main>
    <div class="d-flex align-items-center m-4">
        <?php include("crear-personas.php") ?>

        <div class="container ">
            <table id="table_id" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Apodo</th>
                        <th>Rol</th>
                        <th>Localidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $query->rowCount() > 0) {
                        foreach ($result as $fila) {
                    ?>
                            <tr>
                                <td><?php echo $fila["id_persona"]; ?></td>
                                <td><?php echo $fila["nombre"]; ?></td>
                                <td><?php echo $fila["apellido"]; ?></td>
                                <td><?php echo $fila["apodo"]; ?></td>
                                <td><?php echo $fila["nombre_rol"]; ?></td>
                                <td><?php echo $fila["nombre_ciudad"]; ?></td>

                                <td>
                                    <a href="<?= '../borrar.php?id=' . $fila["id_persona"] . '&tabla=' . 'personas' . '&nombre_id=' . 'id_persona' ?>">🗑️Borrar</a>
                                    <a href="<?= 'editar.php?modificar=' . $fila["id_persona"] . '&tabla=' . 'personas' . '&nombre_id=' . 'id_persona' ?>"> ✏️Editar</a>
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