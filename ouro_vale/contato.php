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
		
.menu li {
    margin: 0 15px;
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
    border-radius: 20px; /* Manter bordas arredondadas */
        }
.menu a.active {
    background-color: #45a049; /* Verde mais escuro para o item ativo */
    color: white; /* Manter o texto branco no ativo */
    border-radius: 20px; /* Manter bordas arredondadas */
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

 h2 {
    font-weight: 500; /* Peso da fonte para subtítulos */
    color: #444; /* Cor dos subtítulos */
    margin-top: 20px; /* Espaçamento superior */
    text-align: center; /* Centraliza o título */
}

p {
    margin-bottom: 15px; /* Espaçamento inferior */
    text-align: center; /* Centraliza o texto */
}


        /* Estilo do formulário */
        form {
            display: flex;
            flex-direction: column; /* Coloca os elementos em coluna */
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc; /* Borda padrão */
            border-radius: 5px; /* Bordas arredondadas */
        }

        input[type="submit"] {
            background-color: #ff8c00; /* Cor de fundo do botão */
            color: white; /* Cor do texto do botão */
            cursor: pointer; /* Cursor em forma de mão */
            transition: background-color 0.3s, transform 0.3s; /* Transições suaves */
        }

        input[type="submit"]:hover {
            background-color: #e07b00; /* Cor ao passar o mouse */
            transform: translateY(-2px); /* Levanta o botão */
        }

        /* Estilo de mensagens de erro */
        .erro {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
		.contato-icons {
    display: flex;
    justify-content: center; /* Centraliza os itens horizontalmente */
    gap: 20px; /* Espaçamento entre os itens */
}

.contato-item {
    display: flex;
    align-items: center; /* Alinha ícone e texto verticalmente */
    text-align: center; /* Centraliza o texto */
}

.contato-link {
    display: flex; /* Permite que o ícone e o texto fiquem lado a lado */
    flex-direction: column; /* Coloca o texto embaixo do ícone */
    align-items: center; /* Centraliza o texto abaixo do ícone */
    text-decoration: none; /* Remove o sublinhado do link */
    color: black; /* Define a cor do texto */
}

.icon {
    width: 40px; /* Largura do ícone */
    height: 40px; /* Altura do ícone */
    margin-bottom: 5px; /* Espaço entre o ícone e o texto */
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
    <div class = "content">
        <h1>Contato</h1>
        <p>Entre em contato conosco através das redes sociais ou envie um email!</p>
        <div class="contato-icons">
            <div class="contato-item">
                <a href="mailto:ourodovale.coopt@hotmail.com" class="contato-link">
                    <img src="images/email.png" alt="Email" class="icon">
                    <span>Email</span>
                </a>
            </div>
            <div class="contato-item">
                <a href="https://wa.me/+5513996803449" target="_blank" class="contato-link">
                    <img src="images/whatsapp.png" alt="WhatsApp" class="icon">
                    <span>WhatsApp</span>
                </a>
            </div>
            <div class="contato-item">
                <a href="https://www.instagram.com/cooperativa_ourodovale" target="_blank" class="contato-link">
                    <img src="images/instagram.png" alt="Instagram" class="icon">
                    <span>Instagram</span>
                </a>
            </div>
            <div class="contato-item">
                <a href="https://www.facebook.com/profile.php?id=100090845130316&ref=xav_ig_profile_web" target="_blank" class="contato-link">
                    <img src="images/facebook.png" alt="Facebook" class="icon">
                    <span>Facebook</span>
                </a>
            </div>
        </div>
    </section>
</main>