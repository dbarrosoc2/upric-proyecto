<?php
include '../common/session-checker.php';

$title = 'Panel de administrador';
$description = 'Resumen estadístico de UPRIC';
$panelAdmin = true
?>

<!DOCTYPE html>
<html lang="es">

<?php include '../common/head.php'; ?>

<body>

  <?php include '../common/header.php';    ?>

  <?php include '../common/sidebar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <?php include '../common/page-title.php'; ?>

      <section class="section dashboard">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
            <div class="col-xxl-3 col-md-3">
                <div class="card info-card">

                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="#">Alta</a></li>
                      <li><a class="dropdown-item" href="#">Consultar</a></li>
                      <li><a class="dropdown-item" href="#">Asignar pruebas</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Pacientes</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-file-person"></i>
                      </div>
                      <div class="ps-3">
                        <h6>$3,264</h6>
                        <span class="text-muted small pt-2 ps-1">Registrados</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">

                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="#">Alta</a></li>
                      <li><a class="dropdown-item" href="#">Consultar</a></li>
                      <li><a class="dropdown-item" href="#">Reportar</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Pruebas</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-medical"></i>
                      </div>
                      <div class="ps-3">
                        <h6>$3,264</h6>
                        <span class="text-muted small pt-2 ps-1">Registradas</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Opciones</h6>
                      </li>

                      <li><a class="dropdown-item" href="#">Imprimir</a></li>
                      <li><a class="dropdown-item" href="#">Enviar por correo</a></li>
                      <li><a class="dropdown-item" href="#">Historico Pacientes</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Resultados</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-printer"></i>
                      </div>
                      <div class="ps-3">
                        <h6>1244</h6>
                        <span class="text-muted small pt-2 ps-1">Impresos</span>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-md-3">
                <div class="card info-card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>

                      <li><a class="dropdown-item" href="#">Añadir Usuarios</a></li>
                      <li><a class="dropdown-item" href="#">Consultar/Eliminar Usuarios</a></li>
                      <li><a class="dropdown-item" href="#">Editar Usuarios</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="ps-3">
                        <h6>1244</h6>
                        <span class="text-muted small pt-2 ps-1">Registrados</span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </main>
  <div style="padding-top: 18rem;"></div>
  <?php include '../common/footer.php'; ?>
</body>

</html>