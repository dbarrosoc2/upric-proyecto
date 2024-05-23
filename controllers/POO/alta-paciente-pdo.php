<?php
session_start();
require_once "../../controllers/POO/CLASS/Paciente.php";
require_once "../../controllers/POO/CLASS/funciones.php";

$title = "Alta Paciente";
?>
<!DOCTYPE html>
<html lang="es">
<?php
require_once __DIR__ . '/../../common/head.php';
require_once __DIR__ . '/../../common/header-iniciado.php';
?>

<body class="bg-light">

  <div class="container mt-5">
    <h1 class="mb-4">Dar de Alta a Paciente</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="dni">DNI: <span class="text-danger">*</span></label>
            <input type="text" value="<?= isset($dni) ? $dni : '' ?>" class="form-control" id="dni" name="dni" maxlength="50" required>
          </div>
          <div class="form-group">
            <label for="nombre">Nombre: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="<?= isset($nombre) ? $nombre :  '' ?>" id="nombre" name="nombre" required>
          </div>

          <div class="form-group">
            <label for="nombre2">Segundo Nombre:</label>
            <input type="text" class="form-control" value="<?= isset($nombre2) ? $nombre2 :  '' ?>" id="nombre2" name="nombre2">
          </div>

          <div class="form-group">
            <label for="apellido">Apellido: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="<?= isset($apellido) ? $apellido :  '' ?>" id="apellido" name="apellido" required>
          </div>

          <div class="form-group">
            <label for="apellido2">Segundo Apellido:</label>
            <input type="text" class="form-control" value="<?= isset($apellido2) ? $apellido2 :  '' ?>" id="apellido2" name="apellido2">
          </div>

          <div class="form-group">
            <label for="confirmatorio">Confirmatorio: <span class="text-danger">*</span></label>
            <select class="form-control" id="confirmatorio" value="<?= isset($confirmatorio) ? $confirmatorio : '' ?>" name="confirmatorio" required>
              <option value=""> </option>
              <option value="0">No</option>
              <option value="1">Sí</option>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="fecha_confirmatorio">Fecha Confirmatorio:</label>
            <input type="date" class="form-control" value="<?= isset($fecha_confirmatorio) ? $fecha_confirmatorio : '' ?>" id="fecha_confirmatorio" name="fecha_confirmatorio">
          </div>

          <div class="form-group">
            <label for="telefono">Teléfono: <span class="text-danger">*</span></label>
            <input type="tel" class="form-control" value="<?= isset($telefono) ? $telefono : '' ?>" id="telefono" name="telefono" required>
          </div>

          <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento: <span class="text-danger">*</span></label>
            <input type="date" class="form-control" value="<?= isset($fecha_nacimiento) ? $fecha_nacimiento : '' ?>" id="fecha_nacimiento" name="fecha_nacimiento" required>
          </div>

          <div class="form-group">
            <label for="estado">Estado: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="estado" value="<?= isset($estado) ? $estado : '' ?>" name="estado" required>
          </div>

          <div class="form-group">
            <label for="municipio">Municipio:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="<?= isset($municipio) ? $municipio : '' ?>" id="municipio" name="municipio" required>
          </div>

          <div class="form-group">
            <label for="parroquia">Parroquia:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="<?= isset($parroquia) ? $parroquia : '' ?>" id="parroquia" name="parroquia" required>
          </div>

          <div class="form-group">
            <label for="calle">Calle:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="calle" value="<?= isset($calle) ? $calle : '' ?>" name="calle" required>
          </div>

          <div class="form-group">
            <label for="resto">Resto:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="<?= isset($resto) ? $resto : '' ?>" id="resto" name="resto">
          </div>

          <div class="form-group">
            <label for="hospital_referencia">Hospital de Referencia:<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="<?= isset($hospital_referencia) ? $hospital_referencia : '' ?>" id="hospital_referencia" name="hospital_referencia" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="comentario">Comentario:</label>
        <textarea class="form-control" id="comentario" value="<?= isset($comentario) ? $comentario : '' ?>" name="comentario" rows="4"></textarea>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="submit">Dar de Alta</button>
      </div>
    </form>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $dni = isset($_POST['dni']) ? limpiar($_POST['dni']) : '';
    $nombre = isset($_POST['nombre']) ? limpiar($_POST['nombre']) : '';
    $nombre2 = isset($_POST['nombre2']) ? limpiar($_POST['nombre2']) : '';
    $apellido = isset($_POST['apellido']) ? limpiar($_POST['apellido']) : '';
    $apellido2 = isset($_POST['apellido2']) ? limpiar($_POST['apellido2']) : '';
    $confirmatorio = isset($_POST['confirmatorio']) ? limpiar($_POST['confirmatorio']) : '';
    $fecha_confirmatorio = isset($_POST['fecha_confirmatorio']) ? limpiar($_POST['fecha_confirmatorio']) : '';
    $telefono = isset($_POST['telefono']) ? limpiar($_POST['telefono']) : '';
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? limpiar($_POST['fecha_nacimiento']) : '';
    $estado = isset($_POST['estado']) ? limpiar($_POST['estado']) : '';
    $municipio = isset($_POST['municipio']) ? limpiar($_POST['municipio']) : '';
    $parroquia = isset($_POST['parroquia']) ? limpiar($_POST['parroquia']) : '';
    $calle = isset($_POST['calle']) ? limpiar($_POST['calle']) : '';
    $resto = isset($_POST['resto']) ? limpiar($_POST['resto']) : '';
    $hospital_referencia = isset($_POST['hospital_referencia']) ? limpiar($_POST['hospital_referencia']) : '';
    $comentario = isset($_POST['comentario']) ? limpiar($_POST['comentario']) : '';

    // Crear una instancia de la clase Paciente
    $database = new Paciente();
    //Llamar al metodo crear paciente para añadir este paciente a la BBDD
    $database->crearPaciente($dni, $nombre, $nombre2, $apellido, $apellido2, $confirmatorio, $fecha_confirmatorio, $telefono, $fecha_nacimiento, $estado, $municipio, $parroquia, $calle, $resto, $hospital_referencia, $comentario);
  }
  ?>

  <!-- Footer -->
  <?php require_once __DIR__ . '/../../common/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<style>
  .text-danger {
    color: red;
  }
</style>

</html>