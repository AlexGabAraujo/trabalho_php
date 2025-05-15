<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "TRABALHOPHP";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar consulta para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, senha FROM USUARIO WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Se o usuário for encontrado, validar a senha
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $senha_hash);
        $stmt->fetch();

        if (password_verify($senha, $senha_hash)) {
            $_SESSION['user_id'] = $id; // Iniciar sessão
            header("Location: dashboard.php"); // Redirecionar para a página principal
            exit();
        } else {
            echo "<script>alert('Senha incorreta!'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('E-mail não encontrado!'); window.location.href='index.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>