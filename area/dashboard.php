<?php
include_once '../conexao.php';
if(isset($_GET["alert"]) && $_GET["alert"]==1){
    header("location: ../index.php?alert=1");
}
session_start();
if($_SESSION["user"]["senha"]==null){
    header("Location: ../login.php?alert=2");
}
$nome = $_SESSION['user']['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>

    </style>
</head>
<body>
    <section class="sideBar">
        <img src="../img/logo_browm.png" alt="Ez Task Manager" style="width: 100px">
        <div class="sideMenu">
            <a href="#"onclick="showIframe('tasksFrame')">Tarefas</a>
            <br><br>
            <a href="#"onclick="showIframe('accountFrame')">Conta</a>
        </div>
    </section>
    <section class="initPage">
        <header class="topMenu">
            <h1>Olá <?php echo $nome?>!</h1>
            <a href="../logout.php?acao=1"><img src="../img/logout.png" alt="Sair" title="Sair"></a>
        </header>
        <iframe  id="tasksFrame" src="tasks.php" frameborder="0"></iframe>
        <iframe id="accountFrame" src="account.php" frameborder="0" style="display: none;"></iframe>
    </section>
    <script src="../scripts/dashboard.js"></script>
</body>
</html>