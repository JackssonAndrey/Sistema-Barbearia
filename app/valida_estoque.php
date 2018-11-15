<?php
    include_once ('conexao.php');
?>
<!DOCTYPE html>
<html lang='pt-br'>
        <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <title>Estoque</title>
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
                $quantidade = filter_input(INPUT_POST, 'qtd', FILTER_SANITIZE_STRING);
                $valor_unitario = filter_input(INPUT_POST, 'valor_unitario', FILTER_SANITIZE_STRING);
                $valor_total = filter_input(INPUT_POST, 'valor_total', FILTER_SANITIZE_STRING);
                $validade = filter_input(INPUT_POST, 'validade', FILTER_SANITIZE_STRING);
                $data_entrada = filter_input(INPUT_POST, 'entrada', FILTER_SANITIZE_STRING);

                $query = "INSERT INTO produto (nome_produto, quantidade, valor_unitario, valor_total, validade, data_entrada) 
                VALUES ('$nome', '$quantidade', '$valor_unitario', '$valor_total', '$validade', '$data_entrada')";
                $resultado = mysqli_query($conn, $query);

                if (mysqli_insert_id($conn)) { ?>
                    <!-- modal de sucesso -->
                    <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Produto cadastrado com sucesso!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O produto <?php echo $nome?> foi adicionado ao estoque com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="estoque.php"><button type="button" class="btn btn-success">Ok</button></a>
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
                                    <h5 class="modal-title">Erro ao cadastrar produto!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O produto <?php echo $nome?> não foi adicionado ao estoque com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="estoque.php"><button type="button" class="btn btn-danger">Fechar</button></a>
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