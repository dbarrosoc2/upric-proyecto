<?php

class Usuario
{
    private $conn;
    private $table_name = 'usuario';

    // Propiedades del paciente
    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $dni;
    private $usuario;
    private $permiso;
    private $num_colegiado;


    public function __construct()
    {
        $this->conn = require "../../controllers/database-connection.php";
    }

    public function listarUsuarios()
    {
        $query = "SELECT id_usuario, dni, nombre, apellidos, usuario FROM usuario";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function listarUsuarioParaSelect()
    {
        try {
            $queryPac = "SELECT id_usuario, dni, nombre, apellidos, usuario FROM usuario";
            $stmtPac = $this->conn->prepare($queryPac);
            $stmtPac->execute();

            $opcionesPacHTML = "<option value=''>Seleccionar paciente</option>"; // Agregar opción por defecto en blanco

            while ($filaPac = $stmtPac->fetch(PDO::FETCH_ASSOC)) {
                // Crear la opción para el select con los datos de cada paciente
                $opcionesPacHTML .= "<option value='" . $filaPac['dni'] . "'>" . $filaPac['usuario'] . " " . $filaPac['apellidos'] . " " . $filaPac['nombre'] . "</option>";
            }

            return $opcionesPacHTML;
        } catch (PDOException $e) {
            // Manejo de excepciones en caso de error de base de datos
            echo "Error al listar pacientes: " . $e->getMessage();
            return ""; // Devolver cadena vacía en caso de error
        }
    }


    // Método para borrar un paciente
    public function borrarUsuario($id)
    {
        if (!empty($id)) {
            $id = limpiar($id);
            // Primero, obtenemos los datos del paciente que se va a eliminar
            $queryInfo = "SELECT dni, nombre, apellidos FROM " . $this->table_name . " WHERE id_usuario = :id";

            try {
                session_start();
                $stmtInfo = $this->conn->prepare($queryInfo);
                $stmtInfo->bindParam(':id', $id);
                $stmtInfo->execute();
                $paciente = $stmtInfo->fetch(PDO::FETCH_ASSOC);

                if (!$paciente) {
                    $_SESSION['error1'] = "No se encontró el paciente con el ID especificado.";
                } else {

                    // Ahora, procedemos a eliminar el paciente
                    $queryDelete = "DELETE FROM " . $this->table_name . " WHERE id_usuario = :id";
                    $stmtDelete = $this->conn->prepare($queryDelete);
                    $stmtDelete->bindParam(':id', $id);
                    $resultado = $stmtDelete->execute();
                    if ($resultado) {
                        // Utiliza una variable de sesión para almacenar el mensaje de éxito

                        $_SESSION['mensaje'] = "<div class='alert alert-danger' role='alert'>Registro eliminado con éxito.\nDNI: " . $paciente['dni'] . "\nNombre: " . $paciente['nombre'] . "\nApellido: " . $paciente['apellido'] . "</div>";
                        header("Location: ../../admin/pacientes/consultar.php");
                    } else {
                        // Mensaje de error
                        $_SESSION['error'] = "<div class='alert alert-danger' role='alert'>Error al eliminar el registro.</div>";
                        header("Location: ../../admin/pacientes/consultar.php");
                    }
                }
            } catch (PDOException $e) {
                die("Error al procesar la solicitud: " . $e->getMessage());
            }
        }
    }

    public function consultarUsuario($busqueda)
    {
        try {
            $query = "SELECT id_usuario, dni, nombre, apellidos, usuario, permiso, num_colegiado
                  FROM $this->table_name 
                  WHERE id_usuario = :busqueda 
                  OR dni = :busqueda 
                  OR nombre LIKE CONCAT('%', :busqueda, '%')
                  OR apellidos LIKE CONCAT('%', :busqueda, '%')
                  OR usuario = :busqueda";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':busqueda', $busqueda);
            $stmt->execute();

            echo "<div class='container'>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='alert alert-success mensaje' role='alert'>  
        Usuario encontrado con los siguientes datos:<br>
        ID: " . $row['id_usuario'] . "<br>
        DNI: " . $row['dni'] . "<br>
        Nombre: " . $row['nombre'] . "<br>
        Apellido: " . $row['apellidos'] . " <br>
        Usuario: " . $row['usuario'] . "<br>
        Permiso: " . $row['Permiso'] . "<br>
        Numero Colegiado: " . $row['num_colegiado'] . "<br>
        

        <form method='POST' action='modificar.php'>
            <input type='hidden' name='id_paciente' value='" . $row['id_usuario'] . "'>
            <button type='submit' name='accion' value='editar' class='btn btn-primary'>Editar Paciente</button>
        </form>
        <form method='POST' action='../../controllers/POO/borrar-paciente-funcion.php'>
            <input type='hidden' name='id_paciente' value='" . $row['id_usuario'] . "'>
            <button type='submit' name='accion' value='borrar' class='btn btn-danger'>Borrar Paciente</button>
        </form>
    </div>";
            }
            echo "</div>";
        } catch (PDOException $e) {
            die("Error al procesar la solicitud: " . $e->getMessage());
        }
    }


