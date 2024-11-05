<?php
session_start(); // Inicia a sessão

// Destrói todas as variáveis de sessão
$_SESSION = array(); 

// Se você deseja destruir a sessão completamente, chame session_destroy()
session_destroy(); 

// Redireciona para a página de login
header("location: login.php");
exit;
?>
