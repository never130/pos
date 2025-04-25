<?php
$host = "127.0.0.1";
$db = "pos";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : "";
if ($categoria === "") {
    $sql = "SELECT * FROM stock";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM stock WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria);
}

$stmt->execute();
$result = $stmt->get_result();
$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}
echo json_encode($items);
$stmt->close();
$conn->close();
?>
