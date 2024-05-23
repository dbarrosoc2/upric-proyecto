<?php
require_once "./CLASS/Paciente.php"; 
require_once "./CLASS/funciones.php"; 
// if(isset($_POST['accion'])){
//     if(isset($_POST['id_paciente'])){
//         $id=limpiar($_POST['id_paciente']);
//         $database= new Paciente();
//         $database->borrarPaciente($id);     
//     }

// }

if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['id_paciente']){
    $id=limpiar($_POST['id_paciente']);
    $database= new Paciente();
    $response = $database->borrarPaciente($id);     

    return $response;
}