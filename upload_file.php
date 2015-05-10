<?php  
$permissoes = array("jpeg", "jpg","image/jpeg", "image/jpg");  //strings de tipos e extensoes validas
$temp = explode(".", basename($_FILES["fileName"]["name"]));
$extensao = end($temp);

try{
    
if (!empty($_FILES["fileName"]["name"]))
{if ((in_array($extensao, $permissoes))
    && (in_array($_FILES["fileName"]["type"], $permissoes))
    && ($_FILES["fileName"]["size"] < $_POST["MAX_FILE_SIZE"]))
  {
  if ($_FILES["fileName"]["error"] > 0)
    {
     header("Location:./configPessoa.php?Cod=03");
     die();
    }
  else
    {
      $dirUploads = "./img/";
	 	  
	  if(!file_exists ( $dirUploads ))
			mkdir($dirUploads, 0500);  
	  
	  $caminhoUpload = $dirUploads;
	  if(!file_exists ( $caminhoUpload ))
			mkdir($caminhoUpload, 0700);  
			
          $pathCompleto = $caminhoUpload.$foto;
          
      if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $pathCompleto)) {
            header("Location:./configPessoa.php?Cod=03");
        } else {
            header("Location:./configPessoa.php?Cod=03");
            die();
        }
    }
  }
else
  {
   header("Location:./configPessoa.php?Cod=05");
   die();
  }
}
}catch (Exception $e) {
    echo "Erro!: " . $e->getMessage() . "<br>";
    header("Location:./configPessoa.php?Cod=05".$e->getMessage() );
}
?>