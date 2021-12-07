<!-- HEADER -->
<?php include("includes/header.php") ?>

<!-- MAIN -->
<main>
    <div class="d-flex align-items-center vh-100">
        <div class="container ">
            <div class="container fondo_login">
                <img src="img/UNaM.png" class="rounded float-end img-fluid img-unam" alt="Unam Logo">
                <img src="img/FCEQyN.png" class="rounded float-start img-fluid" alt="FCEQYN logo">
            </div>
            <div class="row text-center">
                <h1>Bolsa de pasantías y trabajos</h1>
                <p>Bienvenido! Por favor, ingrese al sistema para continuar</p>
            </div>
            <div class="d-flex flex-column justify-content-center pt-xl-5">
                <form class="d-flex flex-column align-items-center" action="includes/login.php" method="post">
                    <div class="mb-3 col-md-4">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-dark">Ingresar</button>
                </form>
            </div>

        </div>

    </div>
</main>
<!-- Script Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>