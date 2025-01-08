<?php
require "include/session.php";
require "db/conect.php";
require "include/response.php";
require "include/get.php"
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de funcionários</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.24/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <header>
        <div class="options">
            <a href="new_empresa.php">Cadastrar Nova Empresa</a>
            <a href="new_funcionario.php">Cadastrar Novo Funcionário</a>
            <a href="logout.php">Sair</a>
        </div>
    </header>
    <main class="container none-columns">
        <section>
            <button id="download">Exporta em PDF</button>
            <h1>Funcionários Cadastrados</h1>
            <table id="table" border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Salário</th>
                        <th>Bonificação</th>
                        <th>Data de Cadastro</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <tr class="<?= $funcionario['bonificacao'] == 1.2 ? "red" : "" ?><?= $funcionario['bonificacao'] == 1.1 ? "blue" : "" ?>">
                            <td><?= $funcionario['id_funcionario'] ?></td>
                            <td><?= $funcionario['nome'] ?></td>
                            <td class="cpf"><?= $funcionario['cpf'] ?></td>
                            <td class="rg"><?= $funcionario['rg'] ?></td>
                            <td><?= $funcionario['email'] ?></td>
                            <td><?= $funcionario['empresa'] ?></td>
                            <td>R$ <?= number_format($funcionario['salario'], 2, ',', '.') ?></td>
                            <td><?= 100 - ($funcionario['bonificacao'] * 100) == 100 ? 0 : ($funcionario['bonificacao'] * 100) - 100  ?>%</td>
                            <td><?= date_format(date_create($funcionario['data_cadastro']), 'd/m/Y') ?></td>
                            <td>
                                <a href="edit_funcionario.php?id=<?= $funcionario['id_funcionario'] ?>">Editar</a>
                                <a href="include/actions.php?s=delete&id=<?= $funcionario['id_funcionario'] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php
    echo $response->get("popup") ? '<p id="popup">' . $response->get("popup") . '</p>' : "";
    $response->delete("popup");
    ?>
    <script src="js/script.js"></script>
</body>

</html>