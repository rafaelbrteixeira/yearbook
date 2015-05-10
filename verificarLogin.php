<?php
session_start();
require_once("./conf/confBD.php");

      $autoLogin=false;
      if(isset($_COOKIE["loginAutomatico"])){ 	
          $user = utf8_encode(htmlspecialchars($_COOKIE["user"]));
          $senha = utf8_encode(htmlspecialchars($_COOKIE["loginAutomatico"]));
          $autoLogin=true;
      }    
      else 
      if(isset($_POST["login"])){		
         $user = utf8_encode(htmlspecialchars($_POST["login"]));
         $senha = utf8_encode(htmlspecialchars($_POST["passwd"]));
	
        if(isset($_POST["lembrarLogin"])){
	    $lembrar = utf8_encode(htmlspecialchars($_POST["lembrarLogin"]));
        }else{$lembrar="";}      
       } 
       else{
	 header("Location:./login.php?error=true");
         die();
       }   
          
     try{
		$conexao = conn_mysql();
                
                if ($autoLogin) {
                   $SQLSelect = 'SELECT * FROM participantes WHERE senha=? AND login=?';
                } else {
                   $SQLSelect = 'SELECT * FROM participantes WHERE senha=MD5(?) AND login=?';
                }

                 $operacao = $conexao->prepare($SQLSelect);					  
		 $pesquisar = $operacao->execute(array($senha,$user));
		 $resultados = $operacao->fetchAll();
		 $conexao = null;
		
				
		if (count($resultados)!=1){	
                    header("Location:./login.php?error=true");
                die();
		}else{ 
	           setcookie("user", $user, time()+60*60*24*90); 
		   if(!empty($lembrar)){
 	              setcookie("loginAutomatico",md5($senha),time()+60*60*24*90); 	
		   }
		   
                   $_SESSION['auth']=true;
		   $_SESSION['userName'] = $resultados[0]['nomeCompleto'];
		   $_SESSION['user'] = $user;
                   $_SESSION['senha'] = md5($senha);
                   
		   header("Location: ./index.php");
		   die();
	        }
	} 
        
	catch (PDOException $e)
	{		// caso ocorra uma exceção, exibe na tela
		echo "Erro!: " . $e->getMessage() . "<br>";
		die();
	}
?>