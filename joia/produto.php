<?php
include_once('config.php'); // Include database configuration file

// Check database connection
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

// Initialize variables
$nomeJoia = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$tipoJoia = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
$material = filter_input(INPUT_POST, 'material', FILTER_SANITIZE_STRING);
$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT);

// Check if form data is complete
if (empty($nomeJoia) || empty($tipoJoia) || empty($material) || empty($valor) || empty($_FILES['imagens'])) {
    $errorMessage = "Preencha todos os campos e selecione pelo menos uma imagem.";
} else {
    // Process and store uploaded images
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Add more extensions if needed
    $maxFileSize = 2097152; // 2MB in bytes
    $uploadPath = 'imagens/'; // Change this to your desired upload directory

    $uploadedImages = [];
    $errorMessages = [];

    foreach ($_FILES['imagens']['error'] as $key => $error) {
        if ($error === UPLOAD_ERR_OK) {
            $fileName = $_FILES['imagens']['name'][$key];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileTmpPath = $_FILES['imagens']['tmp_name'][$key];
            $fileSize = $_FILES['imagens']['size'][$key];

            if (in_array($fileExtension, $allowedExtensions)) {
                if ($fileSize <= $maxFileSize) {
                    $newFileName = uniqid() . '.' . $fileExtension;
                    if (move_uploaded_file($fileTmpPath, $uploadPath . $newFileName)) {
                        $uploadedImages[] = $newFileName;
                    } else {
                        $errorMessages[] = "Erro ao mover o arquivo: $fileName.";
                    }
                } else {
                    $errorMessages[] = "O arquivo $fileName excede o limite de tamanho (2MB).";
                }
            } else {
                $errorMessages[] = "Extensão inválida para o arquivo: $fbr.pr.govileName. (Permitidas: " . implode(', ', $allowedExtensions) . ").";
            }
        }
    }

    // If there are no errors, proceed with database insertion
    if (empty($errorMessages)) {
        // Convert uploadedImages array to a comma-separated string for database storage
        $imagensJoia = implode(',', $uploadedImages);

        $sqlInsertJoia = "INSERT INTO cadastro (nome_joia, tipo_joia, material, valor, imagens) VALUES ('$nomeJoia', '$tipoJoia', '$material', '$valor', '$imagensJoia')";

        if ($conexao->query($sqlInsertJoia) === TRUE) {
            $successMessage = "Joia cadastrada com sucesso!";
        } else {
            $errorMessage = "Erro ao cadastrar a joia: " . $conexao->error;
        }
    }
}

// Close database connection
$conexao->close();

?>

<?php if (isset($errorMessage)) : ?>
    <div class="error-message"><?php echo $errorMessage; ?></div>
<?php elseif (isset($successMessage)) : ?>
    <div class="success-message"><?php echo $successMessage; ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produto.css">
    <title>Cadastro de Joias</title>
    
</head>
<body>
    <h1>Cadastro de Joias</h1>

    <form action="produto.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome da Joia:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo de Joia:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Selecione o Tipo</option>
                <option value="anel">Anel</option>
                <option value="brinco">Brinco</option>
                <option value="colar">Colar</option>
                <option value="pulseira">Pulseira</option>
                <option value="outro">Outro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="material">Material:</label>
            <input type="text" id="material" name="material" required>
        </div>

        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="imagens">Imagens da Joia:</label>
            <input type="file" id="imagens" name="imagens[]" multiple required>
            <p class="form-hint">Selecione até 5 imagens (máximo 2MB cada).</p>
        </div>

        <button type="submit">Cadastrar Joia</button>
    </form>
</body>
</html>
