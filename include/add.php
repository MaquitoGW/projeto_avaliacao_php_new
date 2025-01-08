<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $get = $_GET['s'];
    $response = new Response();
    if ($get == "funcionario") {
        // Adicionar novo funcionario
        $res = $pdo->prepare("INSERT INTO tbl_funcionario (nome, cpf, rg, email, id_empresa, salario, bonificacao, data_cadastro) VALUES (:n, :cpf, :rg, :e, :em, :s, :b, :date)");
        $res->bindValue(":n",  $_POST['nome']);
        $res->bindValue(":cpf",  str_replace(['.', '-'], '', $_POST['cpf']));
        $res->bindValue(":rg",  str_replace('.', '', $_POST['rg']));
        $res->bindValue(":em",  $_POST['empresa']);
        $res->bindValue(":s", floatval(str_replace(',','.',$_POST['salario'])));
        $res->bindValue(":date", $_POST['data_cadastro']);

        // Verificar se usuário tem direito a bonificacao
        $data_atual = new DateTime();
        $data_cadastro = new DateTime($_POST['data_cadastro']);

        $diferenca = $data_atual->diff($data_cadastro)->y;
        if($diferenca >= 5) $valor = 1.20; // Bonificacao de 20%
        elseif($diferenca >= 1) $valor = 1.10; // Bonificacao de 10%
        else $valor = 0; 

        $res->bindValue(":b", $valor);

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
