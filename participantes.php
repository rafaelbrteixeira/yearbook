<?php
require_once("./authSession.php");

require_once("./conf/confBD.php");
require_once("./modelos/cabecalho.php");

require_once("./class/Pessoa.class.php");
require_once("./class/Participante.class.php");

try {
    if (isset($_POST['filtro'])) {
        $filtro = $_POST['filtro'];
    }else
    {$filtro = "";}

    $conexao = conn_mysql();
    $SQLSelect = "SELECT P.*,C.idCidade,C.nomeCidade,E.siglaEstado FROM participantes P "
                           . "left join cidades C on (P.cidade = C.idCidade) "
                           . "left join estados E on (E.idEstado = C.idEstado) "
                           . "where P.nomeCompleto like (?) "
                           . "order by updtreg";

    $operacao = $conexao->prepare($SQLSelect);
    $operacao->execute(array("%".$filtro."%"));
     
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
        $pessoa->setFoto("img/".utf8_decode($p['arquivoFoto']));

        $participantes->addPessoa($pessoa);
    }
    
} catch (PDOException $e) {
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>       

<div class="container">
    <div class="page-header">
        <header> 
            <p>Todos os Participantes do YearBook</p>   
        </header>
    </div>

    <main>  
        <section>    
            <form class="form " role="form" method="post" action="./participantes.php">
                <div class="form-group">
                    Buscar: <input type="text" placeholder="Nome" name="filtro" value="<?php echo $filtro; ?>">
                    <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                </div>
            </form>

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