<?php
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Função para upload de imagem (com tratamento de erros)
    function uploadImagem($imagem) {
        $target_dir = "imagem/";
        $target_file = $target_dir . basename($imagem["name"]);

        if (move_uploaded_file($imagem["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            echo "Erro ao fazer upload da imagem.";
            return null;
        }
    }

    // Recebendo os dados do formulário
    $nome = $_POST['nome'];
    $imagem = $_FILES["imagem"];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    
    

    // Upload da imagem
    $imagem_path = null;
    if (isset($imagem) && $imagem["error"] === 0) {
        $imagem_path = uploadImagem($imagem);
        if (!$imagem_path) {
            $erros[] = "Erro ao enviar a imagem.";
        }
    }

    // Verifica se o upload da imagem foi bem-sucedido
    if ($imagem_path) {
        // Preparando a query SQL com parâmetros para evitar injeção de SQL
        $stmt = $conexao->prepare("INSERT INTO produto (nome, imagem, descricao, preco ) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $imagem_path, $descricao, $preco );

        // Executando a query
        if ($stmt->execute()) {
            echo "Novos registros inseridos com sucesso";
        } else {
            echo "Erro ao inserir registros: " . $stmt->error;
        }

        $stmt->close();
    }

    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produto.css">
    <title>Cadastro de Relógio</title>
</head>
<body>
    <section>
        <h1>Cadastro de Relógio</h1>
        <form action="cadastroproduto.php" method="post" enctype="multipart/form-data">
            <label for="nome">Nome do Relógio:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="imagem">Imagem do relógio:</label>
            <input type="file" id="imagem" name="imagem" accept="imagem/*">

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required>

            <input type="submit" value="Cadastrar">
        </form>
    </section>
    <h1> <a href="adm.php"><button>PÁGINA DE ADMINISTRADOR</button></a> </h1>
</body>
</html>
<?php
session_start();
include 'config.php'; // Arquivo com as configurações do banco de dados



$sql = "SELECT * FROM produto";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <style>
        /* Adicione seus estilos aqui */
    </style>
</head>
<body>
<style>
    table{
       margin-left: 35%;
       background-color: #dbe912;
    }
    h2{
        text-align: center;
        color: white;
    }
</style>
<h2>Lista de Produtos</h2>
<table border="1">
    <thead>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>imagem</th>
            <th>descrição</th>
            <th>Preço</th>
            
            
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['imagem']; ?></td>
            <td><?php echo $row['descricao']; ?></td>
            <td>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></td>
            
            
        </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>

