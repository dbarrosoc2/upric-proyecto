<?php
include '../../common/session-checker.php';
require_once '../../controllers/POO/CLASS//Paciente.php';
require_once "../../controllers/POO/CLASS/funciones.php";

$title = "Listado de pacientes";
$description = "Listado de todas los pacientes registrados en UPRIC";
$panelAdmin = true;
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php
    include '../../common/header.php';
    include '../../common/sidebar.php';
    ?>

    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>

        <div class="card table-fixed-wrapper">
            <div class="card-body">
                <?php
                $pacienteInstance = new paciente();
                $pacientesData = $pacienteInstance->mostrarPacientes();

                $modalPreguntaTitle = "Eliminar Paciente";
                $modalPreguntaDescription = '¿Estás de acuerdo con eliminar el paciente <strong class="deleteName">Test</strong>? Esta operación no puede revertirse.';
                include '../../common/modal-pregunta.php';
                ?>
                <table class="table table-result">
                    <thead>
                        <tr>

                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Direccion</th>
                            <th>Hospital Ref</th>
                            <th>Comentarios</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pacientesData as $paciente) { ?>
                            <tr data-delete-row-id="<?= $paciente['id_paciente'] ?>">

                                <td><?= $paciente['dni'] ?></td>
                                <td><?= $paciente['nombre'] . "  " . $paciente['nombre2'] ?></td>
                                <td><?= $paciente['apellido'] . "  " . $paciente['apellido2'] ?></td>
                                <td><?= $paciente['estado'] . " " . $paciente['municipio'] . " " . $paciente['parroquia'] . " " . $paciente['calle'] . " " . $paciente['resto'] ?></td>
                                <td><?= $paciente['hosp_ref'] ?></td>
                                <td><?= $paciente['comentario'] ?></td>
                                <td class="row-buttons">
                                    <div class="d-flex">
                                        <a href="modificar.php?id_paciente=<?= $paciente['id_paciente'] ?>" class="btn btn-outline-primary me-3">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <button 
                                        class="btn btn-outline-primary btnDelete" 
                                        data-delete-id="<?= $paciente['id_paciente'] ?>" 
                                        data-delete-name="<?= $paciente['nombre'] ?>" 
                                        data-delete-url="../../controllers/POO/borrar-paciente-funcion.php" data-delete-type="paciente">
                                            <i 
                                            class="bi bi-trash-fill" 
                                            data-delete-id="<?= $paciente['id_paciente'] ?>"
                                            data-delete-name="<?= $paciente['nombre'] ?>" 
                                            data-delete-url="../../controllers/POO/borrar-paciente-funcion.php" data-delete-type="paciente"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php
    if (isset($_SESSION['mensaje'])) {
        $modalTitle = "¡Paciente actualizado!";
        $modalDescription = "Los datos del paciente <strong>{$_SESSION['mensaje']}</strong> fueron actualizados correctamente.";
        include '../../common/modal-success.php';
    } elseif (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
    }
    unset($_SESSION['error']);
    unset($_SESSION['mensaje']);
    ?>
    <?php
    require_once __DIR__ . '/../../common/footer.php';
    ?>
</body>

</html>