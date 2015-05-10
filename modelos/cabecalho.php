<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>YearBook - Pós Graduação</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/style.css" rel="stylesheet" type="text/css"> 
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">  

    
      
        <style>
            #infoUser 
            {
                width:400px;

            }

            #topo{margin: 5px auto;}

            #logo{
                width:150px;
                height: 120px;
                margin: 2px 2px;
            }

            #top{border: thin solid none;
                 padding: 0.5em 1em;
                 text-align: center;
                 border-radius:1em ;
                 background-color: white;}

            #top p{
                font-size: 2.0em;
            }

        </style>

    </head>

    <body>       

        <div class="container">
            <div >

                <div class="row">
                    <div class="col-sm-3 col-md-2 hidden-xs">
                        <img src="css/img/pucminas_virtual.jpg" id="logo">
                    </div>

                    <div class="col-sm-6 col-md-6">  
                        <h3>Pós Graduação - PUC Minas</h3>
                        <p>Especialização em Desenvolvimento de Sistemas para Web</p> 
                    </div>
                </div>

                <div class="pull-right hidden-xs">   
                    <?php
                    if (isset($_SESSION['auth']) || (!empty($_SESSION['userName']))) {
                        echo "<p>Seja Bem Vindo(a)<br/>" . utf8_decode($_SESSION['userName']) . "</p>";
                    } else {
                        echo "<p>Deseja Participar? <a href=\"configPessoa.php\">Cadastrar</a></p> ";
                    }
                    ?> 
                </div> 
            </div>    
        </div>

               
        <div class="navbar navbar-static-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   
                </div>
                    <div class="collapse navbar-collapse">
                      <ul class="nav navbar-nav"> 
                            <li class="active">
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="participantes.php">Participantes</a>
                            </li>

                            <li>
                                <?php
                                if (isset($_SESSION['auth']) || (!empty($_SESSION['userName']))) {
                                    echo "<a href=\"logout.php\">Sair</a> ";
                                } else {
                                    echo "<a href=\"login.php\">Acessar</a> ";
                                }
                                ?>  
                            </li>
                        </ul>  
                    </div> 
            </div>
        </div>