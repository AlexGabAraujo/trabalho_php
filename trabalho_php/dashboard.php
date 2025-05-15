<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script>
        
        function carregarUsuarios() {
            fetch("usuarios.php")
                .then(res => res.json())
                .then(data => {
                    const lista = document.getElementById("lista-usuarios");
                    lista.innerHTML = "";

                    data.forEach(usuario => {
                        const linha = document.createElement("tr");
                        linha.innerHTML = `<td>${usuario.Nome}</td><td>${usuario.Email}</td>`;
                        lista.appendChild(linha);
                    });
                })
                .catch(err => {
                    console.error("Erro ao carregar usuários:", err);
                });
        }

        window.onload = carregarUsuarios;
    </script>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION["nome"]); ?>!</h1>
    <h4>Email logado atualmente: <?php echo htmlspecialchars($_SESSION["email"]); ?></h4>
    <h2>Usuários cadastrados:</h2>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="lista-usuarios">

        </tbody>
    </table>

    <div style="text-align: center; margin-top: 10px;">
        <form action="logout.php" method="post">
            <input type="submit" value="Sair" style="
                padding: 8px 16px;
                background-color: #e74c3c;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            ">
        </form>
    </div>


    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        padding: 20px;
    }

    h1, h2, h4 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    thead {
        background-color:rgb(137, 191, 214);
        color: white;
    }

    th, td {
        padding: 12px 16px;
        text-align: left;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #e9ffe9;
        transition: background-color 0.3s;
    }
</style>

</body>
</html>