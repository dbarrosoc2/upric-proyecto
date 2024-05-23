<?php
require_once "./CLASS/Prueba.php"; 
require_once "./CLASS/funciones.php"; 
// if(isset($_POST['accion'])){
//     if(isset($_POST['id_prueba'])){
//         $id=limpiar($_POST['id_prueba']);
//         $database= new Prueba();
//         $database->borrarPrueba($id);
//     }
// }

if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['id_prueba']){
    $id=limpiar($_POST['id_prueba']);
    $database= new Prueba();
    $response = $database->borrarPrueba($id);     

    return $response;
}