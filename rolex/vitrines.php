<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria de Imagens</title>
    <style>
        /* Estilos para centralizar o conteúdo e dar um espaçamento entre as imagens */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            flex-direction: column;
            
        }

            .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1000px;
            padding: 20px;
            color: #f0f0f0;
            }

            .gallery img {
            max-width: 170px;
            height: 170px;
            display: block;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
            color: #555;
            transition: opacity 0.3s ease-in-out; /* Add transition */
            }

            .gallery img:hover {
            opacity: 0.2; /* Set the desired opacity on hover */
            }

            p {
            color: #f0f0f0;
            }

        .caption {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #f0f0f0;
        }
    header{
        display: flex;
        flex-direction: row;
        text-align: center;
        background-color:#66989a;
        justify-content: space-between;
        

    }
    /* Estilos nave bar */
    
        .nav {
        background-color:#66989a;
        overflow: hidden;
        margin-top: 50%;
        
        }

        nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: flex-end;
        margin-top: 20%;
        
        }

        nav li {
        float: left;
        }

        nav li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }

        nav li a:hover {
        background-color: #111;
        }
    </style>
    
</head>

<body style="background-color:#66989a ; background-size: cover; background-repeat: no-repeat;">
   <header>
    <div class="container">
            <h1>Bem vindo a 𝓜𝓘𝓢𝓣𝓔𝓡 𝓒𝓛𝓞𝓒𝓚</h1>
            <p>𝑼𝒎𝒂 𝒍𝒐𝒋𝒂 𝒐𝒏𝒍𝒊𝒏𝒆 𝒑𝒂𝒓𝒂 𝒒𝒖𝒆𝒎 𝒃𝒖𝒔𝒄𝒂 𝒓𝒆𝒍𝒐𝒈𝒊𝒐𝒔 𝒑𝒓𝒆𝒎𝒊𝒖𝒏𝒔 𝒅𝒆 𝒂𝒍𝒕𝒂 𝒄𝒍𝒂𝒔𝒔𝒆.</p>
            
        </div>
        
        <nav>
            <ul>
            <li><a href="login.php">CARRINHO</a></li>
            <li><a href="#">CONTATO</a></li>
            <li><a href="vitrine.php">LOJA</a></li>
            </ul>
         </nav>
    </header>
    <section class="gallery">
        <div>
        <a href="carrinho.php" target="_blank"><img src="relogio.jpg" alt="Descrição da Imagem 1"></a>
        <p class="caption"> produto 1/ROLEX aquarium SEGUNDA CLASSE </p>
               

        </div>
        <div>
            <a href="carrinho.php" target="_blank"><img src="bct.jpeg" alt="Descrição da Imagem 2"></a> 
            <p class="caption"> Produto 2/ROLEX Ayrton Senna (edição unica)</p>
            

        </div>
        <div>
            <a href="carrinho.php" target="_blank"><img src="TEMPO.webp" alt="Descrição da Imagem 2"></a>
           <p class="caption"> Produto 3/ROLEX atemporal quantum  </p>
            
        </div>
        <div>
            <a href="carrinho.php" target="_blank"><img src="images1.jpeg" alt="Descrição da Imagem 2"></a>
            <p class="caption"> Produto 4/ROLEX la voiture</p>
         </div>
        <div>
            <a href="carrinho.php" target="_blank"><img src="family-yacht-master_portrait.webp" alt="Descrição da Imagem 2"></a>
            <p class="caption">Produto 5/ROLEX brisa de verao </p>
        
        </div>
        <div>
            <a href="carrinho.php" target="_blank"><img src="images1.jpeg" alt="Descrição da Imagem 2"></a>
            <p class="caption"> Produto 6/ROLEX sombra da noite</p>

        </div>
        <div>
            <a href="carrinho.php" target="_blank"><img src="capa-post-modelo-mais-barato-rolex-260321.jpg" alt="Descrição da Imagem 2"></a>
            <p class="caption"> Produto 7/ROLEX phantum boys</p>
            

        </div> <div>
            <a href="carrinho.php" target="_blank"><img src="images.jpeg" alt="Descrição da Imagem 2"></a>
            <p class="caption"> Produto 8/ROLEX horizon</p>
            
       
        </div>
        

        <!-- Adicione mais imagens conforme necessário -->
    </section>
</body>
</html>
