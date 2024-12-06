<?php
include("../Modelo/conexion.php");
$con = conectar();

$id = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id='$id'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $pantalla = $_POST['pantalla'];
    $procesador = $_POST['procesador'];
    $camara = $_POST['camara'];
    $bateria = $_POST['bateria'];
    $so = $_POST['so'];
    $conectividad = $_POST['conectividad'];

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $fecha = new DateTime();
        $imagen = $fecha->getTimestamp() . "_" . $imagen;

        $directorio = "../Public/IMG/productos/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if ($row['imagen'] != "IMG/productos/default.jpg" && file_exists("../Public/" . $row['imagen'])) {
            unlink("../Public/" . $row['imagen']);
        }

        if (move_uploaded_file($imagen_temporal, $directorio . $imagen)) {
            $ruta_imagen = "IMG/productos/" . $imagen;

            $sql = "UPDATE productos SET 
                    modelo='$modelo', marca='$marca', precio='$precio', stock='$stock',
                    imagen='$ruta_imagen', Pantalla='$pantalla', Procesador='$procesador',
                    Camara_Principal='$camara', Bateria='$bateria', Sistema_Operativo='$so',
                    Conectividad='$conectividad' WHERE id='$id'";
        }
    } else {
        $sql = "UPDATE productos SET 
                modelo='$modelo', marca='$marca', precio='$precio', stock='$stock',
                Pantalla='$pantalla', Procesador='$procesador', Camara_Principal='$camara',
                Bateria='$bateria', Sistema_Operativo='$so', Conectividad='$conectividad'
                WHERE id='$id'";
    }

    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: tabla.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="../Modelo/style.css">
</head>

<body>
    <div class="form-container">
        <h2>Actualizar Producto</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value=2"<?php echo $row['id'] ?>">
            <input type="text" name="modelo" value="<?php echo $row['modelo'] ?>" required>
            <input type="text" name="marca" value="<?php echo $row['marca'] ?>" required>
            <input type="number" name="precio" value="<?php echo $row['precio'] ?>" required step="0.01">
            <input type="number" name="stock" value="<?php echo $row['stock'] ?>" required>
            <input type="text" name="pantalla" value="<?php echo $row['Pantalla'] ?>" required>
            <input type="text" name="procesador" value="<?php echo $row['Procesador'] ?>" required>
            <input type="text" name="camara" value="<?php echo $row['Camara_Principal'] ?>" required>
            <input type="text" name="bateria" value="<?php echo $row['Bateria'] ?>" required>
            <input type="text" name="so" value="<?php echo $row['Sistema_Operativo'] ?>" required>
            <input type="text" name="conectividad" value="<?php echo $row['Conectividad'] ?>" required>

            <div class="form-group">
                <label>Imagen Actual:</label>
                <img src="../Public/<?php echo $row['imagen'] ?>" alt="Imagen actual" style="max-width: 200px; margin: 10px 0;">

                <label for="imagen">Cambiar Imagen (opcional):</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
                <img id="preview" src="" style="max-width: 200px; display: none; margin-top: 10px;">
            </div>

            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    </div>

    <script>
        document.getElementById('imagen').onchange = function(e) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>

</html>