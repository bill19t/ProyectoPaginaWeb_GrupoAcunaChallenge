<?php
require_once '../includes/conexion.php';
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
    default:
        $controller->error404();
        break;
}
