<?php

if(isset($_COOKIE['loginAutomatico'])){
   header("Location: ./VerificarLogin.php");
}
else if(isset($_COOKIE['user']))
	$nomeUser = $_COOKIE['user'];
else $nomeUser="";
	
require_once("./modelos/cabecalho.php");
?>

   <div class="content">
    <header> 
        <p>Autenticação de Usuário</p>   
    </header>

       <main>  
           <section>          
                   <form role="form" method="post" action="./verificarLogin.php">
                       <div class="container" id="form_login">
                           <div class="form-group">
                               <input type="text" class="form-control" placeholder="Login" name="login" value="<?php echo $nomeUser ?>"required autofocus>
                           </div>

                           <div class="form-group">
                               <input type="password" class="form-control" placeholder="Senha" name="passwd" required>
                           </div>

                           <div>
                               <button class="btn btn-primary btn-sm" type="submit">Entrar</button>                  
                               <button class="btn btn-primary btn-sm" type="button" onclick="javascript:window.location.href='./configPessoa.php'">Cadastrar-se</button>
                           </div> 

                           <p class="label_field_pair">                       
                               <input id="foo" type="checkbox" name="lembrarLogin" value="loginAutomatico"/> 
                               <label for="foo">Permanecer conectado</label>
                           </p>


                           <?php
                           if (isset($_GET['error']) && $_GET['error'] = true)
                               echo "<p style='color:red'>Login e/ou senha incorretos.</p>";
                           ?>
                       </div> 
                   </form>              
           </section>
       </main> 
   </div>

<?php
  require_once("./modelos/rodape.html");
?>