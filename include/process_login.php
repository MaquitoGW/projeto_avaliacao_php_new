<?php
require dirname(__DIR__) . "/db/conect.php"; // Arquivo de conexão ao banco de dados
require "response.php"; // Class para a reposta
$response = new Response;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Validação de entrada
    if (empty($login) || empty($senha)) $response->create("popup", "Todos os campos são obrigatórios.");
    else {
        // Verifica o login no banco de dados
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM tbl_usuario WHERE login = :login AND senha = :senha");
        $query->bindValue(":login", $login);
        $query->bindValue("senha", $senha );
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] > 0) {
            $_SESSION['login'] = true;
            $response->redirect("/");
        }
        else $response->create("popup", "Login ou senha incorretos.");
    }
    $response->redirect("/login.php");
}
