<?php
include_once(__DIR__ . '/../config/proteger.php'); // Protege a página
include_once(__DIR__ . '/../config/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $id = intval($_POST['id']);
    $usuario_id = $_SESSION['usuario_id'];
    $titulo = $_POST['titulo'];
    $categoria_id = intval($_POST['categoria_id']);
    $preco = floatval($_POST['preco']);
    $descricao = $_POST['descricao'];

    // Se id_anuncio for maior que 0, significa que estamos editando
    if ($id > 0) {
        // --- LÓGICA DE ATUALIZAÇÃO (UPDATE) ---
        $sql = "UPDATE anuncios SET titulo = ?, categoria_id = ?, preco = ?, descricao = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $conexao->prepare($sql);
        // Note a ordem dos parâmetros e os tipos (s, i, d, s, i, i)
        $stmt->bind_param("sidssi", $titulo, $categoria_id, $preco, $descricao, $id_anuncio, $usuario_id);
    } else {
        // --- LÓGICA DE CRIAÇÃO (INSERT) ---
        $sql = "INSERT INTO anuncios (usuario_id, categoria_id, titulo, preco, descricao) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        // Note a ordem dos parâmetros e os tipos (i, i, s, d, s)
        $stmt->bind_param("iisds", $usuario_id, $categoria_id, $titulo, $preco, $descricao);
    }

    // Executa a query preparada
    if ($stmt->execute()) {
        // Redireciona para a página de "Meus Anúncios" em caso de sucesso
        header("Location: meus_anuncios.php?sucesso=salvo");
    } else {
        // Em caso de erro, exibe a mensagem
        echo "Erro ao salvar o anúncio: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
    exit();
} else {
    // Se alguém tentar acessar este arquivo diretamente, redireciona
    header("Location: meus_anuncios.php");
    exit();
}
?>
