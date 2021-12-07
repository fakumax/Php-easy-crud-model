<?php include("../../includes/header.php") ?>
<?php include("../../includes/nav.php") ?>

<?php
include "../../includes/conexion.php";
    $sql = 'SELECT * FROM roles ';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
?>
<main>
    <div class="d-flex align-items-center vh-100">
        <?php include("crear-rol.php") ?>
      
        <div class="container ">
            <table id="table_id" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $query->rowCount() > 0) {
                        foreach ($result as $fila) {
                    ?>
                            <tr>
                                <td><?php echo $fila["id_rol"]; ?></td>
                                <td><?php echo $fila["nombre_rol"]; ?></td>
                                <td>
                                    <a href="<?= '../borrar.php?id=' . $fila["id_rol"] . '&tabla=' . 'roles' . '&nombre_id=' . 'id_rol'?>">🗑️Borrar</a>
                                    <a href="<?= '../editar.php?id=' . $fila["id_rol"] . '&tabla=' . 'roles' . '&nombre_id=' . 'id_rol'?>"> ✏️Editar</a>
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