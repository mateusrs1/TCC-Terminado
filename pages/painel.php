<?php
if ($_SESSION['cargo'] !== 'ADMIN') {
    header('Location: ' . INCLUDE_PATH);
    exit();
}

$usuarios = Usuario::obterTodosUsuarios();
$mensagem = '';

// Processa a atualização do cargo e a exclusão de usuários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cargo'])) {
        $user_id = $_POST['user_id'];
        $novo_cargo = $_POST['cargo']; // Corrigido para usar o nome correto do campo

        // Verifica se o user_id e o novo_cargo são válidos
        if (!empty($user_id) && !empty($novo_cargo)) {
            if (Usuario::atualizarCargo($user_id, $novo_cargo)) {
                $mensagem = 'Cargo atualizado com sucesso!';
            } else {
                $mensagem = 'Erro ao atualizar o cargo!';
            }
        } else {
            $mensagem = 'id do usuário ou novo cargo não fornecido!';
        }
    } elseif (isset($_POST['excluir_usuario'])) {
        $user_id = $_POST['user_id'];

        if (!empty($user_id)) {
            if (Usuario::excluirUsuario($user_id)) {
                $mensagem = 'Usuário excluído com sucesso!';
            } else {
                $mensagem = 'Erro ao excluir o usuário!';
            }
        } else {
            $mensagem = 'id do usuário não fornecido!';
        }
    }
}
?>

<div class="container-table">
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['cargo']); ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                            <select name="cargo"> <!-- Corrigido para usar o nome correto do campo -->
                                <option value="ADMIN" <?php if ($usuario['cargo'] === 'ADMIN') echo 'selected'; ?>>ADMIN</option>
                                <option value="USER" <?php if ($usuario['cargo'] === 'USER') echo 'selected'; ?>>USER</option>
                            </select>
                            <button type="submit" name="update_cargo">Atualizar Cargo</button>
                        </form>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($usuario['id']); ?>">
                            <button type="submit" name="excluir_usuario" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($mensagem != ''): ?>
    <script>
        alert("<?php echo $mensagem; ?>");
        window.location.href = "<?php echo INCLUDE_PATH.'/painel'; ?>";
    </script>
<?php endif; ?>

<script>
    $(document).ready(function(){
        $('form').on('submit', function(){
            $(this).find(':submit').prop('disabled', true);
        });
    });
</script>
