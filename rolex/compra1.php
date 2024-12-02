<?php
include_once ('config.php');



// Verificando a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error); 

}

// Recebendo dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Retrieve form data
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha']; // Hash the password

// Prepare and execute SQL statement
$sql = "INSERT INTO usuarios (nome, cpf, telefone, email, senha) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssss", $nome, $cpf, $telefone, $email, $senha);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color:#1e5052;
        }
        
        header{
            background-color: rgb(209, 197, 32);
            padding: 10px 0;
            text-align: center;
        }

        nav ul{
            list-style: none;

        }

        nav ul li{
            display: inline;
            margin-right: 20px;
        }
        nav ul li a{
            text-decoration: none;
            color: #151414;
            font-weight: bold;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: rgb(209, 197, 32);
        }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
    <h1>𝓜𝓘𝓢𝓣𝓔𝓡 𝓒𝓛𝓞𝓒𝓚</h1>
    <h2>Cadastro de Cliente</h2>
        <nav>
            <ul>
                <li><a href="vitrine.php">HOME</a></li>
                
                <li><a href="#">CONTATO</a></li>
                
              </ul>
        </nav>
        </header>
        <br><br>
<form action="compra1.php" method="post">
  <label for="nome">Nome:</label>
  <input type="text" id="nome" name="nome" required><br><br>

  <label for="cpf">CPF:</label>
  <input type="text" id="cpf" name="cpf" required><br><br>

  <label for="telefone">Telefone:</label>
  <input type="tel" id="telefone" name="telefone" required><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>

  <label for="senha">Senha:</label>
  <input type="password" id="senha" name="senha" required><br><br>

  <button type="submit">Cadastrar Agora</button>
</form>
</body>
</html>
