<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa Ouro do Vale</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header>
        <div class="banner">
            <img src="images/banner.png" alt="Banner" class="banner-img">
        </div>
        <nav>
            <ul class="menu" id="menu">
                <li><a href="#" onclick="loadPage('home.php')" class="active">História</a></li>
                <li><a href="#" onclick="loadPage('cadastrar.php')">Cadastrar</a></li>
                <li><a href="#" onclick="loadPage('cadastrar.php')">Consultar</a></li>
                <li><a href="#" onclick="loadPage('cadastrar.php')">Contato</a></li>
            </ul>
        </nav>
    </header>
    <div class = "content">
    <h1>Consulta de Produtos</h1>
</div>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto">
        </div>
        <p>
		</p>
        <div class="form-group">
            <label for="data_validade_min">Data de Validade Mínima:</label>
            <input type="date" id="data_validade_min" name="data_validade_min">
        </div>

        <div class="form-group">
            <label for="data_validade_max">Data de Validade Máxima:</label>
            <input type="date" id="data_validade_max" name="data_validade_max">
        </div>
		<p>
        <input type="submit" value="Consultar">
		</p>
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
</body>
</html>