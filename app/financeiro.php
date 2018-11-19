<?php
    session_start();
    include_once ('conexao.php'); 
    $result_gasto = "SELECT nome_produto, valor_total FROM produto";
    $resultado_gasto = mysqli_query($conn, $result_gasto);
    $result_ganho = "SELECT servico, preco_servico FROM events";
    $resultado_ganho = mysqli_query($conn, $result_ganho);
?>
<!DOCTYPE html>
<html lang='pt-br'>
     <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
          <title>Financeiro</title>
          <link rel='stylesheet' href='node_modules/bootstrap/dist/css/estilo.css'>
          <link rel='stylesheet' href='node_modules/bootstrap/dist/css/bootstrap.css'>
          <link rel="stylesheet" href="css/personalizado.css">
     </head>
     <body id="body-painel">
          <!-- nav do menu -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="painel.php">Barbearia</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="agenda.php">Agenda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profissional.php">Profissionais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estoque.php">Estoque</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="financeiro.php">Financeiro</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Olá, <?php echo $_SESSION['usuario'];?>
                </span>
                <span class="navbar-text">
                    <a class="nav-link text-danger" href="sair.php"><img src="imagens/shutdown.png" id="img-btn"></a>
                </span>
            </div>
        </nav>
        <!-- nav do menu -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                <table class="table table-hover table-bordered">
                        <thead>
                            <tr>                                
                                <th scope="col">Nome</th>
                                <th scope="col">Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                while($row_gasto = mysqli_fetch_assoc($resultado_gasto)) {
                           ?>
                                <tr>
                                    <td><?php echo $row_gasto['nome_produto'] ?></td>
                                    <td><?php echo "R$ ". number_format($row_gasto['valor_total'], 2,',','.'); ?></td>
                                </tr>
                           <?php
                                }
                           ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-5">                   
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>                                
                                <th scope="col">Serviço</th>
                                <th scope="col">Preço Serviço</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row_ganho = mysqli_fetch_assoc($resultado_ganho)) {
                        ?>
                            <tr>
                                <td><?php echo $row_ganho['servico'] ?></td>
                                <td><?php echo "R$ ". number_format($row_ganho['preco_servico'], 2,',','.'); ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>                  
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <?php
                    //query para somar os valores da coluna valor_total da tabela produto
                        $query = "SELECT SUM(valor_total) AS valor_soma FROM produto";
                        $result = mysqli_query($conn, $query); 
                        while($sum = mysqli_fetch_array($result)){
                            $soma = $sum['valor_soma'];  
                        } ?>
                        <div class="fin-gasto-est">
                            <?php
                                echo "Valor gasto na manutenção do estoque R$ ". number_format($soma, 2,',','.'); 
                            ?>
                        </div>                                     
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-5">
                        <?php
                        //query para somar os valores da coluna valor_total da tabela produto
                            $query = "SELECT SUM(preco_servico) AS valor_soma FROM events";
                            $result = mysqli_query($conn, $query); 
                            while($sum = mysqli_fetch_array($result)){
                                $soma = $sum['valor_soma'];  
                            } ?>
                            <div class="fin-ganho">
                                <?php
                                    echo "valor ganho com serviços prestados R$ ". number_format($soma, 2,',','.');  
                                ?>                                       
                            </div>
                </div>
            </div>          
        </div>
          <script src='node_modules/jquery/dist/jquery.slim.min.js'></script>
          <script src='node_modules/popper.js/dist/popper.min.js'></script>
          <script src='node_modules/bootstrap/dist/js/bootstrap.js'></script>
     </body>
</html>