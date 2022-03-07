<?php

require_once('./conexao.php');



function create($alunos)
{

       try {

        $con = getConnection();

        $stmt = $con->prepare("INSERT INTO alunos(nome, email) VALUES (:nome , :email)");

        $stmt->bindParam(":nome", $alunos->nome);
        $stmt->bindParam(":email", $alunos->email);

        if ($stmt->execute()) {
            echo " Aluno Cadastrado com sucesso";
        }
    } catch (PDOException $error) {
        echo "Error ao cadastrar o aluno. Error: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}
function get()
  {
  #      try {
   #         $con = getConnection();
#
 #           $rs = $con->query("SELECT nome, email FROM alunos");
#
 #           while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
  #              echo $row->nome . "<br>";
   #             echo $row->email . "<br>";
    #        }
     #   } catch (PDOException $error) {
#            echo "Erro ao listar os alunos. Erro: {$error->getMessage()}";
 #       } finally {
  #          unset($con);
   #         unset($rs);
    #    }
    }
    function find($nome)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT nome, email FROM alunos WHERE nome LIKE :nome");

            $stmt->bindValue(":nome", "%{$nome}%");


            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome . "<br>";
                        echo $row->email . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar ao aluno '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }
    
    function update($alunos)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE alunos SET nome= :nome, email = :email WHERE id = :id");

            $stmt->bindParam(":id", $alunos->id);
            $stmt->bindParam(":nome", $alunos->nome);
            $stmt->bindParam(":email", $alunos->email);

            if ($stmt->execute())
                echo "Aluno atualizado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar o aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function delete($id)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM alunos WHERE id = ?");
            $stmt->bindParam(1, $id);

            if ($stmt->execute())
                echo "Aluno deletado com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar aluno. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

#create test - Adicionar o João
$alunos = new stdClass();
$alunos->nome = "João";
$alunos->email = "joao@senac.com.br";
create($alunos);

echo "<br><br>--------------------<br><br>";
echo "<br><br>--------------------<br><br>";


#get test
    get();

    echo "<br><br>--------------------<br><br>";
    echo "<br><br>--------------------<br><br>";


#teste do find
    find("João");

#teste upgrade - Fará a troca do Bruno por Fernanda 
    $alunos = new stdClass();   
     $alunos->nome = "Fernanda";
     $alunos->email = "fernanda@senac.com.br";
     $alunos->id = 1;
     update($alunos); 
    
#get test
    echo "<br><br>--------------------<br><br>";
    echo "<br><br>--------------------<br><br>";


    get();
#delete test


echo "<br><br>--------------------<br><br>";
echo "<br><br>--------------------<br><br>";

    delete(4); #apagará a aluna Celia

    echo "<br><br>--------------------<br><br>";
    echo "<br><br>--------------------<br><br>";
 get();