<?php
session_start();

// Conectar ao banco de dados
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mysql";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Simulação de autenticação
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar e executar a consulta
    $stmt = $conn->prepare("SELECT password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Usuário encontrado
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verificar a senha
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username; // Armazena o nome de usuário na sessão
			header("location: index.php");
			;
            exit;
        } else {
            $error = "Usuário ou senha incorretos!";
        }
    } else {
        $error = "Usuário ou senha incorretos!";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa Ouro do Vale - Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #e0f7e9;
        }

        .banner {
            color: white;
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            top: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 10px; /* Espaço para o banner fixo */
        }

        .login-form {
            background: white;
            padding: 40px; /* Reduzido para mais espaço */
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px; /* Largura fixa */
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px; /* Tamanho da fonte ajustado */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 8px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
            box-sizing: border-box; /* Para incluir padding e borda no tamanho total */
        }

        input:focus {
            border-color: #4caf50;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .register-link {
            margin-top: 15px;
        }

        .register-link a {
            color: #4caf50;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header class="banner">
        <img src="images/banner.png" alt="Banner" />
    </header>
    <div class="login-container">
        <form class="login-form" method="post" action="login.php">
            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <div class="register-link">
                <p>Não tem uma conta? <a href="registrar.php">Registre-se aqui</a></p>
            </div>
        </form>
    </div>
</body>
</html>
