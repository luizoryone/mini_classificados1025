<?php
// 1. INCLUA A CONEXÃO DIRETAMENTE NO TOPO.
include_once(__DIR__ . '/../config/conexao.php');

// 2. LÓGICA DE LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        if (password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido!
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            
            // --- PONTO CRÍTICO DA CORREÇÃO ---
            // Garante que o caminho para a pasta de anúncios está correto
            // e que o script para de ser executado imediatamente após o redirecionamento.
            header("Location: ../anuncios/meus_anuncios.php");
            exit(); // ESSA LINHA É FUNDAMENTAL!
        }
    }
    
    // Se o código chegou aqui, o login falhou.
    $login_error = "Email ou senha inválidos.";
}

// 3. INCLUA O HEADER APENAS PARA A PARTE VISUAL (HTML).
// Se o usuário já estiver logado e acessar /login.php diretamente, redireciona ele.
if (isset($_SESSION['usuario_id'])) {
    header("Location: ../anuncios/meus_anuncios.php");
    exit();
}

include_once(__DIR__ . '/../header.php');

// O resto do arquivo continua igual...
if (isset($login_error)) {
    echo "<p class='error'>$login_error</p>";
}

if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'cadastro') {
    echo "<p class='success'>Cadastro realizado com sucesso! Faça o login para continuar.</p>";
}
if (isset($_GET['erro']) && $_GET['erro'] == 'acesso_negado') {
    echo "<p class='error'>Você precisa fazer login para acessar essa página.</p>";
}
?>

<div class="form-wrapper">
    <h2>Acessar sua Conta</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
</div>

<?php 
include_once(__DIR__ . '/../footer.php'); 
?>
