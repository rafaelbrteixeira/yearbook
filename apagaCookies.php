<?php
 /*  foreach($_COOKIE as $nome=>$valor){
         setcookie($nome, "", time()-1000);   //apaga todos os cookies disponíveis para este domínio
	 }*/

   if (isset($_COOKIE["logado"])) {
    setcookie("logado", "", time() - 1000);
}
?>

<HTML>
<HEAD>
 <TITLE>Verificando login...</TITLE>
 <link rel="STYLESHEET" href="../css/sisCookie.css" type="text/css" />
 <meta http-equiv="refresh" content="2; url=./index.php" />
</HEAD>
<BODY>
<div class="aviso">
    Cookies apagados ...
</div>
</BODY>
</HTML>