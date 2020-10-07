<? try {
 
    $stmt = $conexao->prepare("SELECT * FROM eventos
WHERE data BETWEEN '2020-09-01' AND '2020-10-30' AND id_user='12' ");
 
        if ($stmt->execute()) {
          /* Return number of rows that were deleted */
print("Return number of rows that were deleted:\n");
$count = $stmt->rowCount();
print("Deleted $count rows.\n");
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>".$rs->nome."</td><td>".$rs->data."</td><td>".$rs->id_user
                           ."</td><td><center><a href=\"\">[Alterar]</a>"
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