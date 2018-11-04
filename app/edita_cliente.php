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
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                $aniversario = filter_input(INPUT_POST, 'aniversario', FILTER_SANITIZE_STRING);
                $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
                $observacoes = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);
                $como_conheceu = filter_input(INPUT_POST, 'conheceu', FILTER_SANITIZE_STRING);
                $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
                $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
                $num_casa = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);

                $query = "UPDATE cliente SET nome_cliente='$nome', telefone_cliente='$telefone', email_cliente='$email', aniversario_cliente='$aniversario', 
                como_conheceu='$como_conheceu', observacoes='$observacoes', sexo='$sexo', rua='$rua', bairro='$bairro', numero='$num_casa' WHERE id='$id' ";
                $resultado_cliente = mysqli_query($conn, $query);
                
                if (mysqli_affected_rows($conn) != 0) { ?>
                    <!-- modal de sucesso -->
                    <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cliente atualizado com sucesso!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O cliente <?php echo $nome?> foi atualizado com sucesso!</p>
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
                                    <h5 class="modal-title">Erro ao atualizar cliente!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O cliente <?php echo $nome?> não foi atualizado com sucesso!</p>
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