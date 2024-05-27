<?php
include '../../common/session-checker.php';
require_once "../../controllers/POO/CLASS/Paciente.php";
require_once "../../controllers/POO/CLASS/funciones.php";

$title = "Listado Pacientes";
$description = "Aqui Tienes los pacientes registrados en nuestra BBDD";
$panelAdmin = true;
?>

<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php';  ?>
    <?php include '../../common/sidebar.php'; ?>


    <main id="main" class="main">
        <?php include '../../common/page-title.php';


        $donantes = new Paciente();
        echo $donantes->listarPacientesEnTabla();


        ?>



    </main>

    <?php
    $customScript = "pacientes.js";
    require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>

</html>