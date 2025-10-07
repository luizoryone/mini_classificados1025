<?php
include_once(__DIR__ . '/../config/proteger.php'); // Protege a página
include_once(__DIR__ . '/../header.php');

// --- LÓGICA DE EDIÇÃO: PREENCHER O FORMULÁRIO ---
$modo_edicao = false;
$id = '';
$titulo = '';
$descricao = '';
$preco = '';
$categoria_id_selecionada = '';

// Verifica se um ID foi passado pela URL (modo de edição)
if (isset($_GET['id'])) {
    $modo_edicao = true;
    $id = intval($_GET['id']);
    $usuario_id_logado = $_SESSION['usuario_id'];

    // Busca os dados do anúncio no banco, garantindo que ele pertence ao usuário logado
    $stmt = $conexao->prepare("SELECT * FROM anuncios WHERE id = ? AND usuario_id = ?");
    $stmt->bind_param("ii", $id, $usuario_id_logado);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $anuncio = $resultado->fetch_assoc();
        $titulo = $anuncio['titulo'];
        $descricao = $anuncio['descricao'];
        $preco = $anuncio['preco'];
        $categoria_id_selecionada = $anuncio['categoria_id'];
    } else {
        // Se o anúncio não for encontrado ou não pertencer ao usuário, exibe um erro.
        echo "<p class='error'>Anúncio não encontrado ou você não tem permissão para editá-lo.</p>";
        include_once(__DIR__ . '/../footer.php');
        exit();
    }
    $stmt->close();
}
?>

<div class="form-wrapper">
    <h2><?php echo $modo_edicao ? 'Editar Anúncio' : 'Criar Novo Anúncio'; ?></h2>
    
    <form action="salvar_anuncio.php" method="POST">
        <!-- Campo oculto para enviar o ID do anúncio (importante para a edição) -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label for="titulo">Título do Anúncio:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" required>
                <option value="">-- Selecione uma categoria --</option>
                <?php
                // Busca todas as categorias do banco para preencher o <select>
                $sql_categorias = "SELECT id, nome FROM categorias ORDER BY nome ASC";
                $resultado_categorias = $conexao->query($sql_categorias);
                while ($categoria = $resultado_categorias->fetch_assoc()) {
                    // Verifica se esta é a categoria selecionada (no modo de edição)
                    $selected = ($categoria['id'] == $categoria_id_selecionada) ? 'selected' : '';
                    echo "<option value='" . $categoria['id'] . "' $selected>" . htmlspecialchars($categoria['nome']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="preco">Preço (R$):</label>
            <input type="number" name="preco" step="0.01" min="0" value="<?php echo htmlspecialchars($preco); ?>" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao"><?php echo htmlspecialchars($descricao); ?></textarea>
        </div>

        <button type="submit">Salvar Anúncio</button>
    </form>
</div>

<?php include_once(__DIR__ . '/../footer.php'); ?>
