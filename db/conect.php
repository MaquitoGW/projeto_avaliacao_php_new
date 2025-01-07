<?php
/*
Conexao com Banco de Dados 
---------
ATENCAO!
- Insirar as tabelas ao seu banco de dados, elas estao localizadas em SQL/controle_funcionarios.sql
*/

$dbName = "controle_funcionarios";
$host= "localhost";
$user = "root";
$password = "maicon2107";

try {
    $pdo = new PDO("mysql:dbname=$dbName;host=$host", $user , $password);
} 
catch (PDOException $e){
    echo "Erro no banco de dados: ". $e->getMessage();
}
catch (Exception $e) {
    echo $e->getMessage();
}