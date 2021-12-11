<?php include("../../includes/header.php") ?>
<?php include("../../includes/nav.php") ?>

<?php
include "../../includes/conexion.php";
    $sql = 'SELECT * FROM localidades
            INNER JOIN provincias ON localidades.id_provincia = provincias.id_provincia';

    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
?>
<main>
    <div class="d-flex align-items-center m-4">
        <?php include("crear-localidades.php") ?>
      
        <div class="container ">
            <table id="table_id" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Ciudad</th>
                        <th>Código Postal</th>
                        <th>Provincia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $query->rowCount() > 0) {
                        foreach ($result as $fila) {
                    ?>
                            <tr>
                                <td><?php echo $fila["id_localidad"]; ?></td>
                                <td><?php echo $fila["nombre_ciudad"]; ?></td>
                                <td><?php echo $fila["codigo_postal"]; ?></td>
                                <td><?php echo $fila["nombre_provincia"]; ?></td>
                                <td>
                                    <a href="<?= '../borrar.php?id=' . $fila["id_localidad"] . '&tabla=' . 'localidades' . '&nombre_id=' . 'id_localidad'?>">🗑️Borrar</a>
                                    <a href="<?= 'editar.php?modificar='.$fila["id_localidad"].'&tabla=' . 'localidades' . '&nombre_id=' . 'id_localidad'?>"> ✏️Editar</a>
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