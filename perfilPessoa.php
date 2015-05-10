<?php
session_start();
require_once("./conf/confBD.php");
require_once("./modelos/cabecalho.php");

require_once("./class/Pessoa.class.php");


if (isset($_SESSION['id'])) {
    $IdUser = $_SESSION['id'];
} else {
    $IdUser = 0;
}

$conexao = conn_mysql();


$SQLSelect = 'SELECT P.*,C.idCidade,C.nomeCidade,E.nomeEstado FROM participantes P '
        . 'left join cidades C on (P.cidade = C.idCidade) '
        . 'left join estados E on (E.idEstado = C.idEstado) '
        . 'WHERE login=?';

$operacao = $conexao->prepare($SQLSelect);
$pesquisar = $operacao->execute(array($IdUser));
$resultados = $operacao->fetchAll();

$pessoa = new Pessoa();
if (isset($resultados[0])) {
    $pessoa->setLogin(utf8_decode($resultados[0]['login']));
    $pessoa->setSenha(utf8_decode($resultados[0]['senha']));
    $pessoa->setNome(utf8_decode($resultados[0]['nomeCompleto']));
    $pessoa->setDescricao(utf8_decode($resultados[0]['descricao']));
    $pessoa->setCidade(utf8_decode($resultados[0]['nomeCidade']));
    $pessoa->setEstado($resultados[0]['nomeEstado']);
    $pessoa->setFoto(utf8_decode($resultados[0]['arquivoFoto']));
    $pessoa->setEmail(utf8_decode($resultados[0]['email']));
}
?>

<div class="container">
    <div class="page-header">
        <header> 
            <p>Aluno do curso em Desenvolvimento de Sistemas para Web </p>
        </header>
    </div>

    <main>
        <section>
            <div itemscope itemtype="http://schema.org/Person" class="container">                  
                <div class="row">  
                    <div class="col-md-4">
                        <figure>
                            <img id="imgPerfil" src="<?php echo "img/" . $pessoa->getFoto() ?>" alt="<?php echo $pessoa->getNome() ?>"
                        </figure>                    
                    </div>                   

                    <div class="col-md-8">
                        <div class="jumbotron">
                            <legend>Perfil</legend>                    
                            <h2><span class="label label-default"><span itemprop="name"><?php echo $pessoa->getNome() ?></span></span></h2>                    
                            <div>
                                <label class="subtittle" for="cidade">Cidade:</label>
                                <label id="cidade"><?php echo $pessoa->getCidade() . " - " . $pessoa->getEstado(); ?></label>
                            </div>

                            <div>
                                <label class="subtittle" for="email">Email:</label>
                                <label id="email"><?php echo $pessoa->getEmail(); ?></label>
                            </div>

                            <div>
                                <div>  
                                    <em>
                                        <label id="descrPerfil"><?php echo $pessoa->getDescricao(); ?></textarea>
                                    </em>
                                </div>   

                                <button type="button" onclick="history.go(-1);" class="btn btn-primary btn-sm">Voltar</button> 
                            </div>
                        </div>
                    </div>      
            </div>
        </section>
    </main>  
</div>

<?php
require_once("./modelos/rodape.html");
?>