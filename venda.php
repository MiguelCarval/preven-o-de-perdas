<?php
include_once('index.php');  

function registrarVenda($produto_id, $quantidade, $preco_unitario) {
    global $pdo;

   
    $stmt = $pdo->prepare("SELECT quantidade_estoque FROM produtos WHERE id = ?");
    $stmt->execute([$produto_id]);
    $estoque_disponivel = $stmt->fetchColumn();

    if ($estoque_disponivel < $quantidade) {
       
        echo "<p style='color: red;'>Estoque insuficiente para o produto ID: $produto_id. Estoque disponível: $estoque_disponivel, Tentativa de venda: $quantidade.</p>";
        return false;  
    }

    
    $total_venda = $quantidade * $preco_unitario;

    
    $stmt = $pdo->prepare("INSERT INTO vendas (produto_id, quantidade, preco_unitario, total) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$produto_id, $quantidade, $preco_unitario, $total_venda]);
        echo "<p style='color: green;'>Venda registrada com sucesso! Total: R$ $total_venda</p>";

        
        $stmt = $pdo->prepare("UPDATE produtos SET quantidade_estoque = quantidade_estoque - ? WHERE id = ?");
        $stmt->execute([$quantidade, $produto_id]);

        
        $stmt = $pdo->prepare("INSERT INTO transacoes_financeiras (tipo_transacao, valor, descricao) VALUES ('saida', ?, 'Venda do produto ID: $produto_id')");
        $stmt->execute([$total_venda]);

        return true;  
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erro ao registrar a venda: " . $e->getMessage() . "</p>";
        return false;
    }
}


registrarVenda(3,1,18);


?>
