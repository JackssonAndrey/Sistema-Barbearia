<?php
    session_start();
    include_once("verifica_login.php");
    include_once("conexao.php");
    $result_events = "SELECT * FROM events";
    $resultado_events = mysqli_query($conn, $result_events);
    $result_cliente = "SELECT * FROM cliente ORDER BY nome_cliente";
    $resultado_cliente = mysqli_query($conn, $result_cliente);
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agenda</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/estilo.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link href='css/fullcalendar.min.css' rel='stylesheet' />
    <link href='css/personalizado.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href='css/personalizado.css' rel='stylesheet' />
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
						$('#detalhes-evento #title').text(events.title);
						$('#detalhes-evento #start').text(events.start.format('DD/MM/YYYY HH:mm:ss'));
						$('#detalhes-evento #end').text(events.end.format('DD/MM/YYYY HH:mm:ss'));
						$('#detalhes-evento').modal('show');
						return false;
          },					
					selectable: true, //para selecionar o dia com o clique
					selectHelper: true, //para destacar e mostrar a hora do dia selecionado
					select: function(start, end){
						$('#cad-evento #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
						$('#cad-evento #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
						$('#cad-evento').modal('show');						
					},
					events: [
						<?php
							while($row_events = mysqli_fetch_array($resultado_events)){
								?>
								{
								id: '<?php echo $row_events['id']; ?>',
								title: '<?php echo $row_events['titulo']; ?>',
								start: '<?php echo $row_events['inicio']; ?>',
								end: '<?php echo $row_events['fim']; ?>',
								color: '<?php echo $row_events['cor']; ?>',
								},<?php
							}
						?>
					]
				});
			});
  </script>
  </head>
  <body id="body-painel">
    <!-- nav do menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="painel.php">Barbearia</a>  
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="painel.php">Agenda <span class="sr-only">(current)</span></a>
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
                    <a class="nav-link text-danger" href="sair.php">Sair</a>
                </span>
            </div>
        </nav>
        <!-- nav do menu -->  

   <!-- div da agenda com os horarios marcados e calendario ao lado-->
   <div class="container">
            <div class="row">
                <div class="col col-md-8 col-sm-8 col-xs-12 col-lg-8">
                <!-- inicio modal de cadastro de horario -->
                <div class="modal fade" id="cad-evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-center">Cadastrar Evento</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                         
                        </div>
                        <div class="modal-body">
                          <form class="form-horizontal" method="POST" action="proc_cad_evento.php">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" placeholder="Titulo do Evento">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                              <div class="col-sm-10">
                                <select name="color" class="form-control" id="color">
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
                                    while($row_cliente = mysqli_fetch_assoc($resultado_cliente)){ ?>
                                        <option value="<?php echo $row_cliente['id']?>"><?php echo $row_cliente['nome_cliente']?></option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>
                          
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- fim modal de cadastro de horario -->
                </div>
                <div id='calendar'></div>
            </div>
            <!-- Modal detalhes evento-->
            <div class="modal fade" id="detalhes-evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title text-center">Detalhes do Evento</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <dl class="dl-horizontal">
                          <dt>ID do Evento</dt>
                          <dd id="id"></dd>
                          <dt>Titulo do Evento</dt>
                          <dd id="title"></dd>
                          <dt>Inicio do Evento</dt>
                          <dd id="start"></dd>
                          <dt>Fim do Evento</dt>
                          <dd id="end"></dd>
                        </dl>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                      </div>
                  </div>
              </div>
            </div> 
            <!-- fim modal de detalhes do evento -->
        </div>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
  </body>
</html>
