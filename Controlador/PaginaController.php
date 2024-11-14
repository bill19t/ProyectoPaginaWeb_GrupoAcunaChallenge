<?php
class PaginaController
{
    public function inicio()
    {
        $titulo = 'Inicio';
        require_once '../Vista/inicio.php';
    }

    public function productos()
    {
        $titulo = 'Productos';
        require_once '../Vista/productos.php';
    }

    public function ubicacion()
    {
        $titulo = 'Ubicación';
        require_once '../Vista/ubicacion.php';
    }

    //public function error404()    {        $titulo = 'Página no encontrada';        require_once 'Vista/404.php';    }
}
