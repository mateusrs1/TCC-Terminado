<?php
$filtros = [
    'nome' => $_GET['nome'] ?? null,
    'preco_min' => $_GET['preco_min'] ?? null,
    'preco_max' => $_GET['preco_max'] ?? null,
];

$produtos = Produtos::obterProdutos($filtros);
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o ID do produto foi passado corretamente
    var_dump($_POST); // Verifica o conteúdo do POST para depuração

    if (isset($_POST['produto_id'])) {
        // Adicionar ao carrinho
        foreach ($produtos as $produto) {
            if ($produto['id'] == $_POST['produto_id']) {
                $nomeproduto = $produto['nome'];
                break;
            }
        }
        Carrinho::adicionarAoCarrinho($_POST['produto_id']);
        $mensagem = $nomeproduto . ' adicionado com sucesso ao carrinho!';
    } elseif (isset($_POST['remove_produto_id'])) {
        // Excluir produto
        if ($_SESSION['cargo'] == 'ADMIN' || $_SESSION['cargo'] == 'COZINHEIRO') {
            foreach ($produtos as $produto) {
                if ($produto['id'] == $_POST['remove_produto_id']) {
                    $nomeproduto = $produto['nome'];
                    break;
                }
            }
            $resultado = Produtos::deletarProduto($_POST['remove_produto_id']);
            if ($resultado) {
                $mensagem = $nomeproduto . ' excluído com sucesso!';
            } else {
                $mensagem = 'Erro ao excluir o produto.';
            }
        } else {
            $mensagem = 'Você não tem permissão para excluir produtos.';
        }
    }
}
?>

<div class="main-content">
    <div class="header">
        <h2 class="titulo">Bem-vindo ao Cardápio</h2>
        <?php if ($_SESSION['cargo'] == 'ADMIN' || $_SESSION['cargo'] == 'COZINHEIRO') { ?>
            <a href="adicionar-produto">Adicionar Produto</a>
        <?php } ?>
    </div>
    <form method="get" class="filtro-produtos">
        <input type="text" name="nome" placeholder="Nome do produto"
            value="<?php echo isset($_GET['nome']) ? $_GET['nome'] : ''; ?>">
        <input type="number" step="0.01" name="preco_min" placeholder="Preço mínimo"
            value="<?php echo isset($_GET['preco_min']) ? $_GET['preco_min'] : ''; ?>">
        <input type="number" step="0.01" name="preco_max" placeholder="Preço máximo"
            value="<?php echo isset($_GET['preco_max']) ? $_GET['preco_max'] : ''; ?>">
        <button type="submit">Filtrar</button>
    </form>

    <div class="card-flex">
        <?php if ($produtos) {
            foreach ($produtos as $produto) { ?>
                <div class="card">
                    <img class="imgcardapio" src="<?php echo INCLUDE_PATH . 'uploads/' . $produto['imagem']; ?>"
                        alt="<?php echo $produto['nome']; ?>">
                    <div class="textcard">
                        <h1><?php echo $produto['nome']; ?></h1>
                        <p id="desc"><?php echo $produto['descricao']; ?></p>
                        <p style="margin-top: 12px; color: green; font-weight: bold;">R$
                            <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                        </p>
                    </div>
                    <div class="button-flex">
                        <?php if ($_SESSION['cargo'] == 'ADMIN' || $_SESSION['cargo'] == 'COZINHEIRO') { ?>
                            <form method="post">
                                <input type="hidden" name="remove_produto_id" value="<?php echo $produto['id']; ?>">
                                <input style="background-color: #e6222f !important;" type="submit" class="buttoncard"
                                    value="EXCLUIR" name="EXCLUIR">
                            </form>
                        <?php } ?>
                        <form method="post">
                            <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                            <input type="submit" class="buttoncard" value="PEDIR" name="PEDIR">
                        </form>
                    </div>
                </div>
            <?php }
        } else {
            echo '<p>Nenhum produto encontrado.</p>';
        } ?>
    </div>
</div>

<?php if ($mensagem != ''): ?>
    <script>
        alert("<?php echo $mensagem; ?>");
        window.location.href = "<?php echo INCLUDE_PATH; ?>";
    </script>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $('form').on('submit', function () {
            $(this).find(':submit').prop('disabled', true);
        });
    });
</script>