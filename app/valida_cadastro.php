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
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
                    
            $query = "INSERT INTO usuario (nome, senha) VALUES ('$usuario', '$senha')";
            $resultado_usuario = mysqli_query($conn, $query);
            
            if (mysqli_insert_id($conn)) { ?>
                <!-- modal de sucesso -->
                <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Usuário cadastrado com sucesso!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>O Usuário <?php echo $usuario?> foi cadastrado com sucesso!</p>
                            </div>
                            <div class="modal-footer">
                                <a href="index.php"><button type="button" class="btn btn-success">Ok</button></a>
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
                                <h5 class="modal-title">Erro ao cadastrar usuário!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>O Usuário <?php echo $usuario?> não foi cadastrado com sucesso!</p>
                            </div>
                            <div class="modal-footer">
                                <a href="index.php"><button type="button" class="btn btn-danger">Fechar</button></a>
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
