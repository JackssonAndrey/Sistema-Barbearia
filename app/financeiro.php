<?php
    session_start();
    include_once ('conexao.php'); 
?>
<!DOCTYPE html>
<html lang='pt-br'>
     <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
          <title>Title</title>
          <link rel='stylesheet' href='node_modules/bootstrap/dist/css/estilo.css'>
          <link rel='stylesheet' href='node_modules/bootstrap/dist/css/bootstrap.css'>
     </head>
     <body id="body-painel">
          <!-- nav do menu -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="painel.php">Barbearia</a>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="agenda.php">Agenda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profisional.php">Profissionais</a>
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
                    <a class="nav-link text-danger" href="sair.php">Sair</a>
                </span>
            </div>
        </nav>
        <!-- nav do menu -->
          <script src='node_modules/jquery/dist/jquery.slim.min.js'></script>
          <script src='node_modules/popper.js/dist/popper.min.js'></script>
          <script src='node_modules/bootstrap/dist/js/bootstrap.js'></script>
     </body>
</html>