<?php


$localhost = '127.0.0.1';
$banco = 'pdp';
$senha = '';
$usuario = 'root';

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$banco", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}



?>
