<?php
$carrinho = Carrinho::obterCarrinho();
$totalCarrinho = 0; // Variável para armazenar o total

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['produto_id'])) {
        Carrinho::adicionarAoCarrinho($_POST['produto_id']);
        header('Location: carrinho');
        exit();
    } elseif (isset($_POST['remover_produto_id'])) {
        Carrinho::removerDoCarrinho($_POST['remover_produto_id']);
        header('Location: carrinho');
        exit();
    } elseif (isset($_POST['finalizar_compra'])) {
        if (Pedido::fazerPedido()) {
            header('Location: pedidos');
            exit();
        } else {
            $erro = "Ocorreu um erro ao tentar finalizar a compra. Tente novamente.";
        }
    }
}
?>

<div class="carrinho-container">
    <div class="carrinho-header">
        <i class="fa-solid fa-cart-shopping"></i> Seu Carrinho
    </div>
    <?php if (count($carrinho) > 0): ?>
        <div class="carrinho-list">
            <ul>
                <?php foreach ($carrinho as $item): ?>
                    <li>
                        <span class="carrinho-item-name"><?php echo $item['nome']; ?></span>
                        <span class="carrinho-item-price">R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></span>
                        <span class="carrinho-item-quantity">Quantidade: <?php echo $item['quantidade']; ?></span>
                        <div class="form-btn">
                            <form method="post" action="carrinho">
                                <input type="hidden" name="remover_produto_id" value="<?php echo $item['produto_id']; ?>">
                                <input type="submit" class="button-carrinho button-remove" value="Remover">
                            </form>
                            <form method="post" action="carrinho">
                                <input type="hidden" name="produto_id" value="<?php echo $item['produto_id']; ?>">
                                <input type="submit" class="button-carrinho button-add" value="Adicionar">
                            </form>
                        </div>
                    </li>
                    <?php 
                        // Acumula o valor total (preço * quantidade)
                        $totalCarrinho += $item['preco'] * $item['quantidade'];
                    ?>
                <?php endforeach; ?>
                <li>
                    <span class="carrinho-item-name">Total: </span>
                    <span class="carrinho-item-price">R$ <?php echo number_format($totalCarrinho, 2, ',', '.'); ?></span>
                </li>
                <li>
                    <?php 
                        $xpGanho = $totalCarrinho * 0.30;
                    ?>
                    <span class="carrinho-item-name">XP Ganhado: </span>
                    <span class="carrinho-item-price"><?php echo number_format($xpGanho, 2, ',', '.'); ?> XP</span>
                </li>
            </ul>
        </div>
        <div class="finalizar-compra">
            <form method="post" action="carrinho">
                <input type="hidden" name="finalizar_compra" value="1">
                <input type="submit" value="Finalizar Compra">
            </form>
        </div>
        <?php if (isset($erro)): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>
