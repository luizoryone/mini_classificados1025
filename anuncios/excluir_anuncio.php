<?php
include_once(__DIR__ . '/../config/proteger.php'); // Protege a página
include_once(__DIR__ . '/../config/conexao.php');

// Verifica se um ID foi passado via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $usuario_id = $_SESSION['usuario_id'];

    // Prepara a query de exclusão
    // A query só funcionará se o ID do anúncio E o ID do usuário logado corresponderem
    $stmt = $conexao->prepare("DELETE FROM anuncios WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $id, $usuario_id);

    // Executa a query
    if ($stmt->execute()) {
        // Verifica se alguma linha foi realmente afetada.
        // Se $stmt->affected_rows for 0, significa que o anúncio não pertencia ao usuário.
        if ($stmt->affected_rows > 0) {
            header("Location: meus_anuncios.php?sucesso=excluido");
        } else {
            header("Location: meus_anuncios.php?erro=permissao");
        }
    } else {
        echo "Erro ao excluir o anúncio: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
    exit();
} else {
    header("Location: meus_anuncios.php");
    exit();
}
?>
