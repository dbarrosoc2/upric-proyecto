<?php
include '../../common/session-checker.php';
require_once '../../controllers/POO/CLASS//Usuarios.php';
require_once "../../controllers/POO/CLASS/funciones.php";

$title = "Listar Usuarios";
$description = "Listado de todos los usuarios registrados en URPIC";
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
                $pruebaInstance = new Usuario();
                $pruebasData = $pruebaInstance->mostrarUsuarios();

                $modalPreguntaTitle = "Eliminar Usuario";
                $modalPreguntaDescription = '¿Estás de acuerdo con eliminar El usuario <strong class="deleteName">Test</strong>? Esta operación no puede revertirse.';
                include '../../common/modal-pregunta.php';
                ?>
                <table class="table table-result">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Usuario</th>
                            <th>Permiso</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pruebasData as $prueba) { ?>
                            <tr data-delete-row-id="<?= $prueba['id_usuario'] ?>">
                                <td><?= $prueba['id_usuario'] ?></td>
                                <td><?= $prueba['nombre'] ?></td>
                                <td><?= $prueba['apellidos'] ?></td>
                                <td><?= $prueba['usuario'] ?></td>
                                <td><?= $prueba['permiso'] ?></td>
                                <td class="row-buttons">
                                    <div class="d-flex">
                                        <a href="modificarUsuarios.php?id_prueba=<?= $prueba['id_usuario'] ?>" class="btn btn-outline-primary me-3">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <button class="btn btn-outline-primary btnDelete" data-delete-id="<?= $prueba['id_usuario'] ?>" data-delete-name="<?= $prueba['nombre'] ?>" data-delete-url="../../controllers/POO/borrar-usuario-funcion.php" data-delete-type="prueba">
                                            <i class="bi bi-trash-fill" data-delete-id="<?= $prueba['id_usuario'] ?>" data-delete-name="<?= $prueba['nombre'] ?>" data-delete-url="../../controllers/POO/borrar-usuario-funcion.php" data-delete-type="prueba"></i>
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
        $modalTitle = "¡Usuario actualizada!";
        $modalDescription = "Los datos del Usuario <strong>{$_SESSION['mensaje']}</strong> fueron actualizados correctamente.";
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