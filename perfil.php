<?php
// perfil.php - Atividade 3: acessível apenas pelo admin

session_start();

// 1) precisa estar logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

// 2) precisa ser admin
$ehAdmin = ($_SESSION['usuario'] ?? '') === 'admin' && ($_SESSION['nivel'] ?? '') === 'admin';

if (!$ehAdmin) {
    http_response_code(403);
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Acesso negado</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <div class="container error">
            <h2>🚫 Acesso negado</h2>
            <p>Esta página é exclusiva para o administrador.</p>
            <a href="painel.php">Voltar ao painel</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$usuario   = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
$dataLogin = htmlspecialchars($_SESSION['data_login'] ?? '-', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Administrador</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container painel">
        <h2>👤 Perfil do Administrador</h2>
        <div class="info">
            <strong>Usuário:</strong> <?php echo $usuario; ?><br>
            <strong>Nível:</strong> <span class="badge admin">admin</span><br>
            <strong>Último login:</strong> <?php echo $dataLogin; ?><br>
            <strong>ID da sessão:</strong> <?php echo htmlspecialchars(session_id(), ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <a href="painel.php">Voltar ao painel</a>
    </div>
</body>
</html>
