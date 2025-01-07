<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $get = $_GET['s'];
    $response = new Response();
    if ($get == "funcionario") {
        // Adicionar novo funcionario
        $res = $pdo->prepare("INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa) VALUES (:n, :cpf, :rg, :e, :em)");
        $res->bindValue(":n",  $_POST['nome']);
        $res->bindValue(":cpf",  str_replace(['.', '-'], '', $_POST['cpf']));
        $res->bindValue(":rg",  str_replace('.', '', $_POST['rg']));
        $res->bindValue(":em",  $_POST['empresa']);

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $response->create("popup", "O e-mail é inválido.");
        else {
            $res->bindValue(":e",  $_POST['email']);
            $response->create("popup", $res->execute() ?  "Novo funcionário cadastrado com sucesso" : "Erro ao cadastrar funcionário");
        }
    } elseif ($get == "empresa") {
        // Adicionar empresa
        $res = $pdo->prepare("INSERT INTO tbl_empresa (nome) VALUES (:n)");
        $res->bindValue(":n", $_POST["nome"]);

        $response->create("popup", $res->execute() ?  "Nova empresa adicionada" : "Erro ao adicionar empresa");
    }
    $response->redirect("/");
}
