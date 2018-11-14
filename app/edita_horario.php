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
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $color = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
            $start = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_STRING);
            $end = filter_input(INPUT_POST, 'fim', FILTER_SANITIZE_STRING);
            $nome_cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_STRING);
            $nome_profissional = filter_input(INPUT_POST, 'profissional', FILTER_SANITIZE_STRING);

            if(!empty($id) && !empty($title) && !empty($color) && !empty($start) && !empty($end)){
                //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
                $data = explode(" ", $start);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $start_sem_barra = $data_sem_barra . " " . $hora;
                
                $data = explode(" ", $end);
                list($date, $hora) = $data;
                $data_sem_barra = array_reverse(explode("/", $date));
                $data_sem_barra = implode("-", $data_sem_barra);
                $end_sem_barra = $data_sem_barra . " " . $hora;
                
                $result_events = "UPDATE events SET servico='$title', cor='$color', inicio='$start_sem_barra', fim='$end_sem_barra' WHERE id='$id'"; 
                $resultado_events = mysqli_query($conn, $result_events);
                
                //Verificar se alterou no banco de dados através "mysqli_affected_rows"
                if(mysqli_affected_rows($conn)){ ?>
                     <!-- modal de sucesso -->
                     <div class="modal fade" id="modal_sucesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">O Horário foi atualizado com sucesso!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O horário do cliente <?php echo $nome_cliente?> foi atualizado com sucesso!</p>
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
                    <?php 
                }else{ ?>
                   <!-- modal de erro -->
                   <div class="modal fade" id="modal_erro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Erro ao atualizar horário!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>O horário do cliente <?php echo $nome?> não foi atualizado com sucesso!</p>
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
               <?php  }
                
            }else{ ?>
                <!-- modal de erro -->
               <div class="modal fade" id="modal_erro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Erro ao atualizar horário!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>O horário do cliente não foi atualizado com sucesso, por favor insira todos os dados!</p>
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
            <?php } ?>