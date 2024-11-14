<?php
session_start();
include("../includes/conexion.php");
$con = conectar();

if (isset($_POST['iniciar'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) == 1) {
        $usuario = mysqli_fetch_array($query);
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: ../Vista/inicio.php");
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

        <form action="" method="POST" class="auth-form">
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
                <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
            </div>
        </form>
    </div>
</body>

</html>