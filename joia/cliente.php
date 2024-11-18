<?php
// Conexão com o banco de dados (substitua com seus dados)
include_once ('config.php');

// Verificando a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error); 

}

// Recebendo dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmaSenha'];

    // Preparando e executando a query SQL
    $sql = "INSERT INTO usuarios (nome, email, senha, confirmaSenha) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $confirmarSenha);

    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cliente: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="cliente.css">
</head>
<body>
<div class="container">
  <h1>Cadastro de Cliente</h1>
  <form action="cliente.php" method="post" id="registrationForm">
    <div class="form-group">
      <label for="nome">Nome Completo:</label>
      <input type="text" id="nome" name="nome" placeholder="Entre com seu nome completo" required>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Entre com seu email" required>
    </div>

    <div class="form-group">
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
      <span class="password-strength" id="passwordStrength"></span>
    </div>

    <div class="form-group">
      <label for="confirmaSenha">Confirmar Senha:</label>
      <input type="password" id="confirmaSenha" name="confirmaSenha" placeholder="Digite a senha novamente" required>
    </div>

    <div class="form-actions">
      <button type="submit">Cadastrar</button>
      <a href="venda.php"><button>Carrinho</button></a> <button type="reset">Limpar</button>
    </div>

    <p class="form-message" id="formMessage"></p>
  </form>
</div>
</body>
</html>