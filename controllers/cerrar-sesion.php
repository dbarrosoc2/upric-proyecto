<?php
session_start();

// vaciar las variables guardadas y cerrar sesion
session_unset();
session_destroy();

header("Location: ../pages/login.php");
