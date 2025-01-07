<?php
require "db/conect.php";
require "include/session.php";

// Buscar empresas
$select = $pdo->prepare("SELECT * FROM tbl_empresa WHERE id_empresa");
$select->execute();
$empresas = $select->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="options">
            <a href="/">Voltar ao início</a>
            <a href="new_empresa.php">Adicionar empresa</a>
            <a href="logout.php">Sair</a>
        </div>
    </header>
    <main class="container none-columns">
        <form action="include/add.php?s=funcionario" method="POST">
            <h1>Cadastrar Funcionário</h1>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Insira o nome completo" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" maxlength="14" oninput="formatCPF(this)" name="cpf" placeholder="000.000.000-00" required>

            <label for="rg">RG:</label>
            <input type="text" id="rg" maxlength="10" oninput="formatRG(this)" name="rg" placeholder="00.000.000">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="email@exemplo.com" required>

            <label for="empresa">Empresa:</label>
            <select name="empresa" required>
                <option value="">Selecione uma empresa</option>
                <?php foreach ($empresas as $value): ?>
                    <option value="<?= $value["id_empresa"]; ?>"><?= $value["nome"]; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Inserir</button>
        </form>
    </main>]
    <script src="js/script.js"></script>
</body>

</html>