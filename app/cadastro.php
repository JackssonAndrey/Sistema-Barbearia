<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/estilo.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <form class="form-signin" action="valida_cadastro.php" method="post">
        <div class="form-group">
            <h2 class="form-signin-heading">Cadastre-se.</h2>
            </div>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuário" autofocus required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <input class="btn btn-lg btn-success" type="submit" value="Salvar">
                <a href="index.php"><input class="btn btn-lg btn-danger" type="button" value="Cancelar"></a>
            </div>
        </form>
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