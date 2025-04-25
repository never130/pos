<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "pos";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$category = $_POST['category'];
$name = $_POST['name'];
$price = $_POST['price'];

$image = $_FILES['image'];
$img_name = basename($image["name"]);
$target_dir = "uploads/";
$target_file = $target_dir . time() . "_" . $img_name;

// Subir imagen al servidor y registrar en la base de datos
if (move_uploaded_file($image["tmp_name"], $target_file)) {
    $sql = "INSERT INTO stock (category, name, price, image_path)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $category, $name, $price, $target_file);

    if ($stmt->execute()) {
        echo "¡Producto insertado correctamente!";
    } else {
        echo "Error al insertar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error al subir la imagen.";
}

$conn->close();
?>
