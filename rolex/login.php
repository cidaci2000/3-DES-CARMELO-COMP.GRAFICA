<?php
include_once('config.php');

// Verifica se houve um envio de formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação básica (adicione mais validações conforme necessário)
    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Prepare a consulta SQL para evitar injeção
        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email=? AND senha=?");
        $stmt->bind_param("ss", $email, $senha); // Assumindo que email e senha são strings

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verifica o tipo de usuário
                if ($row['tipo'] == 1) {
                    // Login válido para administrador, redireciona para adm.php
                    header("Location: adm.php");
                } elseif ($row['tipo'] == 2) {
                    // Login válido para cliente especial, redireciona para especial.php
                    header("Location: profissional.php");
                } else {
                    // Login válido para outro tipo de usuário, redireciona para home
                    header("Location: vitrines.php");
                }
            } else {
                echo "Email ou senha inválidos.";
            }
        } else {
            // Trata erros na execução da consulta
            echo "Erro ao realizar a consulta: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>Login</title>
</head>

<body>
<header>
        <h1>𝓜𝓘𝓢𝓣𝓔𝓡 𝓒𝓛𝓞𝓒𝓚</h1>
        <nav>
            <ul>
                <li><a href="vitrine.php">HOME</a></li>
                
                <li><a href="#">CONTATO</a></li>
                
              </ul>
        </nav>
    </header>
<h2>LOGIN</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"  required>

        <button type="submit">Entrar</button>
    </form>   

</body>
</html>
