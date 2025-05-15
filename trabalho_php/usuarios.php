<?php
$conn = new mysqli("localhost", "root", "admin", "TRABALHOPHP");

$sql = "SELECT Nome, Email FROM USUARIO";
$result = $conn->query($sql);

$usuarios = [];

while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

header('Content-Type: application/json');
echo json_encode($usuarios);
?>
