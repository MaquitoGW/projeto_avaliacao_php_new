<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta

date_default_timezone_set('America/Sao_Paulo');
$response = new Response;
if (!isset($_GET['s']) && !isset($_GET['id'])) {
    $response->create("popup", "Nenhum parâmetros foi enviado");
} else {
    $get = $_GET['s'];
    $id = $_GET['id'];

    if ($get == "editar") {
        // Atualizar dados 
        $res = $pdo->prepare("UPDATE tbl_funcionario SET nome=:n, cpf=:cpf, rg=:rg, email=:e, id_empresa=:em, salario=:s, bonificacao=:b, data_cadastro=:date WHERE id_funcionario=:id");
        $res->bindValue(":id", $id);
        $res->bindValue(":n",  $_POST['nome']);
        $res->bindValue(":cpf",  str_replace(['.', '-'], '', $_POST['cpf']));
        $res->bindValue(":rg",  str_replace('.', '', $_POST['rg']));
        $res->bindValue(":em",  $_POST['empresa']);
        $res->bindValue(":s", floatval(str_replace(',', '.', str_replace('.', '', $_POST['salario']))));
        $res->bindValue(":date", $_POST['data_cadastro']);

        // Verificar se usuário tem direito a bonificacao
        $data_atual = new DateTime();
        $data_cadastro = new DateTime($_POST['data_cadastro']);

        $diferenca = $data_atual->diff($data_cadastro)->y;
        if ($diferenca >= 5) $valor = 1.20; // Bonificacao de 20%
        elseif ($diferenca >= 1) $valor = 1.10; // Bonificacao de 10%
        else $valor = 0;

        $res->bindValue(":b", $valor);

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $response->create("popup", "O e-mail é inválido.");
            $response->redirect("/edit_funcionario.php?id=" . $id);
        } else {
            $res->bindValue(":e",  $_POST['email']);
            $response->create("popup", $res->execute() ?  "Funcionário editado com sucesso" : "Erro ao editar funcionário");
        }
    } elseif ($get == "delete") {
        // Apagar funcionario
        $query = $pdo->prepare("DELETE FROM tbl_funcionario WHERE id_funcionario=:id");
        $query->bindValue(":id", $id);

        $response->create("popup", $query->execute() ?  "Funcionário apagado com sucesso" : "Erro ao apagar funcionário");
    }
}
$response->redirect("/");
