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
        echo "<p style='color: green;'>Cadastro realizado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <script>
        function validar(event) {
            event.preventDefault(); // Evita envio padrão

            const nome = document.getElementById("nome").value.trim();
            const cpf = document.getElementById("cpf").value.trim();
            const email = document.getElementById("email").value.trim();
            const senha = document.getElementById("senha").value.trim();

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!nome || !cpf || !email || !senha) {
                alert("Todos os campos são obrigatórios.");
                return;
            }

            if (!emailRegex.test(email)) {
                alert("E-mail inválido.");
                return;
            }

            document.querySelector("form").submit();
        }
    </script>
</head>
<body>

<h2>Formulário de Cadastro</h2>

<form method="post" action="">
    Nome: <input type="text" id="nome" name="nome"><br><br>
    CPF: <input type="text" id="cpf" name="CPF"><br><br>
    Email: <input type="email" id="email" name="email"><br><br>
    Senha: <input type="password" id="senha" name="senha"><br><br>
    <input type="submit" value="Cadastrar" onclick="validar(event)">
</form>

</body>
</html>