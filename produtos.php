<?php

include_once('index.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$quantidade_estoque = $_POST['quantidade'];


function registrarProduto($nome, $descricao, $preco, $quantidade_estoque) {
    global $pdo;

  
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, quantidade_estoque) VALUES (?, ?, ?, ?)");

  
    try {
        $stmt->execute([$nome, $descricao, $preco, $quantidade_estoque]);
        echo "Produto registrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao registrar o produto: " . $e->getMessage();
    }
}

 registrarProduto($nome,$descricao,$preco,$quantidade_estoque);
 }

?>



<h1>Registrar Produto</h1>
<form action="produtos.php" method="post">
<div>
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>
</div>
<div>
    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" required>
</div>
<div>
    <label for="preço">Preço:</label>
    <input type="text" name="preco" required>
</div>
<div>
    <label for="quantidade">Quantidade para estoque:</label>
    <input type="number" name="quantidade" required>
</div>

<div>
    <input type="submit" value="Enviar">
</div>


</form>
