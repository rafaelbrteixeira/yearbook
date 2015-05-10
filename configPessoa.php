<?php
session_start();
require_once("./conf/confBD.php");
require_once("./modelos/cabecalho.php");

require_once("./class/Pessoa.class.php");
require_once("./class/ItemValue.class.php");
require_once("./class/Participante.class.php");



if (isset($_SESSION['id'])) {
    $IdUser = $_SESSION['id'];
} else {
    $IdUser = 0;
}

try {
    $conexao = conn_mysql();
    $participantes = new Participante();

    $SQLSelect = 'SELECT P.*,C.idCidade,C.idEstado,C.nomeCidade FROM participantes P '
            . 'left join cidades C on (P.cidade = C.idCidade) '
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
        $pessoa->setidCidade(utf8_decode($resultados[0]['idCidade']));
        $pessoa->setIdEstado(utf8_decode($resultados[0]['idEstado']));
        $pessoa->setFoto(utf8_decode($resultados[0]['arquivoFoto']));
        $pessoa->setEmail(utf8_decode($resultados[0]['email']));
    }

    $SQLSelect = 'select * from estados';

    $operacao = $conexao->prepare($SQLSelect);
    $pesquisar = $operacao->execute(array($IdUser));
    $resultados = $operacao->fetchAll();

    foreach ($resultados as $p) {
        $estados = new ItemValue();

        $estados->setId($p['idEstado']);
        $estados->setValue($p['siglaEstado']);
        $estados->setDescription($p['nomeEstado']);

        $participantes->addEstados($estados);
    }

    $conexao = null;
} catch (PDOException $e) {
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}
?>


<div class="container">
    <header> 
        <div class="page-header">
            <p>Aluno do curso em Desenvolvimento de Sistemas para Web </p>
        </div>
    </header>

    <main>
        <section>
            <div itemscope itemtype="http://schema.org/Person" class="container">  
                <form id="form" role="form" method="post" enctype="multipart/form-data" action="./gravaPessoa.php">

                    <div class="row"> 
                        <div class="col-md-4">
                            <figure>
                                <img id="imgPerfil" src="<?php echo "img/" . $pessoa->getFoto() ?>" alt="<?php echo $pessoa->getFoto() ?>">
                                <figcaption><?php echo $pessoa->getNome() ?></figcaption>
                            </figure>                    
                        </div>   

                        <div class="col-md-8">
                           <?php
                            if (isset($_GET['Cod'])) {
                                switch ($_GET['Cod']) {
                                    case '01':
                                        echo "<div style='color:red'>Senha incorretas.</div>";
                                        break;
                                    case '02':
                                        echo "<div style='color:red'>Atualização efetuada com sucesso!</div>";
                                        break;
                                    case '05':
                                        echo "<div style='color:red'>Arquivo para upload inválido!</div>";
                                        break;
                                }
                            }
                            ?>

                            <div class="form-group">
                                <label for="InputNome">Nome:</label>
                                <input type="text" class="form-control" id="InputNome" name="nome" required autofocus value="<?php echo $pessoa->getNome() ?>"/>
                            </div>

                            <div>
                                <label for="InputEstados">Estados:</label>
                                <select id="estados" name="estado">
                                <?php $participantes->exibeEstados($idEstado) ?>
                                </select>
                            </div>

                            <div>
                                <label for="InputCidades">Cidades:</label>
                                <select name="cidade" id="cidades">
                                    <?php
                                       if ($pessoa->getCidade() !== null) {
                                     ?>
                                        <option value="0"><?php echo $pessoa->getCidade(); ?></option> 
                                    <?php } else { ?>
                                        <option value="0">Escolha um estado</option> 
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="InputEmail">Email:</label>
                                <input type="email" class="form-control" id="InputEmail" name="email" required autofocus value="<?php echo $pessoa->getEmail() ?>"/>
                            </div>

                            <div class="form-group">
                                <label for="InputDescricao">Descrição:</label>
                                <textarea class="form-control" id="InputDescricao" name="descricao" required autofocus ><?php echo $pessoa->getDescricao() ?></textarea>
                            </div>

                            <fieldset> 
                                <?php if ($IdUser === 0) { ?>                    
                                    <legend>Login/Senha</legend>
                                    <div class="form-group">
                                        <label for="InputLogin">Login:</label>
                                        <input type="text" class="form-control" id="InputLogin" name="login" required autofocus style="width:200px;"/>
                                    </div>

                                <?php } else { ?>      
                                    <legend>Alterar Senha</legend>  
                                <?php } ?>

                                <div class="form-group">
                                    <label for="InputNewSenha">Senha:</label>
                                    <input class="form-control" type="password" id="InputNewSenha" name="newSenha" style="width:200px;" required autofocus
                                           value="<?php echo $pessoa->getSenha() ?>" onclick="document.getElementById('InputNewSenha').value = '';
                                                   document.getElementById('InputVerificaNewSenha').value = '';"/>
                                </div>

                                <div class="form-group">
                                    <label for="InputVerificaNewSenha">Confirme a Senha:</label>
                                    <input  class="form-control"  type="password" id="InputVerificaNewSenha" name="verificaNewSenha" required autofocus
                                            style="width:200px;" value="<?php echo $pessoa->getSenha() ?>"/>
                                </div>     
                            </fieldset>

                            <div class="form-group">
                                <label for="fileName">Foto: </label>
                                <input type="file" name="fileName" id="fileName" placeholder="Escolha um arquivo">
                                <input type="hidden" name="MAX_FILE_SIZE" value="500000" >
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="document.forms['form'].action = './configPessoa.php';
                                    document.forms['form'].submit();">Cancelar</button>
                            <button type="button" onclick="history.go(-1);" class="btn btn-primary btn-sm">Voltar</button>
                        </div>    
                    </div>  
                </form>                 
            </div>
        </section>
    </main>  
</div>

<?php
require_once("./modelos/rodape.html");
?>