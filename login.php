<?php
require "include/response.php";
$response = new Response;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="container none-columns">
        <form action="include/process_login.php" method="POST" class="login">
            <h2>Login</h2>
            <label for="login">Login:</label>
            <input type="email" id="login" name="login" placeholder="Insira seu usuário" value="<?= isset($_SESSION['login']) ? $_SESSION['login']  : ""; unset($_SESSION['login']); ?>" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="*******" required>

            <button type="submit">Entrar</button>
        </form>
    </main>

    <?php
    echo $response->get("popup") ? '<p id="popup">' . $response->get("popup") . '</p>' : "";
    $response->delete("popup");
    ?>

    <script src="js/script.js"></script>
</body>

</html>