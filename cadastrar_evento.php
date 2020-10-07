<?php 

        include "conexao.php";
                            
      echo   $nome = $_POST["nome"];
      echo   $data = $_POST["data"];
        
     echo    $query = "INSERT INTO 'eventos' ('title', 'start') VALUES ('$nome', '$data')";
        
        $exec = $conexao->exec($query);                         
        
        if($exec){            
            echo "1";     
        }
        else{
            echo "0";
        }
       
       
?>