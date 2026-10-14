<?php
// painel.php - Página protegida com mensagens por nível e data do login

session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

$usuario   = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
$nivel     = $_SESSION['nivel'] ?? 'comum';
$dataLogin = htmlspecialchars($_SESSION['data_login'] ?? '-', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container painel">
        <h2>✅ Bem-vindo, <?php echo $usuario; ?>!</h2>

        <?php if ($nivel === 'admin'): ?>
            <p>Você tem acesso de <span class="badge admin">ADMINISTRADOR</span>.<br>
               Pode acessar todas as áreas do sistema.</p>
        <?php else: ?>
            <p>Você tem acesso <span class="badge comum">COMUM</span>.<br>
               Algumas áreas são restritas a administradores.</p>
        <?php endif; ?>

        <div class="info">
            <strong>Usuário:</strong> <?php echo $usuario; ?><br>
            <strong>Nível:</strong> <?php echo htmlspecialchars($nivel, ENT_QUOTES, 'UTF-8'); ?><br>
            <strong>Login realizado em:</strong> <?php echo $dataLogin; ?>
        </div>

        <div class="links">
            <a href="perfil.php">Meu perfil (admin)</a>
        </div>

        <div class="logout">
            <a href="logout.php">Sair do sistema</a>
        </div>
    </div>
</body>
</html>
