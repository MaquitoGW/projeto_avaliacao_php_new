<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta
$response = new Response;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST['login']);
    $senha = md5(trim($_POST['senha']));
    $_SESSION['login'] = $login;

    // Validação de entrada
    if (empty($login) || empty($senha)) $response->create("popup", "Todos os campos são obrigatórios.");
    else {
        if (!filter_var($login, FILTER_VALIDATE_EMAIL)) $response->create("popup", "O e-mail é inválido.");
        else {
            // Verifica o login no banco de dados
            $query = $pdo->prepare("SELECT * FROM tbl_usuario WHERE login = :login");
            $query->bindValue(":login", $login);
            $query->execute();
            $result = $query->fetch();

            if (!empty($result)) {
                if (trim($result['senha']) == $senha) {
                    $_SESSION['loggedin'] = true;
                    $response->redirect("/");
                } else  $response->create("popup", "A senha informada está incorreta.");
            } else $response->create("popup", "O email enviado não existe.");
        }
    }
    $response->redirect("/login.php");
}