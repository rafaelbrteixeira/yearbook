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

   $servidor = "mysql.hostinger.com.br";
   $porta = 3306;
   $banco = "u839744172_book";
   $usuario = "u839744172_daw";
   $senha = "uberaba";
   
      $conn = new PDO("mysql:host=$servidor;
	               port=$porta;
		       dbname=$banco",$usuario,$senha,
					   array(PDO::ATTR_PERSISTENT => true)
		 );
      return $conn;
   }
?>