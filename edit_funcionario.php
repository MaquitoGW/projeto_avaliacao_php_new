<?php
require "db/conect.php";
require "include/response.php"; // Class para a reposta

$response = new Response;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar empresas
    $select = $pdo->prepare("SELECT * FROM tbl_empresa");
    $select->execute();
    $empresas = $select->fetchAll();

    // Buscar informações do funcionario
    $select = $pdo->prepare("SELECT * FROM tbl_funcionario WHERE id_funcionario = :id");
    $select->bindValue(":id", $id, PDO::PARAM_INT);
    $select->execute();
    $funcionario = $select->fetch();

    // Verificar se o funcionario foi encontrado
    if (!$funcionario) {
        $response->create("popup", "Nenhum funcionário encontrado com esse ID.");
        $response->redirect("/");
    }
} else {
    $response->create("popup", "Nenhum parâmetro foi enviado.");
    $response->redirect("/");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar funcionário</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="options">
            <a href="/">Voltar ao início</a>
        </div>
    </header>
    <main class="container none-columns">
        <form action="include/actions.php?s=editar&id=<?= $funcionario['id_funcionario'] ?>" method="POST">
            <h1>Editar funcionário</h1>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= $funcionario['nome'] ?>" placeholder="Insira o nome completo" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" maxlength="14" value="<?= $funcionario['cpf'] ?>" oninput="formatCPF(this)" name="cpf" placeholder="000.000.000-00" required>

            <label for="rg">RG:</label>
            <input type="text" id="rg" maxlength="10" value="<?= $funcionario['rg'] ?>" oninput="formatRG(this)" name="rg" placeholder="00.000.000">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $funcionario['email'] ?>" placeholder="email@exemplo.com" required>

            <label for="empresa">Empresa:</label>
            <select name="empresa" required>
                <option value="">Selecione uma empresa</option>
                <?php foreach ($empresas as $value): ?>
                    <option <?= $funcionario["id_empresa"] == $value["id_empresa"]  ? "selected" : "" ?> value="<?= $value["id_empresa"]; ?>"><?= $value["nome"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="salario">Salário:</label>
            <input type="text" id="salario" name="salario" value="<?= number_format($funcionario['salario'], 2, ',', '.') ?>" required placeholder="0,00">

            <label for="data_cadastro">Data de Cadastro:</label>
            <input type="date" id="data_cadastro" value="<?= $funcionario['data_cadastro'] ?>" name="data_cadastro" placeholder="data_cadastro@exemplo.com" required>

            <button type="submit">Editar</button>
        </form>
    </main>

    <script src="js/script.js"></script>
    <script>
        formatRG(document.getElementById('rg'));
        formatCPF(document.getElementById('cpf'));
    </script> 
</body>

</html>