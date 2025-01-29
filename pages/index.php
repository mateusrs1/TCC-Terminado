<?php
$marmitas = Marmitas::obterMarmitas();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['marmita_id'])) {
        foreach ($marmitas as $marmita) {
            if ($marmita['id'] == $_POST['marmita_id']) {
                $nomeMarmita = $marmita['nome'];
                break;
            }
        }
        Carrinho::adicionarAoCarrinho($_POST['marmita_id']);
        $mensagem = $nomeMarmita . ' adicionado com sucesso ao carrinho!';
    } elseif (isset($_POST['remove_marmita_id'])) {
        if ($_SESSION['cargo'] == 'ADMIN' || $_SESSION['cargo'] == 'COZINHEIRO') {
            foreach ($marmitas as $marmita) {
                if ($marmita['id'] == $_POST['remove_marmita_id']) {
                    $nomeMarmita = $marmita['nome'];
                    break;
                }
            }
            Marmitas::deletarMarmita($_POST['remove_marmita_id']);
            $mensagem = $nomeMarmita . ' excluída com sucesso!';
        } else {
            $mensagem = 'Você não tem permissão para excluir marmitas.';
        }
    }
}
?>

<div class="main-content">
    <div class="header">
        <h2 class="titulo">Bem-vindo ao Cardápio</h2>
        <?php if ($_SESSION['cargo'] == 'ADMIN' || $_SESSION['cargo'] == 'COZINHEIRO') { ?>
            <a href="adicionar-marmita">Adicionar Marmita</a>
        <?php } ?>
    </div>
    <div class="card-flex">
        <?php if ($marmitas) {
            foreach ($marmitas as $marmita) { ?>
                <div class="card">
                    <img class="imgcardapio" src="<?php echo INCLUDE_PATH . 'uploads/' . $marmita['imagem']; ?>" alt="<?php echo $marmita['nome']; ?>">
                    <div class="textcard">
                        <h1><?php echo $marmita['nome']; ?></h1>
                        <p id="desc"><?php echo $marmita['descricao']; ?></p>
                        <p style="margin-top: 12px; color: green; font-weight: bold;">R$ <?php echo number_format($marmita['preco'], 2, ',', '.'); ?></p>
                    </div>
                    <div class="button-flex">
                        <?php if ($_SESSION['cargo'] == 'COZINHEIRO') { ?>
                            <form method="post">
                                <input type="hidden" name="remove_marmita_id" value="<?php echo $marmita['id']; ?>">
                                <input style="background-color: #e6222f !important;" type="submit" class="buttoncard" value="EXCLUIR" name="EXCLUIR">
                            </form>
                        <?php } ?> 
                        <form method="post">
                            <input type="hidden" name="marmita_id" value="<?php echo $marmita['id']; ?>">
                            <input type="submit" class="buttoncard" value="PEDIR" name="PEDIR">
                        </form>
                    </div>
                </div>
            <?php }
        } else {
            echo '<p>Nenhuma marmita encontrada.</p>';
        } ?>
    </div>
</div>

<?php if ($mensagem != ''): ?>
    <script>
        window.location.href = "<?php echo INCLUDE_PATH; ?>";
        alert("<?php echo $mensagem; ?>");
        
    </script>
<?php endif; ?>

<script>
    $(document).ready(function(){
        $('form').on('submit', function(){
            $(this).find(':submit').prop('disabled', true);
        });
    });
</script>