    // Método para insertar un paciente
    public function crearPaciente($nombre, $apellidos, $dni, $usuario, $clave, $num_colegiado)
    {
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellidos, dni, usuario, clave, num_colegiado) 
        VALUES (:nombre, :apellidos, :dni, :usuario, :clave, :permiso, :num_colegiado)";

        $stmt = $this->conn->prepare($query);

        // Vinculación de valores usando propiedades de clase
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellidos);
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":clave", $clave);
        $stmt->bindParam(":num_colegiado", $num_colegiado);

        if ($stmt->execute()) {
            $ultimoIdInsertado = $this->conn->lastInsertId();
            // Impresión de los valores de las propiedades del paciente
            echo "<div class='alert alert-success' role='alert'>  
            Usuario creado con éxito con los siguientes datos:<br>
            El último ID insertado es: $ultimoIdInsertado<br>
            DNI: $dni<br>
            Nombre: $nombre <br>
            Apellido: $apellidos<br>
            Usuario: $usuario<br>         
            </div>";
        }
    }



    public function editarUsuario($id_usuario, $dni, $nombre, $apellidos, $usuario, $num_colegiado)
    {
        try {
            $query = "UPDATE " . $this->table_name . " 
                  SET dni=:dni, nombre=:nombre, apellidos=:apellidos, usuario=:usuario, num_colegiado=:num_colegiado
                  WHERE id_usuario = :id_usuario";

            $stmt = $this->conn->prepare($query);

            // Vinculación de valores
            $stmt->bindParam(":dni", $dni);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":num_colegiado", $num_colegiado);
            $stmt->bindParam(":id_usuario", $id_usuario);

            if ($stmt->execute()) {
                // Repopular $_SESSION
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellidos;
                $_SESSION['usuario'] = $usuario;
                $_SESSION['num_colegiado'] = $num_colegiado;
                $_SESSION['dni'] = $dni;
            }
        } catch (PDOException $e) {
            die("Error al procesar la solicitud: " . $e->getMessage());
        }
    }

    public function cambiarClave($id_usuario, $usuario_actual, $nueva_clave, $confirmar_clave)
    {
        try {
            // Verificar si las nuevas contraseñas coinciden
            if ($nueva_clave !== $confirmar_clave) {
                // Las contraseñas no coinciden, devolver un mensaje de error
                return "Las nuevas contraseñas no coinciden.";
            }

            // Verificar si el usuario actual y la contraseña actual coinciden
            $query_verificacion = "SELECT clave FROM " . $this->table_name . " WHERE id_usuario = :id_usuario AND usuario = :usuario";
            $stmt_verificacion = $this->conn->prepare($query_verificacion);
            $stmt_verificacion->bindParam(':id_usuario', $id_usuario);
            $stmt_verificacion->bindParam(':usuario', $usuario_actual);
            $stmt_verificacion->execute();
            $usuario = $stmt_verificacion->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                // El usuario actual no existe o la contraseña no coincide
                return "Usuario o contraseña actual incorrectos.";
            }

            // Hash de la nueva contraseña
            $nueva_clave_hash = password_hash($nueva_clave, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $query_actualizacion = "UPDATE " . $this->table_name . " SET clave = :nueva_clave WHERE id_usuario = :id_usuario";
            $stmt_actualizacion = $this->conn->prepare($query_actualizacion);
            $stmt_actualizacion->bindParam(':nueva_clave', $nueva_clave_hash);
            $stmt_actualizacion->bindParam(':id_usuario', $id_usuario);
            $stmt_actualizacion->execute();

            // Verificar si la actualización fue exitosa
            if ($stmt_actualizacion->rowCount() > 0) {
                // La contraseña se actualizó correctamente
                return "La contraseña se ha actualizado correctamente.";
            } else {
                // No se pudo actualizar la contraseña
                return "Error al actualizar la contraseña. Inténtalo de nuevo más tarde.";
            }
        } catch (PDOException $e) {
            // Manejo de excepciones en caso de error de base de datos
            return "Error al procesar la solicitud: " . $e->getMessage();
        }
    }
}
