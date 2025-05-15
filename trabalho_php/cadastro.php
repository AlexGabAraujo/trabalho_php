<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "TRABALHOPHP";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['CPF'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuario (nome, cpf, email, senha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $cpf, $email, $senha);

    if ($stmt->execute()) {
    
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.html';</script>";

        
    } else {

        echo "<script>alert('Erro ao cadastrar: " . htmlspecialchars($stmt->error, ENT_QUOTES, 'UTF-8') . "');</script>";
        
    }
    

    $stmt->close();

}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Cadastro</title>

  
</head>
<body>

</body>
</html>



