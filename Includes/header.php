<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Móvil Perú - <?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../Public/CSS/style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../public/IMG/logo.png" width="50 px" height="80 px" alt="." >
                <span>El Rincón del Móvil Perú</span>
            </div>
            <ul>
                <li><a href="../Vista/Inicio.php?action=inicio">Inicio</a></li>
                <li><a href="../Vista/Productos.php?action=productos">Productos</a></li>
                <li><a href="../Vista/ubicacion.php?action=ubicacion">Ubicación</a></li>
                <?php if (isset($_SESSION['usuario'])): ?>
                    <li><a href="../Inicio/login.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li><a href="../Inicio/login.php">Iniciar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>