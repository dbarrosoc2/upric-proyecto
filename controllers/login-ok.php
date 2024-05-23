<?php
$title = "Menu";
session_start(); // Iniciar la sesión si no está iniciada
?>

<!DOCTYPE html>
<html lang="es">
<?php
include '../common/head.php';
?>

<body>
    <?php
    include '../common/header-iniciado.php';
    ?>

    <div class="container mt-4">
        <!-- Mensaje de Bienvenida -->
        <div class="row">
            <div class="col">
                <?php if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) : ?>
                    <p class="text-left">Bienvenido <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row container-tarjetas">
            <div class="col-md-4">
                <a href="prueba.php" class="card-link">
                    <div class="card">
                        <img src="../public/images/OTrasPRuebas.jpeg" class="card-img-top" alt="Pruebas">
                        <div class="card-body">
                            <h5 class="card-title">Pruebas</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="POO/generar-resultados.php" class="card-link">
                    <div class="card">
                        <img src="../public/images/imprimir.jpeg" class="card-img-top" alt="Reportes">
                        <div class="card-body">
                            <h5 class="card-title">Imprimir Resultados</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="pacientes.php" class="card-link">
                    <div class="card">
                        <img src="../public/images/pacientesss.jpeg" class="card-img-top" alt="Pacientes">
                        <div class="card-body">
                            <h5 class="card-title">Pacientes</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y Popper.js (si es necesario) -->
    <?php include '../common/footer.php'; ?>
</body>

</html>