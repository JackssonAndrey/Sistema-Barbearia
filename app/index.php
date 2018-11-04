<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Barbearia</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/estilo.css">
</head>
<body class="body-index">
    <div class="container"> 
        <form class="form-signin" action="valida.php" method="post">
            <div class="form-group">
            <h2 class="form-signin-heading">ADM Barbearia</h2>
            </div>
            <div class="form-group">
                <label class="sr-only" for="usuario">Usuário:</label>
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuário" autofocus required>
            </div>
            <div class="form-group">
                <label class="sr-only" for="senha">Senha</label>
                <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <input class="btn btn-lg btn-success btn-block" type="submit" value="Acessar">
            </div>
            <div class="fomr-group">
                <a href="cadastro.php"><p class="text-right text-primary">Cadastre-se.</p></a>
            </div>
        </form>
       
        <p class="text-center text-success">
            <?php
                if(isset($_SESSION['cadastro'])){
                    echo $_SESSION['cadastro'];
                    unset ($_SESSION['cadastro']);
                }
            ?>
        </p>
        <p class="text-center text-danger">
            <?php
                if(isset($_SESSION['nao_cadastro'])){
                    echo $_SESSION['nao_cadastro'];
                    unset ($_SESSION['nao_cadastro']);
                }
            ?>
        </p>
    </div>
    
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>