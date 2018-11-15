<?php
    session_start();
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
                    <li class="nav-item active">
                        <a class="nav-link" href="cliente.php">Clientes</a>
                    </li>
                    <li class="nav-item">
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

        <div class="container-fluid">
            <div class="row">
                
                <div class="col col-sm-12 col-md-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                   <img id="img-btn" src="imagens/add-user.png">Adicionar Cliente</button>
                    

                    <!-- Modal para adicionar cliente -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-signin" action="valida_cliente.php" method="post">
                                        <div class="form-group">
                                            <h2 class="form-signin-heading">Adicione um cliente!</h2>
                                        </div>
                                        <div class="form-group">
                                            <label for="nome">Nome:</label>
                                            <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input class="form-control" type="email" name="email" id="email" placeholder="E-mail" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="niver">Aniversário:</label>
                                                <input class="form-control" type="date" name="niver" id="niver" placeholder="Aniversário" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tel">Telefone:</label>
                                                <input class="form-control" type="number" name="tel" id="tel" placeholder="Telefone" required>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <label>Sexo:</label>                                            
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="Masculino">
                                            <label class="form-check-label" for="sexoM">Masculino</label>                                            
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="Feminino">
                                            <label class="form-check-label" for="sexoF">Feminino</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Obrservações:</label>
                                            <textarea class="form-control" name="obs" id="obs" cols="30" rows="10" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Como nos conheceu:</label>
                                            <input class="form-control" type="text" name="conheceu" id="conheceu" placeholder="Como nos conheceu" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rua">Rua:</label>
                                            <input class="form-control" type="text" name="rua" id="rua" placeholder="Nome da rua" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="bairro">Bairro:</label>
                                                <input class="form-control" type="text" name="bairro" id="bairro" placeholder="Nome do bairro" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="num_casa">Número:</label>
                                                <input class="form-control" type="text" name="num_casa" id="num_casa" placeholder="Número da casa" required>
                                            </div>
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
                    <?php
                        $result_cliente = "SELECT * FROM cliente";
                        $resultado_cliente = mysqli_query($conn, $result_cliente);
                    ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>  
                                <th scope="col">ID</th>                              
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Aniversário</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Apagar</th>
                                <th scope="col">Ver mais</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($row_cliente = mysqli_fetch_assoc($resultado_cliente)){ ?>
                               <tr> 
                                    <td><?php echo $row_cliente['id'] ?></td>                     
                                    <td><?php echo $row_cliente['nome_cliente'] ?></td>
                                    <td><?php echo $row_cliente['telefone_cliente'] ?></td>
                                    <td><?php echo $row_cliente['email_cliente'] ?></td>
                                    <td><?php echo $row_cliente['aniversario_cliente'] ?></td>
                                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal_editar" data-whatever="<?php echo $row_cliente['id'] ?>" 
                                    data-whatevernome="<?php echo $row_cliente['nome_cliente'] ?>" data-whatevertelefone="<?php echo $row_cliente['telefone_cliente'] ?>"
                                    data-whateveremail="<?php echo $row_cliente['email_cliente'] ?>" data-whateveraniversario="<?php echo $row_cliente['aniversario_cliente'] ?>"
                                    data-whateverconheceu="<?php echo $row_cliente['como_conheceu'] ?>" data-whateverobs="<?php echo $row_cliente['observacoes'] ?>"
                                    data-whateversexo="<?php echo $row_cliente['sexo'] ?>" data-whateverrua="<?php echo $row_cliente['rua'] ?>" data-whateverbairro="<?php echo $row_cliente['bairro'] ?>"
                                    data-whatevernumero="<?php echo $row_cliente['numero'] ?>"><img id="img-btn" src="imagens/pen.png" alt=""></button></td>
                                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm"><img src="imagens/delete.png" id="img-btn" alt=""></button></td>
                                    <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal_detalhes <?php echo $row_cliente['id'] ?>"><img src="imagens/btn-details.png" id="img-btn" alt=""></button></td>
                                </tr>
                                <!-- modal de confirmação de deleção -->
                                <div class="modal fade" id="confirm" role="dialog">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <p> Deseja relamente apagar o usuário?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="deleta_cliente.php?id=<?php echo $row_cliente['id']?> "><button type="button" class="btn btn-danger" id="delete" ><img src="imagens/success.png" id="img-btn" alt=""> Apagar Registro</button></a>
                                            <button type="button" data-dismiss="modal" class="btn btn-default"><img src="imagens/delete-button.png" id="img-btn" alt="">Cancelar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal detalhes cliente-->
                                <div class="modal fade" id="modal_detalhes <?php echo $row_cliente['id']?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $row_cliente['nome_cliente'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body modal-xl">
                                                <p><?php echo $row_cliente['id'] ?></p>
                                                <p><b>Nome do cliente</b></p>
                                                <p><?php echo $row_cliente['nome_cliente'] ?></p><hr>
                                                <p><b>Telefone</b></p>
                                                <p><?php echo $row_cliente['telefone_cliente'] ?></p><hr>
                                                <p><b>E-mail</b></p>
                                                <p><?php echo $row_cliente['email_cliente'] ?></p><hr>
                                                <p ><b>Aniversário</b></p>
                                                <p ><?php echo $row_cliente['aniversario_cliente'] ?></p><hr>
                                                <p ><b>Como nos conheceu</b></p>
                                                <p ><?php echo $row_cliente['como_conheceu'] ?></p><hr>                                               
                                                <p><b>Observações</b></p>
                                                <p><?php echo $row_cliente['observacoes'] ?></p><hr>
                                                <p><b>Sexo</b></p>
                                                <p><?php echo $row_cliente['sexo'] ?></p><hr>
                                                <p><b>Rua</b></p>
                                                <p><?php echo $row_cliente['rua'] ?></p><hr>
                                                <p><b>Bairro</b></p>
                                                <p><?php echo $row_cliente['bairro'] ?></p><hr>
                                                <p><b>Número</b></p>
                                                <p><?php echo $row_cliente['numero'] ?></p><hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?> 
                        </tbody>
                    </table>
            </div>
        </div>
        <!-- modal para editar as informaçoes do cliente -->
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
                        <form action="edita_cliente.php" method="POST">
                            <input type="hidden" name="id" id="id_cliente">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" id="recipient-name" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Telefone:</label>
                                <input type="number" class="form-control" id="recipient-telefone" name="telefone">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">E-mail:</label>
                                <input type="text" class="form-control" id="recipient-email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Aniversário:</label>
                                <input type="date" class="form-control" id="recipient-aniversario" name="aniversario">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Como nos conheceu:</label>
                                <input type="text" class="form-control" id="recipient-conheceu" name="conheceu">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Observações:</label>
                                <textarea class="form-control" id="message-obs" name="obs"></textarea>
                            </div>
                            <div class="form-check">
                                <label>Sexo:</label>                                            
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="Masculino">
                                <label class="form-check-label" for="sexoM">Masculino</label>                                            
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="Feminino">
                                <label class="form-check-label" for="sexoF">Feminino</label>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Rua:</label>
                                <input type="text" class="form-control" id="recipient-rua" name="rua">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Bairro:</label>
                                <input type="text" class="form-control" id="recipient-bairro" name="bairro">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Número:</label>
                                <input type="text" class="form-control" id="recipient-numero" name="numero">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" ><img src="imagens/save-button.png" id="img-btn" alt=""> Salvar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><img src="imagens/delete-button.png" id="img-btn" alt=""> Cancelar</button>
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
                var recipient_email = button.data('whateveremail')
                var recipient_aniversario = button.data('whateveraniversario')
                var recipient_conheceu = button.data('whateverconheceu')
                var recipient_obs = button.data('whateverobs')
                var recipient_sexo = button.data('whateversexo')
                var recipient_rua = button.data('whateverrua')
                var recipient_bairro = button.data('whateverbairro')
                var recipient_numero = button.data('whatevernumero')
                // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
                // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
                var modal = $(this)
                modal.find('.modal-title').text('ID do cliente ' + recipient)
                modal.find('#id_cliente').val(recipient)
                modal.find('#recipient-name').val(recipient_nome)
                modal.find('#recipient-telefone').val(recipientt_telefone)
                modal.find('#recipient-email').val(recipient_email)
                modal.find('#recipient-aniversario').val(recipient_aniversario)
                modal.find('#recipient-conheceu').val(recipient_conheceu)
                modal.find('#message-obs').val(recipient_obs)
                modal.find('#recipient-sexo').val(recipient_sexo)
                modal.find('#recipient-rua').val(recipient_rua)
                modal.find('#recipient-bairro').val(recipient_bairro)
                modal.find('#recipient-numero').val(recipient_numero)
            })
        </script>
     </body>
</html>