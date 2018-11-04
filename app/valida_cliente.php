<?php
    include_once ('conexao.php');
?>
<!DOCTYPE html>
<html lang='pt-br'>
        <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <title>Cliente</title>
        <link rel='stylesheet' href='node_modules/bootstrap/dist/css/estilo.css'>
        <link rel='stylesheet' href='node_modules/bootstrap/dist/css/bootstrap.css'>
        <script src='node_modules/jquery/dist/jquery.slim.min.js'></script>
        <script src='node_modules/popper.js/dist/popper.min.js'></script>
        <script src='node_modules/bootstrap/dist/js/bootstrap.js'></script>
        </head>
        <body>
        <div class="container theme-showcase" role="main">
            <?php

                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                $aniversario = filter_input(INPUT_POST, 'niver', FILTER_SANITIZE_STRING);
                $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
                $observacoes = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);
                $como_conheceu = filter_input(INPUT_POST, 'conheceu', FILTER_SANITIZE_STRING);
                $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
                $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
                $num_casa = filter_input(INPUT_POST, 'num_casa', FILTER_SANITIZE_STRING);

                $query = "INSERT INTO cliente (nome_cliente, telefone_cliente, email_cliente, aniversario_cliente, como_conheceu, observacoes, sexo, rua, bairro, numero) 
                VALUES ('$nome', '$telefone', '$email', '$aniversario', '$como_conheceu', '$observacoes', '$sexo', '$rua', '$bairro', '$num_casa')";
                $resultado = mysqli_query($conn, $query);

                if (mysqli_insert_id($conn)) { ?>
                    <!-- modal de sucesso -->
                    <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cliente cadastrado com sucesso!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O cliente <?php echo $nome?> foi cadastrado com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="cliente.php"><button type="button" class="btn btn-success">Ok</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#modal_sucesso').modal('show');
                        });
                    </script>
                <?php }else{ ?>
                    <!-- modal de erro -->
                    <div class="modal fade" id="modal_erro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Erro ao cadastrar cliente!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O cliente <?php echo $nome?> não foi cadastrado com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="cliente.php"><button type="button" class="btn btn-danger">Fechar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#modal_erro').modal('show');
                        });
                    </script>
                <?php } ?>
        </div>
	</body>
</html>
