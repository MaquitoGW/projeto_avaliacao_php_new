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
            <h1>Funcionários Cadastrados</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Email</th>
                        <th>Empresa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <tr>
                            <td><?= $funcionario['id_funcionario']; ?></td>
                            <td><?= $funcionario['nome']; ?></td>
                            <td class="cpf"><?= $funcionario['cpf']; ?></td>
                            <td class="rg"><?= $funcionario['rg']; ?></td>
                            <td><?= $funcionario['email']; ?></td>
                            <td><?= $funcionario['empresa']; ?></td>
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