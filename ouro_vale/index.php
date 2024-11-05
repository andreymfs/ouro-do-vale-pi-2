<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa Ouro do Vale</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Fundo claro */
            color: #333; /* Cor do texto */
            line-height: 1.6; /* Melhora a legibilidade */
        }

        .banner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .banner img {
            width: 100%;
            height: auto;
        }

        .menu {
            background-color: #0a700d; /* Cor de fundo do menu */
            color: white;
            padding: 1px 0;
            position: fixed;
            top: 150px; /* Abaixo do banner */
            width: 100%;
            z-index: 1000;
            display: flex;
            justify-content: center; /* Centraliza o menu */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra do menu */
        }

        .menu a {
            color: white; /* Texto branco */
            text-decoration: none;
            padding: 14px 20px;
            border-radius: 20px; /* Bordas arredondadas */
            transition: background-color 0.3s; /* Suaviza a transição de cor */
        }

        .menu a:hover {
            background-color: yellowgreen; /* Cor de fundo ao passar o mouse */
            color: black; /* Cor do texto ao passar o mouse */
        }

        .content {
            margin-top: 250px; /* Deixa espaço para o banner e menu fixo */
            padding: 20px;
            max-width: 800px; /* Largura máxima do conteúdo */
            margin-left: auto; /* Centraliza o conteúdo */
            margin-right: auto; /* Centraliza o conteúdo */
            background-color: white; /* Fundo branco */
            border-radius: 8px; /* Bordas arredondadas */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra do conteúdo */
        }

        h1 {
            font-weight: 600; /* Peso da fonte */
            color: #333; /* Cor do título */
            text-align: center; /* Centraliza o título */
        }

        p {
            margin-bottom: 15px; /* Espaçamento inferior */
            text-align: justify; /* Justifica os parágrafos */
        }
		        .header {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            text-align: right;
        }
        .header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        .footer {
            background-color: #4caf50;
            color: white;
            text-align: right; /* Alinha o conteúdo à direita */
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer a {
            color: white;
            text-decoration: none;
            margin-left: 10px; /* Espaço entre o nome e o link de logout */
        }
    </style>
</head>
<body>
    <div class="banner">
        <img src="images/banner.png" alt="Banner" />
    </div>

    <div class="menu">
        <a href="index.php">Home</a>
        <a href="cadastro.php">Cadastro de Produtos</a>
        <a href="consulta.php">Consulta de Produtos</a>
		<a href="alterar.php">Alterar/Excluir Produtos</a>
        <a href="contato.php">Contato</a>
    </div>


    <div class="content">
        <h1>Cooperativa Ouro do Vale</h1>
        <p>A Cooperativa Ouro do Vale, localizada em Pedro de Toledo, é uma iniciativa que se destaca na produção e comercialização de produtos agrícolas, especialmente café.</p>
        <p>Fundada por agricultores locais que buscavam alternativas para melhorar sua renda e fortalecer a comunidade, a cooperativa surgiu como uma resposta à necessidade de união e suporte mútuo entre os pequenos produtores.</p>
        <p>Ao longo dos anos, a Ouro do Vale implementou práticas sustentáveis e de valorização do trabalho dos cooperados, focando na qualidade dos produtos e na agregação de valor à produção. Isso inclui desde o cuidado no cultivo até a comercialização em feiras e eventos regionais. A cooperativa também tem se envolvido em projetos de capacitação e formação, ajudando seus membros a aprimorar técnicas agrícolas e de gestão.</p>
        <p>Através do trabalho em conjunto, a Ouro do Vale se tornou um exemplo de como a cooperação pode fortalecer economias locais, promovendo desenvolvimento social e econômico na região. A trajetória da cooperativa reflete o espírito comunitário e a determinação dos agricultores de Pedro de Toledo em buscar um futuro mais próspero para suas famílias e para a comunidade.</p>
    </div>
    <div class="footer">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <span>Logado como: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <span>Não logado.</span>
        <?php endif; ?>
    </div>
</body>
</html>