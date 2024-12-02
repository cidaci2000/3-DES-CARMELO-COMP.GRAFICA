<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "escola";
$dbname = "rolexrelogio";
// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação da conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para editar um usuário
function editarUsuario($usuario_id, $novo_nome, $novo_email, $novo_tipo) {
    global $conn;
    
    $sql = "UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $novo_nome, $novo_email, $novo_tipo, $usuario_id);
    
    if ($stmt->execute()) {
        echo "Usuário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar usuário: " . $stmt->error;
    }
    
    $stmt->close();
}

// Exemplo de uso
$usuario_id = 1; // ID do usuário a ser atualizado
$novo_nome = "Novo Nome";
$novo_email = "novoemail@example.com";
$novo_tipo = "usuario_comum";

editarUsuario($usuario_id, $novo_nome, $novo_email, $novo_tipo);

// Fechando a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cadastro de Cliente</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            background: url(imagem.jpg);
            background-size: 600px;
             background-repeat: no-repeat;
             background-position-x: center;
             background-color:black;
        }
        fieldset{
            background-color: #333;
            border: 5px;
            border-style:solid;
            border-color: rgb(0, 255, 0);
        }
        title{
            color:rgb(0, 255, 0);
        }
        h1{
            text-align: center;
        }
        header{
            background-color: palevioletred;
             padding: 10px 0;
            text-align: center;
            }
        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #45e05f;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #435dd1;
        }
        header{
            background-color: #333;
            padding: 10px 0;
            text-align: center;
            border: 5px;
            border-style:solid;
            border-color: rgb(0, 255, 0);
    
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

    </style>
</head>
<body>
    <header>
        <font color=lime><h1>INDIVIDEO</h1>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="cardapio.html">CARDÁPIO</a></li>
                <li><a href="contato.html">CONTATO</a></li>
                
              </ul>
        </nav>
       
    </header>
    <h1>Cadastro de Cliente</h1>
    <body>
    <a href="listacliente.php">Voltar</a>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Cliente</b></legend>
                <br>
        <label for="id">id:</label>
        <input type="number" id="id" name="id" required>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">cpf:</label>
        <input type="number" id="cpf" name="cpf" required>

        <label for="email">data de nascimento:</label>
        <input type="nember" id="datanasc" name="cpf" required>

        <label for="email">cep:</label>
        <input type="number" id="cep" name="cep" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>


        
        <br><br>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
    </font>
</html>