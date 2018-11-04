<?php
    session_start();
    include_once ('conexao.php');

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $quantidade = filter_input(INPUT_POST, 'qtd', FILTER_SANITIZE_STRING);
    $valor_unitario = filter_input(INPUT_POST, 'valor_unitario', FILTER_SANITIZE_STRING);
    $valor_total = filter_input(INPUT_POST, 'valor_total', FILTER_SANITIZE_STRING);
    $validade = filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_STRING);
    $data_entrada = filter_input(INPUT_POST, 'entrada', FILTER_SANITIZE_STRING);

    $query = "INSERT INTO produto (nome_produto, quantidade, valor_unitario, valor_total, validade, data_entrada) 
    VALUES ('$nome', '$quantidade', '$valor_unitario', '$valor_total', '$validade', '$data_entrada')";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_insert_id($conn)) {
        $_SESSION['cadastro'] = "Produto cadastrado com sucesso!";
        header("Location: estoque.php");
    }else{
        $_SESSION['nao_cadastro'] = mysqli_error($conn);
        echo mysqli_error($conn);
        header("Location: estoque.php");
    }

?>