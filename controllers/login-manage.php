<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "funciones.php";

    $user = limpiar($_POST['user']);
    $pass = limpiar($_POST['pass']);

    if (empty($user) || empty($pass)) {
        $_SESSION['errores'] = "Debes ingresar usuario y contraseña.";

        header("Location: ../pages/login.php");
        exit();
    }

    // Databse Connection
    echo "Sin error";
    $conn = include "./database-connection.php";
    echo "error";
    exit();
    try {
        $query = "SELECT nombre, apellidos, dni, usuario, permiso, num_colegiado, id_usuario
        FROM usuario 
        WHERE (usuario=:user AND clave = md5(:pass))
        OR (dni=:user AND clave = md5(:pass));";

        $stmt = $conn->prepare($query);
        $stmt->execute(['user' => $user, 'pass' => $pass]);

        require "./POO/CLASS/Logs.php";
        $logs = new RegistroLogger("registroCSVLogin.csv");

        if ($stmt->rowCount() > 0) {
            $logs->inicioSesion($user, "clave Usuario", "LOGIN CORRECTO");

            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['valid'] = true;
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['apellido'] = $fila['apellidos'];
            $_SESSION['dni'] = $fila['dni'];
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['id_usuario'] = $fila['id_usuario'];
            $_SESSION['permiso'] = $fila['permiso'];
            $_SESSION['num_colegiado'] = $fila['num_colegiado'];
            if ($user == $pass) {
                header("Location: ../admin/usuarios/cambio-contrasena.php");
            } else {
                header("Location: ../admin/panel.php");
            }
        } else {
            // $errores[] = '<div class="alert alert-danger" role="alert">Usuario no encontrado.</div>';
            $_SESSION['errores'] = "Existe un error con tu usuario o contraseña.";
            $logs->inicioSesion($user, $clave, $_SERVER['REMOTE_ADDR'], "LOGIN INCORRECTO");
            header("Location: ../pages/login.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['errores'] = "Ha ocurrido un error inesperado: {$e->getMessage()}</div>";
    }
}
