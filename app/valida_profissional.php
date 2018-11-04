<?php
    session_start();
    include_once ('conexao.php');

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
    $aniversario = filter_input(INPUT_POST, 'niver', FILTER_SANITIZE_STRING);
    $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING);
    
    $query = "INSERT INTO profissional (nome_profissional, telefone_profissional, aniversario_profissional, cargo) 
    VALUES ('$nome', '$telefone', '$aniversario','$cargo')";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_insert_id($conn)) {
        $_SESSION['cadastro'] = "Cliente cadastrado com sucesso!";
        header("Location: profissional.php");
    }else{
        $_SESSION['nao_cadastro'] = mysqli_error($conn);
        echo mysqli_error($conn);
        header("Location: profissional.php");
    }

?>