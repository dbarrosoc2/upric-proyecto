<?php
class RegistroLogger
{
    private $rutaArchivoCSV;

    public function __construct($rutaArchivoCSV)
    {
        $this->rutaArchivoCSV = $rutaArchivoCSV;
        if (!file_exists($this->rutaArchivoCSV)) {
            touch($this->rutaArchivoCSV);
            $encabezado = array('id_usuario', 'contraseña', 'url', 'ip', 'operación', 'observación');
            $this->agregarACSV($encabezado);
        }
    }

    private function agregarACSV($datos)
    {
        $archivo = fopen($this->rutaArchivoCSV, 'a');
        fputcsv($archivo, $datos);
        fclose($archivo);
    }

    public function inicioSesion($usuario, $contraseña, $ip, $comentario)
    {
        $datos = array($usuario, $contraseña, '', $ip, 'inicio_sesion', $comentario);
        $this->agregarACSV($datos);
    }

    public function navegacion($idUsuario, $url, $ip, $comentario)
    {
        $datos = array($idUsuario, '', $url, $ip, 'navegacion', $comentario);
        $this->agregarACSV($datos);
    }

    public function cierreSesion($idUsuario, $ip, $comentario)
    {
        $datos = array($idUsuario, '', '', $ip, 'cierre_sesion', $comentario);
        $this->agregarACSV($datos);
    }
}
