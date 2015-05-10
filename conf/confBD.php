<?php
/*
  function conn_mysql(){

   $servidor = 'localhost';
   $porta = 3306;
   $banco = "daw_yearbook";
   $usuario = "daw-php";
   $senha = "1234";
   
      $conn = new PDO("mysql:host=$servidor;
	               port=$porta;
		       dbname=$banco",$usuario,$senha,
					   array(PDO::ATTR_PERSISTENT => true)
		 );
      return $conn;
   }

*/

 function conn_mysql(){

   $servidor = "us-cdbr-azure-northcentral-a.cleardb.com";
   $porta = 3306;
   $banco = "b123e63666dd52";
   $usuario = "b123e63666dd52";
   $senha = "a8f3beff";
   
      $conn = new PDO("mysql:host=$servidor;
	               port=$porta;
		       dbname=$banco",$usuario,$senha,
					   array(PDO::ATTR_PERSISTENT => true)
		 );
      return $conn;
   }
?>
