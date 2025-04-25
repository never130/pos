<?php
$host = "127.0.0.1";
$db = "pos";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT DISTINCT category FROM stock";
$result = $conn->query($sql);
$categorias = [];
while ($row = $result->fetch_assoc()) {
    $categorias[] = $row['category'];
}
echo json_encode($categorias);
$conn->close();
