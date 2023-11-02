<?php
// Incluido o arquivo de conexão
include_once "conexao.php";

// Criando uma nova conexão
$conexao = new conexao();

// Declaração das variáveis
$task = (isset($_POST["description"])) ? $_POST["description"] : null;
$userId = (isset($_POST["userId"])) ? $_POST["userId"] : null;
$date = (isset($_POST["date"])) ? $_POST["date"] : null;
$time = (isset($_POST["time"])) ? $_POST["time"] : null;
$status = (isset($_POST["status"])) ? $_POST["status"] : null;
$id = (isset($_POST["id"])) ? $_POST["id"] : '';
$acao = (isset($_POST["acao"])) ? $_POST["acao"] : 1;

// Execuçào de diferentes operações com base na ação
if ($acao == 1) {
    if (empty($task)) {
        header("location: area/tasks.php?erro=1"); 
        exit; 
    }
    try {
        // prepara a consulta SQL com parâmetros
        $sqlCommand = "INSERT INTO tarefas (tarefa, data, hora, usuario_id, status) VALUES (:task, :date, :time, :userId, :status)";
        $stmt = $conexao->getPdo()->prepare($sqlCommand);

        // vincula os parâmetros
        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':status', $status);

        // executa a consulta
        $stmt->execute();

        // redireciona após a operação
        header("location: area/tasks.php?alert=1&limpa=1");
    } catch (PDOException $e) {
        echo $e;
    }
} else if ($acao == 2) {
    //defini o atributo status com feito (1) ou não (0)
    try {
        // prepara a consulta SQL com parâmetros
        $sqlCommand = "UPDATE tarefas SET status = :status WHERE id = :id";
        $stmt = $conexao->getPdo()->prepare($sqlCommand);

        // vincula os parâmetros
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        // executa a consulta
        $stmt->execute();

        // redireciona após a operação
        header("location: area/tasks.php?limpa=1");
    } catch (PDOException $e) {
        echo $e;
    }
} else if ($acao == 3) {
    //altera as informações da tarefa
    try {
        // Prepara a consulta SQL com parâmetros
        $sqlCommand = "UPDATE tarefas SET tarefa = :task, data = :date, hora = :time WHERE id = :id";
        $stmt = $conexao->getPdo()->prepare($sqlCommand);
    
        // Vincula os parâmetros
        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':id', $id);
    
        // Executa a consulta
        $stmt->execute();
    
        // Redireciona após a operação
        header("location: area/tasks.php?alert=2&limpa=1");
    } catch (PDOException $e) {
        echo $e;
    }
    
} else if ($acao == 4) {
    //remove a tarefa
    try {
        // Prepara a consulta SQL com parâmetros
        $sqlCommand = "DELETE FROM tarefas WHERE id = :id";
        $stmt = $conexao->getPdo()->prepare($sqlCommand);

        // Vincula o parâmetro
        $stmt->bindParam(':id', $id);

        // Executa a consulta
        $stmt->execute();

        // Redirecionar após a operação
        header("location: area/tasks.php?alert=3&limpa=1");
    } catch (PDOException $e) {
        echo $e;
    }
} else if ($acao == 5) {
    // Realiza pesquisa
    try {
        // Prepara a consulta SQL com parâmetros
        $sqlCommand = "SELECT * FROM tarefas WHERE usuario_id = $userId";

        if (!empty($task)) {
            $sqlCommand .= " AND tarefa LIKE '%$task%'";
        }

        if (!empty($date)) {
            $sqlCommand .= " AND data LIKE '%$date%'";
        }

        if (!empty($time)) {
            $sqlCommand .= " AND hora LIKE '%$time%'";
        }

        $stmt = $conexao->getPdo()->prepare($sqlCommand);

        // Executa a consulta
        $stmt->execute();

        session_start();
        $_SESSION['resultado'] = $stmt->fetchAll();

        header("location: area/tasks.php");
    } catch (PDOException $e) {
        echo $e;
    }
} else if($acao == 6){
    session_start();
    $_SESSION['resultado'] = null;
    header("location: area/tasks.php");
}

?>
