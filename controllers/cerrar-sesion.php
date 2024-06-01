<?php
require "./POO/CLASS/Logs.php";
$logs = new RegistroLogger("registroCSVLogin.csv");
$logs->cierreSesion($_SESSION["usuario"],$_SERVER['REMOTE_ADDR'], "CERRADA LA SESION" );
session_start();

// vaciar las variables guardadas y cerrar sesion
session_unset();
session_destroy();

header("Location: ../pages/login.php");
