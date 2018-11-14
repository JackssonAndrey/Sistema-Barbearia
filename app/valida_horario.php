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
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $color = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
            $start = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_STRING);
            $end = filter_input(INPUT_POST, 'fim', FILTER_SANITIZE_STRING);
            $nome_cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_STRING);
            $nome_profissional = filter_input(INPUT_POST, 'profissional', FILTER_SANITIZE_STRING);

            if(!empty($title) && !empty($color) && !empty($start) && !empty($end) && !empty($nome_cliente)){
                //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
                $data = explode(" ", $start);// tirar o espaço
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));//tirar a barra da data
                $data_sem_barra = implode("-", $data_sem_barra);// colocar traço para separar data
                $start_sem_barra = $data_sem_barra . " " . $hora;
                
                $data = explode(" ", $end);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $end_sem_barra = $data_sem_barra . " " . $hora;
                
                $result_events = "INSERT INTO events (servico, cor, inicio, fim, nome_cliente, nome_profissional) VALUES 
                ('$title', '$color', '$start_sem_barra', '$end_sem_barra', '$nome_cliente', '$nome_profissional')";
                $resultado_events = mysqli_query($conn, $result_events); 
                
                if(mysqli_insert_id($conn)){ ?>
                    <!-- modal de sucesso -->
                    <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">O Horário foi marcado com sucesso!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O horário do cliente <?php echo $nome_cliente?> foi cadastrado com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="agenda.php"><button type="button" class="btn btn-success">Ok</button></a>
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
                                    <h5 class="modal-title">Erro ao marcar horário!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O horário do cliente <?php echo $nome?> não foi marcado com sucesso!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="agenda.php"><button type="button" class="btn btn-danger">Fechar</button></a>
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
            }else{?>
               <!-- modal de erro -->
               <div class="modal fade" id="modal_erro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Erro ao marcar horário!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>O horário do cliente não foi marcado com sucesso, por favor insira todos os dados!</p>
                            </div>
                            <div class="modal-footer">
                                <a href="agenda.php"><button type="button" class="btn btn-danger">Fechar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#modal_erro').modal('show');
                    });
                </script>
            <?php }?>    
        </div>
    </body>
</html>