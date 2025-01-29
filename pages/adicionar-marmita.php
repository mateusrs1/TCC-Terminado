<?php
if($_SESSION['cargo'] !== "ADMIN" && $_SESSION['cargo'] !== "COZINHEIRO") {
    header('Location: '.INCLUDE_PATH);
    exit();
}
?>

<div class="container">
    <h2>Criar Nova Marmita</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="nome" class="title">Nome da Marmita:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="descricao" class="title">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="preco" class="title">Preço (R$):</label>
        <input type="number" step="0.01" id="preco" name="preco" required>

        <label for="imagem" class="title">Imagem da Marmita:</label>
        <input type="file" id="imagem" name="imagem" accept="image/*" required>

        <input type="submit" value="Criar Marmita" class="btn-submit">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $imagem = $_FILES['imagem'];

        $marmita = new Marmitas();
        if ($marmita->criarMarmita($nome, $descricao, $preco, $imagem)) {
            echo '<p class="success">Marmita criada com sucesso!</p>';
        } else {
            echo '<p class="error">Erro ao criar marmita.</p>';
        }
    }
    ?>
</div>
