<?php
// Inclui o arquivo de configuração
include_once('config.php');

// Verifica se o formulário foi enviado
if (isset($_POST['update'])) {
    // Sanitiza os dados do formulário para evitar injeção de SQL
    $id = mysqli_real_escape_string($conexao, $_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $sobrenome = mysqli_real_escape_string($conexao, $_POST['sobrenome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $endereco= mysqli_real_escape_string($conexao, $_POST['endereco']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado= mysqli_real_escape_string($conexao, $_POST['estado']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
    $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
  

    // Prepara a consulta SQL utilizando prepared statements
    $sqlUpdate = "UPDATE usuarios SET nome=?, sobrenome=?, email=?, telefone=?, endereco=?, cidade=?, estado=?, cep=?, data_nascimento=?, data_cadastro=?  WHERE id=?";
    $stmt = $conexao->prepare($sqlUpdate);
    $stmt->bind_param("sssssssi", $nome, $sobrenome, $email,$telefone,$endereco,$cidade,$estado,$cep, $data_nascimento,$data_cadastro, $id);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
}

// Redireciona para a lista de clientes
header('Location: listacliente.php');
?>
