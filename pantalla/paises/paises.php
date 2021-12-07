<?php include("../../includes/header.php") ?>
<?php include("../../includes/nav.php") ?>

<?php
include "../../includes/conexion.php";
    $sql = 'SELECT * FROM paises ';
    $query = $db->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
?>
<main>
    <div class="d-flex align-items-center vh-100">
        <?php include("crear-pais.php") ?>
      
        <div class="container ">
            <table id="table_id" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre Pais</th>
                        <th>Código Pais</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $query->rowCount() > 0) {
                        foreach ($result as $fila) {
                    ?>
                            <tr>
                                <td><?php echo $fila["id_pais"]; ?></td>
                                <td><?php echo $fila["nombre"]; ?></td>
                                <td><?php echo $fila["codigo"]; ?></td>
                                <td>
                                    <a href="<?= '../borrar.php?id=' . $fila["id_pais"] . '&tabla=' . 'paises' . '&nombre_id=' . 'id_pais'?>">🗑️Borrar</a>
                                    <a href="<?= '../editar.php?id=' . $fila["id_pais"] . '&tabla=' . 'paises' . '&nombre_id=' . 'id_pais'?>"> ✏️Editar</a>
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