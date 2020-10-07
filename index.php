<? 
include 'conexao.php';
// Definir a zona geográfica padrão.
date_default_timezone_set("America/Sao_Paulo");
$data_incio = mktime(0, 0, 0, date('m')+1 , 2 , date('Y')) ;
$nome="irismar menezes Silva";
$id_user="2";
// Pegar o último dia.
$P_Dia = date("Y-m-01");
$U_Dia = date("Y-m-t");
$umDia = new DateInterval('P1D'); // Intervalo de 1 dia
// Com DateTime:
$hoje = new DateTime();
$hoje->format('d/m'); // Saída 20/03
$hoje->add($umDia); // Altera o valor de $hoje
$hoje->format('d/m'); // Saída 21/03
///print "Teste de Data Inicial :: " . $P_Dia . "<br>";
///print "Teste de Data Final :: " . $U_Dia . "<br>";
$minha_data =  date('Y/m/d',$data_incio );echo "<br>";
 
// Instância um objeto DateTime passando uma data como parâmetro
$date = new DateTime($minha_data);
 
// Adicionar 10 dias na data passada no construtor
$date->add(new DateInterval('P1D'));
 
// Exibe a nova data
 $date->format('d-m-Y');echo "<br>";
 
// Imprime 2017-10-31

//echo date('d/m/Y h:i:s',$data_incio);echo "<br>";
$data_fim = mktime(23, 59, 59, date('m')+2, date('d')-date('j'), date('Y'));
echo $data_fim=  date('Y-m-d ',$data_fim);echo "<br>";
////////////////////////////////////////////////
//include 'exibir_escalas.php';
 /////exibir escals /////////////////////
 $stmt = $conexao->prepare("SELECT * FROM eventos
WHERE data BETWEEN '2020-09-01' AND '2020-10-30' AND id_user='2' ");
 
        if ($stmt->execute()) {
          /* Return number of rows that were deleted */

$count = $stmt->rowCount();
print("numero de plantões  $count .\n");
}

////se não tiver plantões castrados cadastrar//////////////////////

if($count < 10){  
///////////////// não executar registro se houver mais de 10/////
 $numero = 1;
$date = new DateTime($minha_data);
//$turno='D';
    while($numero<=11){

        /////pegar primeiro dia da escala 
        if(!isset($turno)){
        echo $data=$date->format('Y-m-d');echo "<br>";
        echo "D";echo "<br>";
        $turno='D';
           $numero++;
        

   
    
     /////////////adicionar dia////////////////////
       
    try { 
        $stmt = $conexao->prepare("INSERT INTO eventos(nome, data,id_user,turno) VALUES (?, ?,?,?)");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $data);
        $stmt->bindParam(3, $id_user);
        $stmt->bindParam(4, $turno);
        
         
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }

     //////////////////////////////////////////////      

           if ($numero > 10) {
             $stop_insert=true; ///para de executar a consuta se ja foi cadastrado 
              break;
              //mudar turno para noite ///////
              $turno='N';
            }
             }
        if($turno='N'){
        $date->add(new DateInterval('P1D'));    
        $data= $date->format('Y-m-d');echo "<br>";
        echo "N";echo "<br>";
           $numero++; 
         /////////////adicionar dia////////////////////
       
    try { 
        $stmt = $conexao->prepare("INSERT INTO eventos(nome, data,id_user,turno) VALUES (?, ?,?,?)");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $data);
        $stmt->bindParam(3, $id_user);
        $stmt->bindParam(4, $turno);
        
         
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }

     //////////////////////////////////////////////      
        if ($numero > 10) {
            $stop_insert=true;
        break;
           }

        $date->add(new DateInterval('P5D'));    
        echo$data= $date->format('Y-m-d');echo "<br>";
        echo "D";echo "<br>";
        $turno='D';
           $numero++;
         /////////////adicionar dia////////////////////
       
    try { 
        $stmt = $conexao->prepare("INSERT INTO eventos(nome, data,id_user,turno) VALUES (?, ?,?,?)");
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $data);
        $stmt->bindParam(3, $id_user);
        $stmt->bindParam(4, $turno);
        
         
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
               throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }

     //////////////////////////////////////////////      
           if ($numero > 10) {
             $stop_insert=true;
        break;
    }
        }
         // Adicionar 10 dias na data passada no construtor
        
        //$date->add(new DateInterval('P1D'));
        // Exibe a nova data
        //echo $date->format('d-m-Y');echo "<br>";
        //echo $numero;echo "<br>";

     
    } 

} ////não realizar casatro se maior de 10 plantoes mes 
try {
 

 
        if ($stmt->execute()) {
          /* Return number of rows that were deleted */
print("Return number of rows that were deleted:\n");
$count = $stmt->rowCount();
print("Deleted $count rows.\n");
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>".$rs->nome."</td><td>".$rs->data."&nbsp;&nbsp;"."</td><td>".$rs->id_user
                           ."&nbsp;&nbsp;"."</td><td><center><a href=\"\">[Alterar]</a>"
                           ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                           ."<a href=\"\">[Excluir]</a></center></td>";
                echo "</tr>";
            }
        } else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}
?>