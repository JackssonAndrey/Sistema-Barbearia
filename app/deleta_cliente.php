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
                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                if(!empty($id)){ 
                    $result_usuario = "DELETE FROM cliente WHERE id='$id'";
                    $resultado_usuario = mysqli_query($conn, $result_usuario);
                    if(mysqli_affected_rows($conn)){ ?>
                        <!-- modal de sucesso -->
                        <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cliente deletado com sucesso!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>O cliente foi deletado com sucesso, volte para a página de clientes!</p>
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
                                        <h5 class="modal-title">Erro ao deletar cliente!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Não foi possível deletar o cliente, tente novamente!</p>
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
                   <?php }  
                }else{	?>
                    <!-- modal de erro -->
                    <div class="modal fade" id="modal_erro2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Erro ao deletar cliente!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Necessário selecionar um cliente!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="cliente.php"><button type="button" class="btn btn-danger">Fechar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#modal_erro2').modal('show');
                        });
                    </script>
                <?php } ?>
            </div>
	    </body>
</html>