<?php
    session_start();
    include_once("verifica_login.php");
    include_once("conexao.php");
    $result_events = "SELECT * FROM events";
    $resultado_events = mysqli_query($conn, $result_events);
    $result_cliente = "SELECT * FROM cliente ORDER BY nome_cliente";
    $resultado_cliente = mysqli_query($conn, $result_cliente);
    $result_profissional = "SELECT * FROM profissional ORDER BY nome_profissional";
    $resultado_profissional = mysqli_query($conn, $result_profissional);
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agenda</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/estilo.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/personalizado.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='js/moment.min.js'></script>
    <script src='js/jquery.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script src='locale/pt-br.js'></script>
  <script>
  $(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listWeek'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
          eventLimit: true, // allow "more" link when too many events
          eventClick: function(events) {
            $('#detalhes-evento #id').text(events.id);
            $('#detalhes-evento #id').val(events.id);
            $('#detalhes-evento #title').text(events.title);
            $('#detalhes-evento #title').val(events.title);
            $('#detalhes-evento #preco_servico').text(events.preco);
            $('#detalhes-evento #preco_servico').val(events.preco);
            $('#detalhes-evento #cliente').text(events.cliente);
            $('#detalhes-evento #cliente').val(events.cliente);
            $('#detalhes-evento #profissional').text(events.profissional);
            $('#detalhes-evento #profissional').val(events.profissional);
            $('#detalhes-evento #inicio').text(events.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#detalhes-evento #inicio').val(events.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#detalhes-evento #fim').text(events.end.format('DD/MM/YYYY HH:mm:ss'));
            $('#detalhes-evento #fim').val(events.end.format('DD/MM/YYYY HH:mm:ss'));
            $('#detalhes-evento #cor').val(events.color);
						$('#detalhes-evento').modal('show');
						return false;
          },					
					selectable: true, //para selecionar o dia com o clique
					selectHelper: true, //para destacar e mostrar a hora do dia selecionado
					select: function(start, end){
						$('#cad-evento #inicio').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
						$('#cad-evento #fim').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
						$('#cad-evento').modal('show');						
					},
					events: [
						<?php
							while($row_events = mysqli_fetch_array($resultado_events)){
								?>
								{
								id: '<?php echo $row_events['id']; ?>',
								title: '<?php echo $row_events['servico']; ?>',
								start: '<?php echo $row_events['inicio']; ?>',
								end: '<?php echo $row_events['fim']; ?>',
                color: '<?php echo $row_events['cor']; ?>',
                cliente: '<?php echo  $row_events['nome_cliente']; ?>',
                profissional: '<?php echo  $row_events['nome_profissional']; ?>',
                preco: '<?php echo  $row_events['preco_servico']; ?>'
								},<?php
							}
						?>
					]
				});
      });
      //Mascara para o campo data e hora
			function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 00:00:00'){
					campo.value=""
				}
			 
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}
  </script>
  </head>
  <body id="body-painel">
    <!-- nav do menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="agenda.php">Barbearia</a> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
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

   <!-- div da agenda com os horarios marcados e calendario ao lado-->   
      <div class="container">
        <div class="page-header text-center">
            <h1>Agenda</h1>                    
        </div>
        <div id='calendar'></div>
      </div>
            
            <!-- inicio modal de cadastro de horario -->
            <div class="modal fade" id="cad-evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title text-center">Agendar Horário</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                         
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal" method="POST" action="valida_horario.php">
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Serviço</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Serviço a ser realizado">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Preço Serviço</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="preco_servico" id="preco_servico" placeholder="Valor do serviço">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                          <div class="col-sm-10">
                            <select name="cor" class="form-control" id="cor">
                              <option value="">Selecione</option>			
                              <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                              <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                              <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                              <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                              <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                              <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                              <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                              <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
                              <option style="color:#228B22;" value="#228B22">Verde</option>
                              <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
                          <div class="col-sm-10">
                            <select name="cliente" class="form-control" id="cliente" >
                              <option value="">Selecione</option>	
                              <?php
                                while($row_cliente = mysqli_fetch_assoc($resultado_cliente)){ ?>
                                    <option value="<?php echo $row_cliente['nome_cliente']?>"><?php echo $row_cliente['nome_cliente']?></option>
                                <?php }?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Profissional</label>
                          <div class="col-sm-10">
                            <select name="profissional" class="form-control" id="profissional">
                              <option value="">Selecione</option>	
                              <?php
                                while($row_profissional = mysqli_fetch_assoc($resultado_profissional)){ ?>
                                    <option value="<?php echo $row_profissional['nome_profissional']?>"><?php echo $row_profissional['nome_profissional']?></option>
                                <?php }?>
                            </select>
                          </div>
                        </div>
                                  
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="inicio" id="inicio" onKeyPress="DataHora(event, this)">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="fim" id="fim" onKeyPress="DataHora(event, this)">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><img id="img-btn" src="imagens/calendar-add-event-button-with-plus-sign.png" alt=""> Cadastrar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- fim modal de cadastro de horario -->
            </div>
                
            
            <!-- Modal detalhes evento-->
            <div class="modal fade" id="detalhes-evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-backdrop="static">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title text-center">Detalhes do horário</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="detalhes-evento">
                              <dl class="dl-horizontal">
                                  <dt>ID do Evento</dt>
                                  <dd id="id"></dd><hr>
                                  <dt>Serviço</dt>
                                  <dd id="title"></dd><hr>
                                  <dt>Preço do serviço</dt>
                                  <dd id="preco_servico"></dd><hr>
                                  <dt>Cliente</dt>
                                  <dd id="cliente"></dd><hr>
                                  <dt>Profissional</dt>
                                  <dd id="profissional"></dd><hr>
                                  <dt>Inicio do Evento</dt>
                                  <dd id="inicio"></dd><hr>
                                  <dt>Fim do Evento</dt>
                                  <dd id="fim"></dd>
                              </dl>
                              <button class="btn btn-editar btn-warning"><img id="img-btn"src="imagens/edit-event.png" alt=""> Editar</button>
                            </div>
                            <!-- div de editar horario -->
                            <div class="form-editar">
                              <form class="form-horizontal" method="POST" action="edita_horario.php">
                                  <input type="hidden" class="form-control" name="id" id="id">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Serviço</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="title" id="title" placeholder="Serviço a ser realizado">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Preço Serviço</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="preco_servico" id="preco_servico" placeholder="Valor do serviço">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                                <div class="col-sm-10">
                                  <select name="cor" class="form-control" id="cor">
                                    <option value="">Selecione</option>			
                                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                    <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                    <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
                                    <option style="color:#228B22;" value="#228B22">Verde</option>
                                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Cliente</label>
                                <div class="col-sm-10">
                                  <select name="cliente" class="form-control" id="cliente">
                                    <option value="">Selecione</option>	
                                    <?php
                                      while($row_clientes = mysqli_fetch_assoc($resultado_cliente)){ ?>
                                          <option value="<?php echo $row_cliente['nome_cliente']?>"><?php echo $row_cliente['nome_cliente']?></option>
                                      <?php }?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Profissional</label>
                                <div class="col-sm-10">
                                  <select name="profissional" class="form-control" id="profissional">
                                    <option value="">Selecione</option>	
                                    <?php
                                      while($row_profissional = mysqli_fetch_assoc($resultado_profissional)){ ?>
                                          <option value="<?php echo $row_profissional['nome_profissional']?>"><?php echo $row_profissional['nome_profissional']?></option>
                                      <?php }?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="inicio" id="inicio" onKeyPress="DataHora(event, this)">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fim" id="fim" onKeyPress="DataHora(event, this)">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-warning"><img id="img-btn" src="imagens/calendar-add-event-button-with-plus-sign.png"> Salvar Alterações</button>
                                  <button type="button" class="btn btn-canc-edit btn-primary"><img id="img-btn" src="imagens/cancel-event.png" alt=""> Cancelar</button>										
                                </div>
                              </div>
                            </form>
                          </div>
                        <!-- fim da de editar horario -->
                      </div>
                  </div>
              </div>
            </div> 
            <!-- fim modal de detalhes do evento -->
        <script>
          $('.btn-editar').on("click", function() {
            $('.detalhes-evento').slideToggle(); $('.form-editar').slideToggle();
           
          });
          $('.btn-canc-edit').on("click", function() {
           $('.form-editar').slideToggle(); $('.detalhes-evento').slideToggle();
            
          });
        </script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
