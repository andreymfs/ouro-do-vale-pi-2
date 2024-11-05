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
    <title>Cooperativo Ouro do Vale</title>
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
    
    <div class="content">
        <h1>Consulta de Produtos</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome_produto">Nome do Produto:</label><p>
                <input type="text" id="nome_produto" name="nome_produto">
            </div>
            <div class="form-group">
                <label for="data_validade_min">Data de Validade Mínima:</label><p>
                <input type="date" id="data_validade_min" name="data_validade_min">
            </div>
            <div class="form-group">
                <label for="data_validade_max">Data de Validade Máxima:</label><p>
                <input type="date" id="data_validade_max" name="data_validade_max">
            </div>
            <input type="submit" value="Consultar">
        </form>

        <?php
        // Configurações do banco de dados
        $host = 'localhost';
        $dbname = 'ouro_vale';
        $user = 'root';
        $password = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Conexão ao banco de dados
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Obtendo os parâmetros de pesquisa
                $nome_produto = isset($_POST['nome_produto']) ? $_POST['nome_produto'] : '';
                $data_validade_min = isset($_POST['data_validade_min']) ? $_POST['data_validade_min'] : '';
                $data_validade_max = isset($_POST['data_validade_max']) ? $_POST['data_validade_max'] : '';

                // Construindo a consulta
                $query = "SELECT * FROM produtos WHERE 1=1";
                
                if (!empty($nome_produto)) {
                    $query .= " AND nome_produto LIKE :nome_produto";
                }
                if (!empty($data_validade_min)) {
                    $query .= " AND prazo_validade >= :data_validade_min";
                }
                if (!empty($data_validade_max)) {
                    $query .= " AND prazo_validade <= :data_validade_max";
                }

                $stmt = $conn->prepare($query);

                // Bind dos parâmetros se existirem
                if (!empty($nome_produto)) {
                    $stmt->bindValue(':nome_produto', '%' . $nome_produto . '%');
                }
                if (!empty($data_validade_min)) {
                    $stmt->bindValue(':data_validade_min', $data_validade_min);
                }
                if (!empty($data_validade_max)) {
                    $stmt->bindValue(':data_validade_max', $data_validade_max);
                }

                // Executar a consulta
                $stmt->execute();

                // Verifica se há registros
                if ($stmt->rowCount() > 0) {
                    echo '<table>';
                    echo '<tr><th>ID</th><th>Nome do Produto</th><th>Quantidade</th><th>Prazo de Validade</th></tr>';
                    
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nome_produto']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['quantidade']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['prazo_validade']) . '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</table>';
                } else {
                    echo '<p>Nenhum produto encontrado.</p>';
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }

            // Fechar a conexão
            $conn = null;
        }
        ?>
    </div>
</body>
</html>
