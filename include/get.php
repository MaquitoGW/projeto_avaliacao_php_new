<?php
$response = new Response();

// Buscar funcionarios
$query = $pdo->prepare("SELECT f.id_funcionario, f.nome, f.cpf, f.rg, f.email, e.nome as empresa FROM tbl_funcionario f JOIN tbl_empresa e ON f.id_empresa = e.id_empresa");
$query->execute();
$funcionarios = $query->fetchAll();

// Buscar empresas
$select = $pdo->prepare("SELECT * FROM tbl_empresa WHERE id_empresa");
$select->execute();
$empresas = $select->fetchAll();
