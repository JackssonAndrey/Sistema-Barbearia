<?php
    include_once ('conexao.php');
?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <title>Profissional</title>
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
                $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
                $aniversario = filter_input(INPUT_POST, 'niver', FILTER_SANITIZE_STRING);
                $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING);

                $query = "UPDATE profissional SET nome_profissional='$nome', telefone_profissional='$telefone', aniversario_profissional='$aniversario', 
                cargo='$cargo' WHERE id='$id' ";
                $resultado_cliente = mysqli_query($conn, $query);
                
                if (mysqli_affected_rows($conn) != 0) { ?>
                    <!-- modal de sucesso -->
                    <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Profissional atualizado com sucesso!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O profissional <?php echo $nome?> foi atualizado com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="profissional.php"><button type="button" class="btn btn-success">Ok</button></a>
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
                                    <h5 class="modal-title">Erro ao atualizar profissional!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O profissional <?php echo $nome?> não foi atualizado com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="profissional.php"><button type="button" class="btn btn-danger">Fechar</button></a>
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