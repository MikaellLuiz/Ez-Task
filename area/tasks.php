<?php
include_once '../conexao.php';
session_start();
$usuario_id = $_SESSION['user']['id'];

$conexao = new conexao();

$resultado = (isset($_SESSION['resultado'])) ? $_SESSION['resultado'] : $conexao->executar("select * from tarefas where usuario_id=$usuario_id");

//atribuição e verificação de variaveis 
$task = (isset($_POST["description"])) ? $_POST["description"] : null;
$date = (isset($_POST["date"])) ? $_POST["date"] : null;
$time = (isset($_POST["time"])) ? $_POST["time"] : null;
$id = (isset($_POST["id"])) ? $_POST["id"] : null;

//é inseriodo nela o valor readonly caso o valor dela for null, deixando o campo de editar com somente leitura
$showEdit = (isset($_POST["showEdit"])) ? $_POST["showEdit"] : "readonly";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tasks.css">
    <title></title> 
</head>
<body>
    <h1>Suas Tarefas</h1>
    <section class="toolBar">
        <!-- formulario para adicionar uma nova tarefa -->
        <form action="../processaTarefas.php" method="post">
            <h2>Adicionar Tarefa</h2>
            <label for="description">Descrição</label>
            <input type="text" id="inputDescription" name="description">

            <br>

            <label for="date">Data</label> 
            <input type="date" id="input" name="date">

            <label for="time">Hora</label> 
            <input type="time" id="input" name="time">

            <input type="hidden" name="status" value="0">
            <input type="hidden" name="acao" value="1">
            <input type="hidden" name="userId" value="<?=$usuario_id?>">

            <input type="submit" id="inputBt" value="Adicionar">
        </form>

        <!-- formulario para editar a tarefa escolhida na tabela -->
        <form action="../processaTarefas.php" method="post">
            <h2>Editar Tarefa</h2>
            <label for="description">Descrição</label>
            <input type="text" id="inputDescription" name="description" value="<?=$task?>" <?=$showEdit?>>

            <br>
            
            <label for="date">Data</label> 
            <input type="date" id="input" name="date" value="<?=$date?>" <?=$showEdit?>>

            <label for="time">Hora</label>
            <input type="time" id="input" name="time" value="<?=$time?>" <?=$showEdit?>>

            <input type="hidden" name="acao" value="3">
            <input type="hidden" name="id" value="<?=$id?>">
            
            <input type="submit" id="inputBt" value="Editar">
        </form>
    </section>
    <section class="showTasks">
    <!-- Tabela que mostra todas as tarefas vinculadas ao usuário -->
    <table class="table">
        <tr>
            <th>Status</th>
            <th>Tarefa</th>
            <th>Data</th> 
            <th>Hora</th>
        </tr>
        <?php
        foreach($resultado as $v){
            ?>
            <tr>
                <?php
                $data = ($v['data'] == "0000-00-00") ? "--/--/--" : date("d/m/y", strtotime($v['data']));
                $hora = ($v['hora'] == "00:00:00") ? "--:--" : date("H:i", strtotime($v['hora']));

                $check = ($v["status"] == 1) ? 'checked' : '';

                echo "<td><input type='checkbox' name='status' $check></td>";
                echo "<td>" . $v["tarefa"] . "</td>";
                echo "<td>" . $data . "</td>";
                echo "<td>" . $hora . "</td>";
                echo "<input type='hidden' name='id' value=".$v["id"].">";
                ?>
                <td class="button">
                    <form action="tasks.php" method="post">
                        <input type="hidden" name="description" value="<?=$v['tarefa']?>">
                        <input type="hidden" name="date" value="<?= $v['data'] ?>">
                        <input type="hidden" name="time" value="<?= $v['hora'] ?>">
                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                        <input type="hidden" name="showEdit" value="">
                        <button>Editar</button>
                </form>
                </td>
                <td class="button">
                    <form action="../processaTarefas.php" method="post">
                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                        <input type="hidden" name="acao" value="4">
                        <button>Remover</button>
                    </form>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </section>
    <section class="toolBar" style="background: #C8C7D1; flex-flow: column; ">
        <!-- formulario para realizar uma pesquisa -->
        <form action="../processaTarefas.php" method="post" id="formSearch">
            <h2>Pesquisar Tarefas</h2>
            <label for="description">Descrição</label>
            <input type="text" id="inputDescription" name="description"> 

            <label for="date">Data</label>
            <input type="date" id="input" name="date">
            
            <label for="time">Hora</label>
            <input type="time" id="input" name="time">

            <input type="hidden" name="userId" value="<?=$usuario_id?>">
            <input type="hidden" name="acao" value=5 >
            <input type="submit" value="Pesquisar">
        </form>

        <form action="../processaTarefas.php" method="post" style="text-align: center; width: 100%;">
            <input type="hidden" name="userId" value="<?=$usuario_id?>">
            <input type="hidden" name="acao" value="6">
            <input type="submit" value="Remover Pesquisa">
        </form>
    </section>
    
    <!-- alertas e mensagens de erro -->
    <?php 
    if(isset($_GET["alert"]) && $_GET["alert"]==1){
        ?> 
        <div class="erro" id="alert">
            <p>Tarefa Adicionada</p>
        </div>
        <?php
    }
    ?>
    <?php 
    if(isset($_GET["alert"]) && $_GET["alert"]==2){
        ?> 
        <div class="erro" id="alert">
            <p>Tarefa Editada</p>
        </div>
        <?php
    }
    ?>
    <?php
    if(isset($_GET["alert"]) && $_GET["alert"]==3){
        ?> 
        <div class="erro" id="alert">
            <p>Tarefa Removida</p>
        </div>
        <?php
    }
    ?>
    <?php
    if(isset($_GET["erro"]) && $_GET["erro"]==1){
        ?> 
        <div class="erro" id="alert">
            <p>Preencha o campo Descrição para adicionar uma tarefa!</p>
        </div>
        <?php
    }
    ?>
    <script src="../scripts/alertas.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/tasks.js"></script>
</body>
</html>