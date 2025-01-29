<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Aqui você pode adicionar a lógica para salvar os dados no banco de dados

    echo "Cadastro realizado com sucesso!";
    echo "<br>Nome: $name";
    echo "<br>Email: $email";
}
?>
