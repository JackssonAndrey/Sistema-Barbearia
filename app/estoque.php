<?php
    session_start();
    include_once ('conexao.php');
?>

<!DOCTYPE html>
<html lang='pt-br'>
    <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
          <title>Estoque</title>
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
                    <li class="nav-item ">
                        <a class="nav-link" href="cliente.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profissional.php">Profissionais</a>
                    </li>
                    <li class="nav-item active">
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
                    <a class="nav-link text-danger" href="sair.php">Sair</a>
                </span>
            </div>
        </nav>
        <!-- nav do menu -->

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        Adicionar Produto
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" action="valida_estoque.php" method="post">
                            <div class="form-group">
                                <h2 class="form-signin-heading">Adicione um produto ao estoque!</h2>
                            </div>
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Quantidade:</label>
                                <input class="form-control" type="number" name="qtd" id="qtd" placeholder="Quantidade" required>
                            </div>
                            <div class="form-group">
                                <label for="niver">Valor Unitário:</label>
                                <input class="form-control" type="number" name="valor_unitario" id="valor_unitario" placeholder="Valor Unitário" required>
                            </div>
                            <div class="form-group">
                                <label for="niver">Valor Total:</label>
                                <input class="form-control" type="number" name="valor_total" id="valor_total" placeholder="Valor Total" required>
                            </div>
                            <div class="form-group">
                                <label for="niver">Validade:</label>
                                <input class="form-control" type="date" name="validade" id="validade" placeholder="Validade" required>
                            </div>
                            <div class="form-group">
                                <label for="niver">Data de Entrada:</label>
                                <input class="form-control" type="date" name="entrada" id="entrada" placeholder="Data de Entrada" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Salvar">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                
                    </div>
                </div>
            </div>
        </div>
        <!-- corpo da página -->
        <!-- tabela com lista de produtos cadastrados -->
        <?php
            $result_produto = "SELECT * FROM produto";
            $resultado_produto = mysqli_query($conn, $result_produto);
        ?>
        <table class="table table-hover">
            <thead>
                <tr>  
                <th scope="col">ID</th>                              
                <th scope="col">Nome</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Valor Unitário</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Validade</th>
                <th scope="col">Data de Entrada</th>
                <th scope="col">Editar</th>
                <th scope="col">Apagar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row_produto = mysqli_fetch_assoc($resultado_produto)){ ?>
                        <tr> 
                            <td><?php echo $row_produto['id'] ?></td>                     
                            <td><?php echo $row_produto['nome_produto'] ?></td>
                            <td><?php echo $row_produto['quantidade'] ?></td>
                            <td><?php echo $row_produto['valor_unitario']?></td>
                            <td><?php echo $row_produto['valor_total']?></td>
                            <td><?php echo $row_produto['validade'] ?></td>
                            <td><?php echo $row_produto['data_entrada']?></td>
                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal_editar" 
                            data-whatever="<?php echo $row_produto['id'] ?>" 
                            data-whatevernome="<?php echo $row_produto['nome_produto'] ?>" 
                            data-whateverquantidade="<?php echo $row_produto['quantidade'] ?>"
                            data-whateverunitario="<?php echo $row_produto['valor_unitario'] ?>" 
                            data-whatevertotal="<?php echo $row_produto['valor_total'] ?>"
                            data-whatevervalidade="<?php echo $row_produto['validade'] ?>" 
                            data-whateverentrada="<?php echo $row_produto['data_entrada'] ?>">Editar</button></td>
                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm">Apagar</button></td>
                        </tr>
                <?php } ?> 
            </tbody>
        </table>
        <!-- modal de confirmação de deleção -->
        <div class="modal fade" id="confirm" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                <div class="modal-body">
                    <p> Deseja relamente apagar o produto?</p>
                </div>
                <div class="modal-footer">
                    <a href="deleta_estoque.php?id=<?php echo $row_produto['id']?> "><button type="button" class="btn btn-danger" id="delete" >Apagar Registro</button></a>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
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
                        <form action="edita_produto.php" method="POST">
                            <input type="hidden" name="id" id="id_produto">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" id="recipient-name" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Quantidade:</label>
                                <input type="number" class="form-control" id="recipient-quantidade" name="quantidade">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Valor Unitário:</label>
                                <input type="number" class="form-control" id="recipient-valor_unitario" name="valor_unitario">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Valor Total:</label>
                                <input type="number" class="form-control" id="recipient-valor_total" name="valor_total">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Validade:</label>
                                <input type="date" class="form-control" id="recipient-validade" name="validade">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Data de Entrada:</label>
                                <input type="date" class="form-control" id="recipient-entrada" name="entrada">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" >Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
            /* função para buscar dados do produto e editar */
            $('#modal_editar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Botão que acionou o modal
                var recipient = button.data('whatever') // Extrai informação dos atributos data-*
                var recipient_nome = button.data('whatevernome')
                var recipientt_quantidade = button.data('whateverquantidade')
                var recipient_valor_unitario = button.data('whateverunitario')
                var recipient_valor_total = button.data('whatevertotal')
                var recipient_validade = button.data('whatevervalidade')
                var recipient_entrada = button.data('whateverentrada')
                // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
                // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
                var modal = $(this)
                modal.find('.modal-title').text('ID do produto ' + recipient)
                modal.find('#id_produto').val(recipient)
                modal.find('#recipient-name').val(recipient_nome)
                modal.find('#recipient-quantidade').val(recipientt_quantidade)
                modal.find('#recipient-valor_unitario').val(recipient_valor_unitario)
                modal.find('#recipient-valor_total').val(recipient_valor_total)
                modal.find('#recipient-validade').val(recipient_validade)
                modal.find('#recipient-entrada').val(recipient_entrada)
            })
        </script>
    </body>
</html>