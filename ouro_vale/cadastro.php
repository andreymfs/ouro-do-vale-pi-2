<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php"); // Redireciona para a página de login
    exit;
}

// O restante do código da página vai aqui...
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
		        /* Estilo do formulário */
        form {
            display: flex;
            flex-direction: column; /* Coloca os elementos em coluna */
        }

        input[type="text"],
        input[type="password"],
		input[type="number"],
		input[type="date"],
        input[type="submit"] {
          padding: 15px;
			width: 80%; /* Largura total do campo */
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

        table {
            width: 100%; /* Largura total */
            border-collapse: collapse; /* Colapsa as bordas */
            margin-top: 20px; /* Espaço acima da tabela */
        }

        th, td {
            border: 1px solid #ccc; /* Borda da célula */
            padding: 10px; /* Espaçamento interno */
            text-align: center; /* Centraliza o texto */
        }

        th {
            background-color: #0a700d; /* Cor de fundo do cabeçalho */
            color: white; /* Cor do texto do cabeçalho */
        }

        /* Estilo de mensagens de erro */
        .erro {
            color: red;
            text-align: center;
            margin-bottom: 10px;
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
   <h1>Cadastro de Produtos</h1>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nome_produto">Nome do Produto:</label><p>
            <input type="text" id="nome_produto" name="nome_produto" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade:</label><p>
            <input type="number" id="quantidade" name="quantidade" required>
        </div>
        <div class="form-group">
            <label for="prazo_validade">Prazo de Validade:</label><p>
            <input type="date" id="prazo_validade" name="prazo_validade" required>
        </div>
        <input type="submit" value="Cadastrar">
    </form>

    <?php
$host = 'localhost';
$dbname = 'ouro_vale';
$user = 'root';
$password = '';

    $mensagem = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            // Conexão ao banco de dados
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obtendo dados do formulário
            $nome_produto = $_POST['nome_produto'];
            $quantidade = $_POST['quantidade'];
            $prazo_validade = $_POST['prazo_validade'];

            // Inserindo dados no banco de dados
            $stmt = $conn->prepare("INSERT INTO produtos (nome_produto, quantidade, prazo_validade) VALUES (:nome_produto, :quantidade, :prazo_validade)");
            $stmt->bindParam(':nome_produto', $nome_produto);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':prazo_validade', $prazo_validade);
            $stmt->execute();

            // Mensagem de sucesso
            $mensagem = '<div class="success">Produto cadastrado com sucesso!</div>';
        } catch (PDOException $e) {
            // Mensagem de erro
            $mensagem = '<div class="error">Erro: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }

        // Fechar a conexão
        $conn = null;
    }
    ?>

    <!-- Mensagem exibida abaixo do formulário -->
    <?php echo $mensagem; ?>
</body>
</html>
