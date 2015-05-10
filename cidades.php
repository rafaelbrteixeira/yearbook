<?php
require_once("./conf/confBD.php");
$idestado = $_GET['estado'];

$conexao = conn_mysql();
$SQLSelect = 'select * from cidades where idEstado =?';

                  $operacao = $conexao->prepare($SQLSelect);
                  $pesquisar = $operacao->execute(array($idestado));
                  $resultados = $operacao->fetchAll();

                 foreach ($resultados as $p) {
                   echo "<option value='".$p['idCidade']."'>".$p['nomeCidade']."</option>";
                 }    

?>
