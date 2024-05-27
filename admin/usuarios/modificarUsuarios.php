<?php
include '../../common/session-checker.php';
require_once '../../controllers/POO/CLASS//Usuarios.php';
require_once "../../controllers/POO/CLASS/funciones.php";

$title = "Actualizar usuario";
$description = "Modifica los datos registrados del usuario.";
$panelAdmin = true;

$database = new Usuario();
if (isset($_GET['id_prueba']) && !empty($_GET['id_prueba'])) {
    $idPrueba = limpiar($_GET['id_prueba']);
    $datosPrueba = $database->obtenerUsuarioPorId($idPrueba);
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php include '../../common/header.php';  ?>
    <?php include '../../common/sidebar.php'; ?>

    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>

        <div class="card">
            <div class="card-body">

                <?php
                if (isset($datosPrueba) && $datosPrueba) {
                ?>
                    <form id="formulario" class="row g-4 needs-validation" novalidate action="../../controllers/POO/usuario-editar.php" method="post">
                        <input type='hidden' name='id_usuario' value="<?php echo htmlspecialchars($datosPrueba['id_usuario']); ?>">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['nombre']); ?>" required placeholder="Nombre">
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="apellidos" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['apellidos']); ?>" required placeholder="Apellidos">
                                <label for="apellidos">Apellidos</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" name="dni" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['dni']); ?>" required placeholder="DNI">
                                <label for="dni">DNI</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="usuario" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['usuario']); ?>" required placeholder="Usuario">
                                <label for="usuario">Usuario</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="permiso" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['permiso']); ?>" required placeholder="Permiso">
                                <label for="permiso">Permiso</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating">
                                <input type="text" name="num_colegiado" class="form-control" value="<?php echo htmlspecialchars($datosPrueba['num_colegiado']); ?>" required placeholder="Numero Colegiado">
                                <label for="num_colegiado">Numero Colegiado</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary" name='accion' value="editar">Actualizar Usuario</button>
                        </div>
                    </form>
                <?php
                } else {
                    echo '<div class="alert alert-danger"><i class="bi bi-exclamation-octagon me-3"></i>No se encontró la prueba.</div>';
                }
                ?>
            </div>
        </div>

        <!-- <section class="section dashboard">
      <form action='../../controllers/POO/prueba-editar.php' method='POST'>
        <input type='hidden' name='id_prueba' value="<?php echo htmlspecialchars($datosPrueba['id_prueba']); ?>">
        <div class="form-group">
          <label for="nombre_prueba">Nombre de la Prueba</label>
          <input type='text' class="form-control" name='nombre_prueba' value="<?php echo htmlspecialchars($datosPrueba['nombre_prueba']); ?>">
        </div>
        <div class="form-group">
          <label for="valor_ref_min">Valor Ref. Mínimo</label>
          <input type='text' class="form-control" name='valor_ref_min' value="<?php echo htmlspecialchars($datosPrueba['valor_ref_min']); ?>">
        </div>
        <div class="form-group">
          <label for="valor_ref_max">Valor Ref. Máximo</label>
          <input type='text' class="form-control" name='valor_ref_max' value="<?php echo htmlspecialchars($datosPrueba['valor_ref_max']); ?>">
        </div>
        <div class="form-group">
          <label for="unidades">Unidades</label>
          <input type='text' class="form-control" name='unidades' value="<?php echo htmlspecialchars($datosPrueba['unidades']); ?>">
        </div>
        <button type='submit' name='accion' value="editar" class='btn btn-primary'>Actualizar Prueba</button>
      </form>
    </section> -->
    </main>
    <?php require_once __DIR__ . '/../../common/footer.php'; ?>
</body>

</html>