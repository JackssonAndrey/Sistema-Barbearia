<?php
    session_start();
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
                    <li class="nav-item active">
                        <a class="nav-link" href="profissional.php">Profissionais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estoque.php">Estoque</a>
                    </li>
                    <li class="nav-item">
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

         <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        <img src="imagens/add-user.png" alt="" style="width: 20px; height: 20px; margin:2px;"> Adicionar Funcionário
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Funcionário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" action="valida_profissional.php" method="post">
                            <div class="form-group">
                                <h2 class="form-signin-heading">Adicione um funcionário!</h2>
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Telefone:</label>
                                <input class="form-control" type="number" name="tel" id="tel" placeholder="Telefone" required>
                            </div>
                            <div class="form-group">
                                <label for="niver">Aniversário:</label>
                                <input class="form-control" type="date" name="niver" id="niver" placeholder="Aniversário" required>
                            </div>
                            <div class="form-group">
                                <label for="niver">Cargo:</label>
                                <input class="form-control" type="text" name="cargo" id="cargo" placeholder="Cargo" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Salvar">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><img src="imagens/delete-button.png" id="img-btn"> Cancelar</button>
                
                    </div>
                </div>
            </div>
        </div>
        <!-- corpo da página -->
        <!-- tabela com lista de funcionarios -->
        <?php
            $result_funcionario = "SELECT * FROM profissional";
            $resultado_funcionario = mysqli_query($conn, $result_funcionario);
        ?>
        <table class="table table-hover">
            <thead>
                <tr>  
                <th scope="col">ID</th>                              
                <th scope="col">Nome</th>
                <th scope="col">Telefone</th>
                <th scope="col">Aniversário</th>
                <th scope="col">Cargo</th>
                <th scope="col">Editar</th>
                <th scope="col">Apagar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row_funcionario = mysqli_fetch_assoc($resultado_funcionario)){ ?>
                    <tr>
                        <td><?php echo $row_funcionario['id'] ?></td>                   
                        <td><?php echo $row_funcionario['nome_profissional'] ?></td>
                        <td><?php echo $row_funcionario['telefone_profissional'] ?></td>
                        <td><?php echo $row_funcionario['aniversario_profissional']?></td>
                        <td><?php echo $row_funcionario['cargo'] ?></td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal_editar" data-whatever="<?php echo $row_funcionario['id'] ?>" 
                            data-whatevernome="<?php echo $row_funcionario['nome_profissional'] ?>" data-whatevertelefone="<?php echo $row_funcionario['telefone_profissional'] ?>"
                            data-whateveraniversario="<?php echo $row_funcionario['aniversario_profissional'] ?>" data-whatevercargo="<?php echo $row_funcionario['cargo'] ?>">
                            <img id="img-btn" src="imagens/pen.png"></button></td>
                        <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm"><img src="imagens/delete.png" id="img-btn"></button></td>
                    </tr>
                <?php }?> 
            </tbody>
        </table>
        <!-- modal de confirmação de deleção -->
        <div class="modal fade" id="confirm" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                <div class="modal-body">
                    <p> Deseja relamente apagar o profissional?</p>
                </div>
                <div class="modal-footer">
                    <a href="deleta_profissional.php?id=<?php echo $row_profissional['id']?> "><button type="button" class="btn btn-danger" id="delete">
                        <img src="imagens/success.png" id="img-btn">Apagar Registro</button></a>
                    <button type="button" data-dismiss="modal" class="btn btn-default"><img src="imagens/delete-button.png" id="img-btn" >Cancelar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- modal para editar as informaçoes do profissional -->
        <div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar dados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="edita_profissional.php" method="POST">
                            <input type="hidden" name="id" id="id_profissional">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" id="recipient-name" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Telefone:</label>
                                <input type="number" class="form-control" id="recipient-telefone" name="telefone">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Aniversário:</label>
                                <input type="text" class="form-control" id="recipient-aniversario" name="aniversario">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Cargo:</label>
                                <input type="text" class="form-control" id="recipient-cargo" name="cargo">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" ><img src="imagens/save-button.png" id="img-btn">Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><img src="imagens/delete-button.png" id="img-btn" >Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <script src='node_modules/jquery/dist/jquery.slim.min.js'></script>
        <script src='node_modules/popper.js/dist/popper.min.js'></script>
        <script src='node_modules/bootstrap/dist/js/bootstrap.js'></script>
        <script type="text/javascript">
            /* função para buscar dados do cliente e editar */
            $('#modal_editar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Botão que acionou o modal
                var recipient = button.data('whatever') // Extrai informação dos atributos data-*
                var recipient_nome = button.data('whatevernome')
                var recipientt_telefone = button.data('whatevertelefone')
                var recipient_aniversario = button.data('whateveraniversario')
                var recipient_cargo = button.data('whatevercargo')
                // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
                // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
                var modal = $(this)
                modal.find('.modal-title').text('ID do profissional ' + recipient)
                modal.find('#id_profissional').val(recipient)
                modal.find('#recipient-name').val(recipient_nome)
                modal.find('#recipient-telefone').val(recipientt_telefone)
                modal.find('#recipient-aniversario').val(recipient_aniversario)
                modal.find('#recipient-cargo').val(recipient_cargo)
            })
        </script>
     </body>
</html>