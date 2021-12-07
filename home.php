<?php include("includes/header.php") ?>

<nav class="navbar navbar-dark bg-dark navbar">
    <div class="container">
        <a href="../integradorweb" class="navbar-brand">Ir Inicio</a>
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
                <a class="nav-link disabled">TP Integrador - Seminario II</a>
            </li>
        </ul>
    </div>
</nav>
<main>
    <div class="d-flex align-items-center vh-100">
        <div class="container ">
            <div class="d-flex flex-column justify-content-center  text-center homeStyle">
                <ul>
                    <li> <a href="pantalla/roles/roles.php" class="btn btn-dark" role="button" aria-pressed="true">Roles</a></li>
                    <li> <a href="pantalla/usuarios.php" class="btn btn-dark" role="button" aria-pressed="true">Usuarios</a></li>
                    <li> <a href="pantalla/paises/paises.php" class="btn btn-dark" role="button" aria-pressed="true">Paises</a></li>
                    <li> <a href="pantalla/provincias/provincias.php" class="btn btn-dark" role="button" aria-pressed="true">Provincias</a></li>
                    <li> <a href="pantalla/localidades/localidades.php" class="btn btn-dark" role="button" aria-pressed="true">Ciudades</a></li>
                    <li> <a href="pantalla/personas.php" class="btn btn-dark" role="button" aria-pressed="true">Personas</a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER -->
<?php include("includes/footer.php") ?>