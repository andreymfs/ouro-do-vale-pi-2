<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php"); // Redireciona para a página de login
    exit;
}

?>

<!DOCTYPE html> 
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa Ouro do Vale - Gerenciar Produtos</title>
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

        .menu a.active {
            background-color: #45a049; /* Verde mais escuro para o item ativo */
            color: white; /* Manter o texto branco no ativo */
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
        input[type="number"],
        input[type="date"] {
            padding: 15px;
            width: 80%; /* Largura total do campo */
            margin: 10px 0;
            border: 1px solid #ccc; /* Borda padrão */
            border-radius: 5px; /* Bordas arredondadas */
        }

        .button-group {
            display: flex;
            justify-content: space-between; /* Espaçamento entre os botões */
            margin-top: 10px; /* Espaçamento acima do grupo de botões */
        }

        input[type="submit"] {
            background-color: #ff8c00; /* Cor de fundo do botão */
            color: white; /* Cor do texto do botão */
            cursor: pointer; /* Cursor em forma de mão */
            transition: background-color 0.3s, transform 0.3s; /* Transições suaves */
            flex: 1; /* Faz com que os botões tenham a mesma largura */
            margin: 0 5px; /* Espaçamento lateral entre os botões */
            padding: 15px; /* Mesmo padding para todos os botões */
            border: none; /* Remove a borda padrão */
            border-radius: 5px; /* Bordas arredondadas */
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

        /* Estilo de mensagens de sucesso */
        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .error {
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

    <div class="content">
        <h1>Gerenciar Produtos</h1>

        <!-- Formulário para alterar produtos -->
        <form action="" method="POST" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="id_produto">ID do Produto:</label><p>
                <input type="number" id="id_produto" name="id_produto" required>
            </div>
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
            
            <div class="button-group">
                <input type="submit" name="atualizar" value="Atualizar">
                <input type="submit" name="remover" value="Remover">
            </div>
        </form>

        <?php
        // Conexão e manipulação de dados conforme seu código
        $host = 'localhost';
        $dbname = 'ouro_vale';
        $user = 'root';
        $password = '';
        $mensagem = '';

        try {
            // Conexão ao banco de dados
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Atualizar produto
            if (isset($_POST['atualizar'])) {
                $id_produto = $_POST['id_produto'];
                $nome_produto = $_POST['nome_produto'];
                $quantidade = $_POST['quantidade'];
                $prazo_validade = $_POST['prazo_validade'];

                // Validação do lado do servidor
                if (empty($nome_produto) || empty($quantidade) || empty($prazo_validade)) {
                    $mensagem = '<div class="erro">Todos os campos são obrigatórios!</div>';
                } else {
                    $stmt = $conn->prepare("UPDATE produtos SET nome_produto = :nome_produto, quantidade = :quantidade, prazo_validade = :prazo_validade WHERE id = :id");
                    $stmt->bindParam(':nome_produto', $nome_produto);
                    $stmt->bindParam(':quantidade', $quantidade);
                    $stmt->bindParam(':prazo_validade', $prazo_validade);
                    $stmt->bindParam(':id', $id_produto);
                    $stmt->execute();

                    $mensagem = '<div class="success">Produto atualizado com sucesso!</div>';
                }
            }

            // Remover produto
            if (isset($_POST['remover'])) {
                $id_produto = $_POST['id_produto'];

                $stmt = $conn->prepare("DELETE FROM produtos WHERE id = :id");
                $stmt->bindParam(':id', $id_produto);
                $stmt->execute();

                $mensagem = '<div class="success">Produto removido com sucesso!</div>';
            }

            // Listar produtos
            $stmt = $conn->query("SELECT * FROM produtos");
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $mensagem = '<div class="error">Erro: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }

        // Fechar a conexão
        $conn = null;
        ?>

        <!-- Mensagem exibida abaixo do formulário -->
        <?php echo $mensagem; ?>

        <!-- Tabela de produtos -->
        <table>
            <tr>
                <th>ID</th>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Prazo de Validade</th>
            </tr>
            <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?php echo htmlspecialchars($produto['id']); ?></td>
                <td><?php echo htmlspecialchars($produto['nome_produto']); ?></td>
                <td><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                <td><?php echo htmlspecialchars($produto['prazo_validade']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>