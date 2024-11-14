<?php
//require_once '../Includes/config.php';
require_once '../Includes/conexion.php';
require_once '../Controlador/PaginaController.php';

$controller = new PaginaController();

$action = $_GET['action'] ?? 'inicio';

switch ($action) {
    case 'inicio':
        $controller->inicio();
        break;
    case 'productos':
        $controller->productos();
        break;
    case 'ubicacion':
        $controller->ubicacion();
        break;
    //default:        $controller->error404();        break;
}
