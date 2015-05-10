<?php
  session_start();
  require_once("./conf/confBD.php");
  
  
  if(count($_POST)<7){
       header("Location:./erro.php");
       die();  
  }
  else{
      try {    
          
        $conexao = conn_mysql();

        $nome = utf8_encode(htmlspecialchars($_POST['nome']));
        $idEstado = utf8_encode(htmlspecialchars($_POST['estado']));
        $idCidade = utf8_encode(htmlspecialchars($_POST['cidade']));
        $email = utf8_encode(htmlspecialchars($_POST['email']));
        $descricao = utf8_encode(htmlspecialchars($_POST['descricao']));
        $login = utf8_encode(htmlspecialchars($_POST['login']));
        $senha = utf8_encode(htmlspecialchars($_POST['newSenha']));
        $verificaSenha = utf8_encode(htmlspecialchars($_POST['verificaNewSenha']));


        if (isset($_SESSION['user'])) {
            $foto = utf8_encode($_SESSION['user'] . '.jpg');
        } else {
            $foto = utf8_encode($_POST['login'] .'.jpg');
        }        
        require_once("./upload_file.php");
           
        if (!isset($_SESSION['senha']) || ($_SESSION['senha'] != $senha))
        {  if (empty($senha)) {
                   header("Location:./configPessoa.php?Cod=01");
                   die();
               }else
           
               if ($senha != $verificaSenha) {
                    header("Location:./configPessoa.php?Cod=01");
                    die();
               }
               else{ 
                   $senha= md5($senha);                 
                }  
         }
        else{
             $senha = $_SESSION['senha'];         
        }
               
        
        if (isset($_SESSION['user'])) {
            $SQLInsert = 'update participantes set nomeCompleto=?,cidade =?,email =?,descricao=?,senha=?,arquivoFoto=?,updtreg=now() '
                    . 'where login = ?';
            $operacao = $conexao->prepare($SQLInsert);
            $inserir = $operacao->execute(array($nome, $idCidade, $email, $descricao, $senha, $foto, $_SESSION['user']));

            $conexao = null;
            header("Location:./configPessoa.php?Cod=02");
        } else {
            $SQLInsert = 'insert into participantes (nomeCompleto,cidade,email,descricao,login,senha,arquivoFoto,updtreg) '
                    . 'values (?,?,?,?,?,?,?,now())';
            $operacao = $conexao->prepare($SQLInsert);
            $inserir = $operacao->execute(array($nome, $idCidade, $email, $descricao, $login, $senha, $foto));

            $conexao = null;
            header("Location:./login.php");
        }
        
    } catch (PDOException $e) {
        echo "Erro!: " . $e->getMessage() . "<br>";
        header("Location:./erro.php");
        die();
}
  }
?>