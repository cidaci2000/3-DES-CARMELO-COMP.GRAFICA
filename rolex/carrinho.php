

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<html>
    <head>
        <link rel="stylesheet" href="addtocart.css">
        <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="header">
            <p class="logo">Bem vindo a 𝓜𝓘𝓢𝓣𝓔𝓡 𝓒𝓛𝓞𝓒𝓚</p>
            <div class="cart"><i class="fa-solid fa-cart-shopping"></i><p id="count">0</p></div>
        </div>
        <div class="container">
            <div id="root"></div>
            <div class="sidebar">
                <div class="head"><p>CARRINHO</p></div>
                <div id="cartItem">SEU CARRINHO ESTÁ VAZIO</div>
                <div class="foot">
                    <h3>Total</h3>
                    <h2 id="total">R$ 0.00</h2>
                </div>
            </div>
        </div>
        <script src="addtocart.js"></script>
        <?php
    include_once('config.php');
    // Receber os dados do JavaScript
    $data = json_decode(file_get_contents('addtocart.js'), true);
    
    // Preparar e executar a query
    $sql = "INSERT INTO pedidos (title, price, total) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    // Vincular os parâmetros
    mysqli_stmt_bind_param($stmt, "ssd", $data['title'], $data['price'], $data['total']);
    
    // Executar a query
    mysqli_stmt_execute($stmt);
    
    // Verificar se a inserção foi bem-sucedida
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conexao)]);
    }
    
    // Fechar a declaração e a conexão
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    ?>

    </body>
</html>