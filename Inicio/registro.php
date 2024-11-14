<?php
include("../includes/conexion.php");
$con = conectar();

if (isset($_POST['registrar'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el email ya existe
    $verificar = mysqli_query($con, "SELECT * FROM usuarios WHERE email='$email'");
    if (mysqli_num_rows($verificar) > 0) {
        $error = "Este email ya está registrado";
    } else {
        $sql = "INSERT INTO usuarios (nombre, email, password) 
                VALUES ('$nombre', '$email', '$password')";

        if (mysqli_query($con, $sql)) {
            header("Location: login.php");
        } else {
            $error = "Error al registrar usuario";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="auth-container">
        <h2>Registro de Usuario</h2>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required
                    minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                    title="Debe contener al menos un número, una letra mayúscula y minúscula, y al menos 6 caracteres">
            </div>

            <input type="submit" name="registrar" value="Registrarse">

            <div class="auth-links">
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>
</body>

</html>