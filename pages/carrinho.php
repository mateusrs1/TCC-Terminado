<?php
$carrinho = Carrinho::obterCarrinho();
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
                                <input type="hidden" name="remover_marmita_id" value="<?php echo $item['marmita_id']; ?>">
                                <input type="submit" class="button-carrinho button-remove"  value="Remover">
                            </form>
                            <form method="post" action="carrinho">
                                <input type="hidden" cla name="marmita_id" value="<?php echo $item['marmita_id']; ?>">
                                <input type="submit" class="button-carrinho button-add" value="Adicionar">
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="finalizar-compra">
            <a href="checkout">Finalizar Compra</a>
        </div>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</div>