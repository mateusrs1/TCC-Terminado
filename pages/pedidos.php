<?php

if ($_SESSION['cargo'] === 'ADMIN' || $_SESSION['cargo'] === 'COZINHEIRO') {
    // Lógica para atualizar o status do pedido
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pedido_id']) && isset($_POST['novo_status'])) {
        $pedido_id = $_POST['pedido_id'];
        $novo_status = $_POST['novo_status'];

        Pedido::atualizarStatusPedido($pedido_id, $novo_status);
        header('Location: pedidos'); // Redireciona para a página de pedidos após atualizar o status
        exit();
    }

    // Lógica para excluir um pedido
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir_pedido_id'])) {
        $excluir_pedido_id = $_POST['excluir_pedido_id'];

        Pedido::excluirPedido($excluir_pedido_id);
        header('Location: pedidos'); // Redireciona para a página de pedidos após excluir o pedido
        exit();
    }
    $statusFiltro = isset($_GET['status']) && $_GET['status'] !== '' ? $_GET['status'] : null;
    $pedidos = Pedido::obterTodosPedidos($statusFiltro);
    ?>
    <div class="pedidos-container">
        <h2 style="text-align: center"><i class="fa-regular fa-calendar"></i> Pedidos a fazer</h2>


        <?php if (count($pedidos) > 0): ?>
            <form method="get" class="filter-form">
                <label for="status">Filtrar por status:</label>
                <select name="status" id="status">
                    <option value="">Todos</option>
                    <option value="PENDENTE" <?php echo isset($_GET['status']) && $_GET['status'] == 'PENDENTE' ? 'selected' : ''; ?>>Pendente</option>
                    <option value="EM PREPARO" <?php echo isset($_GET['status']) && $_GET['status'] == 'EM PREPARO' ? 'selected' : ''; ?>>Em Preparo</option>
                    <option value="ENTREGUE" <?php echo isset($_GET['status']) && $_GET['status'] == 'ENTREGUE' ? 'selected' : ''; ?>>Entregue</option>
                </select>
                <button type="submit">Filtrar</button>
            </form>
            <table class="pedidos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Status</th>
                        <th>Itens</th>
                        <th>Data de Criação</th>
                        <th>Atualizar Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?php echo $pedido['id']; ?></td>
                            <td><?php echo $pedido['usuario_nome']; ?></td>
                            <td><?php echo $pedido['status']; ?></td>
                            <td>
                                <ul>
                                    <?php
                                    // Obtém os itens dos pedidos
                                    $itens = Pedido::obterItensPedidos();
                                    foreach ($itens as $item): ?>
                                        <?php if ($item['pedido_id'] == $pedido['id']): ?>
                                            <li><?php echo htmlspecialchars($item['nome']); ?> - Quantidade:
                                                <?php echo htmlspecialchars($item['quantidade']); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_criacao'])); ?></td>
                            <!-- Exibe a data de criação -->
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">
                                    <select name="novo_status">
                                        <option value="PENDENTE" <?php echo $pedido['status'] == 'PENDENTE' ? 'selected' : ''; ?>>
                                            Pendente</option>
                                        <option value="EM PREPARO" <?php echo $pedido['status'] == 'EM PREPARO' ? 'selected' : ''; ?>>
                                            Em Preparo</option>
                                        <option value="ENTREGUE" <?php echo $pedido['status'] == 'ENTREGUE' ? 'selected' : ''; ?>>
                                            Entregue</option>
                                    </select>
                                    <input type="submit" value="Atualizar Status">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum pedido encontrado.</p>
        <?php endif; ?>
    </div>
    <?php
} else {
    $meusPedidos = Pedido::obterPedidosUsuario();
    ?>
    <div class="pedidos-container">
        <h2><i class="fa-regular fa-calendar"></i> Meus Pedidos</h2>
        <?php if (count($meusPedidos) > 0): ?>
            <table class="pedidos-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Itens</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($meusPedidos as $pedido): ?>
                        <tr>
                            <td><?php echo $pedido['id']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pedido['data_criacao'])); ?></td>
                            <!-- Exibe a data de criação para usuário comum -->
                            <td><?php echo $pedido['status']; ?></td>
                            <td>
                                <ul>
                                    <?php
                                    // Obtém os itens dos pedidos
                                    $itens = Pedido::obterItensPedidos();
                                    foreach ($itens as $item): ?>
                                        <?php if ($item['pedido_id'] == $pedido['id']): ?>
                                            <li><?php echo htmlspecialchars($item['nome']); ?> - Quantidade:
                                                <?php echo htmlspecialchars($item['quantidade']); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php endif; ?>
    </div>
    <?php
}
?>