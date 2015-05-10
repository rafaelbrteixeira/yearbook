<?php
session_start();
require_once("./conf/confBD.php");
require_once("./modelos/cabecalho.php");

require_once("./class/Pessoa.class.php");
require_once("./class/Participante.class.php");

try {
    $conexao = conn_mysql();
    $SQLSelect = 'SELECT P.*,C.idCidade,C.nomeCidade,E.siglaEstado FROM participantes P '
                           . 'left join cidades C on (P.cidade = C.idCidade) '
                           . 'left join estados E on (E.idEstado = C.idEstado) '
                           . 'order by updtreg DESC Limit 8';

    $operacao = $conexao->prepare($SQLSelect);
    $operacao->execute();
     
    $resultados = $operacao->fetchAll();
    $conexao = null;

    $participantes = new Participante();
   
    foreach ($resultados as $p) {
        $pessoa = new Pessoa();

        $pessoa->setLogin(utf8_decode($p['login']));
        $pessoa->setSenha(utf8_decode($p['senha']));
        $pessoa->setNome(utf8_decode($p['nomeCompleto']));
        $pessoa->setDescricao(utf8_decode($p['descricao']));
        $pessoa->setCidade(utf8_decode($p['nomeCidade']));
        $pessoa->setEstado(utf8_decode($p['siglaEstado']));
        $pessoa->setFoto("./img/".utf8_decode($p['arquivoFoto']));

        $participantes->addPessoa($pessoa);
    }
    
} catch (PDOException $e) {
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>       

<div class="container">
    <header>        
        <section>
            <div class="page-header">
                <h1>YearBook</h1>
                <h2>Últimos participantes a aderir ou atualizar seu perfil</h2>         
            </div>
        </section>
    </header>

    <main>  
        <section> 
            <div class="container"> 
                <div class="row" id="listImg">
                    <?php
                      $participantes->exibeDados();
                    ?>                   
                </div>  
            </div>
        </section>
    </main>       
</div>
 
<?php
require_once("./modelos/rodape.html");
?>