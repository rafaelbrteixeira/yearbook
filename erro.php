<?php
require_once("./modelos/cabecalho.php");

if (isset($_GET['code'])) {
    $CodError = $_GET['code'];
} else {
    $CodError =0;            
}
?>

<div class="content">
    <header> 
        <p>Aviso de erro</p>   
    </header>

    <main>  

        <section>
            <div class="error"> 
                <p>
                    <?php
                    switch ($CodError) {
                        case 0: echo "Erro não identificado";
                            break;
                        case 1000: echo "Erro ao editar Usuário (Code: 1000)";
                            break;
                    }
                    ?>
                </p>
                
                  <button type="button" onclick="history.go(-1);" class="btn-style">Voltar</button>
            </div>
        </section>
      
    </main> 
</div>



<?php
require_once("./modelos/rodape.html");
?>