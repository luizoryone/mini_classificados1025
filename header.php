<?php include_once(__DIR__ . '/config/conexao.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Classificados</title>
    <link rel="stylesheet" href="/mini_classificados/assets/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="/mini_classificados/index.php" class="logo">Classificados SENAI</a>
            <ul class="nav-links">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- Links para usuário logado -->
                    <li><a href="/mini_classificados/anuncios/meus_anuncios.php">Meus Anúncios</a></li>
                    <li><a href="/mini_classificados/anuncios/novo_anuncio.php" class="btn-anunciar">Criar Anúncio</a></li>
                    <li><a href="/mini_classificados/auth/logout.php">Sair</a></li>
                <?php else: ?>
                    <!-- Links para visitante -->
                    <li><a href="/mini_classificados/auth/login.php">Login</a></li>
                    <li><a href="/mini_classificados/auth/cadastro.php">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main class="container">
