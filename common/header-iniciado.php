  <?php session_start(); ?>
  <!-- Barra de Navegación (fija) -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">
      <div class="container">
          <a class="navbar-brand" href="<?= $url_base ?>/admin/panel.php">
              <img src="<?= $url_base ?>public/images/logo.png" alt="Logo" width="40" height="35" class="d-inline-block align-text-top me-1">
              UPRIC
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="../pages/mi-cuenta.php">
                          Mi Cuenta
                      </a>
                  </li>
                  <li class="nav-item">
                      <button class="nav-link btn btn-link" onclick="volver()">Volver</button>
                  </li>
                  <li class="nav-item active">
                      <a class="nav-link" href="<?= $url_base ?>controllers/cerrar-sesion.php">Cerrar Sesión</a>
                  </li>
              </ul>
          </div><?php
                if (isset($_SESSION['datos_actualizados'])) {
                    echo "<div class='alert alert-success'>";
                    echo "<strong>Datos actualizados:</strong><br>";
                    foreach ($_SESSION['datos_actualizados'] as $id_paciente => $datos) {
                        echo "<div class='mb-3'>";
                        echo "<p class='mb-1'><strong>ID Paciente:</strong> $id_paciente</p>";
                        echo "<p class='mb-1'><strong>Resultado:</strong> " . $datos['resultado'] . "</p>";
                        echo "<p class='mb-0'><strong>Nota:</strong> " . $datos['nota'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    unset($_SESSION['datos_actualizados']); // Limpiar el mensaje después de mostrarlo
                } elseif (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']); // Limpiar el mensaje después de mostrarlo
                }
                ?>


          <?php
            $errores = array();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_prueba = isset($_POST['prueba_id']) ? limpiar($_POST['prueba_id']) : " ";
                if (empty($id_prueba)) {
                    $errores[] = "Debes seleccionar una prueba de la lista";
                }

                if (empty($errores)) {
                    $database = new Prueba_Paciente();
                    $pacientes = $database->listarPacientesParaResultados($id_prueba);

                    if (count($pacientes) > 0) {
                        // Agregar el campo oculto para id_prueba
                        echo "<div class='container'>";
                        echo "<form action='../../controllers/POO/guardar-resultados.php' method='post'>";
                        echo "<input type='hidden' name='id_prueba' value='$id_prueba'>";
                        $database->imprimirPruebaPorId($id_prueba);
                        echo "<br>";

                        foreach ($pacientes as $paciente) {
                            echo "<div class='form-group'>";
                            echo "<label for='resultado_" . $paciente['id_paciente'] . "'>ID Paciente: " . $paciente['id_paciente'] . "</label>";
                            echo "<input type='text' class='form-control' id='resultado_" . $paciente['id_paciente'] . "' name='resultado[" . $paciente['id_paciente'] . "]' placeholder='Resultado'>";
                            echo "<small class='form-text text-muted'>Ingresa el resultado para este paciente.</small>";
                            echo "<input type='text' class='form-control mt-2' name='nota[" . $paciente['id_paciente'] . "]' placeholder='Comentarios'>";
                            echo "<small class='form-text text-muted'>Ingresa un comentario si es necesario.</small>";
                            echo "</div>";
                        }
                        echo "<button type='submit' name='accion' value='Guardar Resultados' class='btn btn-primary'>Guardar Resultados</button>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        echo "<div class='alert alert-warning' role='alert'>No hay pacientes con esta prueba para reportar</div>";
                    }
                } else {
                    foreach ($errores as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
            }
            ?>
      </div>
  </nav>
  <!-- Espaciado para evitar que el contenido se superponga con la barra de navegación fija -->
  <div style="padding-top: 5rem;"></div>
  </header>