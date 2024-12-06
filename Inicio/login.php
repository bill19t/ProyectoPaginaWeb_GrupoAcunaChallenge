<?php
session_start();
require_once("../Modelo/conexion.php");

if (isset($_SESSION['usuario_id'])) {
    if ($_SESSION['rol'] === 'admin') {
        header("Location: ../Modelo/tabla.php");
    } else {
        header("Location: ../Vista/inicio.php");
    }
    exit();
}

$con = conectar();

if (isset($_POST['iniciar'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_array($result);
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['last_activity'] = time();

            if ($_SESSION['rol'] === 'admin') {
                header("Location: ../Modelo/tabla.php");
            } else {
                // Verificar si hay una redirección pendiente
                if (isset($_GET['redirect']) && $_GET['redirect'] == 'productos') {
                    header("Location: ../Vista/productos.php");
                } else {
                    header("Location: ../Vista/inicio.php");
                }
            }
            exit();
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="auth-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] . (isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : ''); ?>" method="POST" class="auth-form">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required>
            </div>

            <input type="submit" name="iniciar" value="Iniciar Sesión">

            <div class="auth-links">
                <p>¿No tienes cuenta? <a href="registro.php<?php echo isset($_GET['redirect']) ? '?redirect=' . $_GET['redirect'] : ''; ?>">Regístrate aquí</a></p>
            </div>
        </form>
    </div>
</body>

</html>