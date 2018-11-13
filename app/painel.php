<?php
    session_start();
    include_once("verifica_login.php");
?>

<!DOCTYPE html>
<html lang='pt-br'>
     <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Agenda</title>
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/estilo.css">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
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
                defaultDate: '2018-03-12',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                    title: 'All Day Event',
                    start: '2018-03-01',
                    },
                    {
                    title: 'Long Event',
                    start: '2018-03-07',
                    end: '2018-03-10'
                    },
                    {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-03-09T16:00:00'
                    },
                    {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-03-16T16:00:00'
                    },
                    {
                    title: 'Conference',
                    start: '2018-03-11',
                    end: '2018-03-13'
                    },
                    {
                    title: 'Meeting',
                    start: '2018-03-12T10:30:00',
                    end: '2018-03-12T12:30:00'
                    },
                    {
                    title: 'Lunch',
                    start: '2018-03-12T12:00:00'
                    },
                    {
                    title: 'Meeting',
                    start: '2018-03-12T14:30:00'
                    },
                    {
                    title: 'Happy Hour',
                    start: '2018-03-12T17:30:00'
                    },
                    {
                    title: 'Dinner',
                    start: '2018-03-12T20:00:00'
                    },
                    {
                    title: 'Birthday Party',
                    start: '2018-03-13T07:00:00'
                    },
                    {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2018-03-28'
                    }
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
                    <a class="nav-link text-danger" href="sair.php">Sair</a>
                </span>
            </div>
        </nav>
        <!-- nav do menu -->
        <!-- div da agenda com os horarios marcados e calendario ao lado-->
        <div class="container">
            <div class="row">
                <div class="col col-md-8 col-sm-8 col-xs-12 col-lg-8">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Agendar Horário
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Agendar Horário</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
                <div id='calendar'></div>
            </div>
        </div>
        
        <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </body>
</html>