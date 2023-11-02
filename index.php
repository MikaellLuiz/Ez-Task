<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskLinx</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <section>
        <div class="title">
            <img src="img/Logo_b.png" alt="Ez-Task">
            <h1>Comece a gerenciar suas tarefas agora!</h1>
            <button onclick="moveAbout()">Iniciar</button>
        </div>
        <div class="content">
            <a class="init_login" href="login.php"><h2>login</h2></a>
            <a class="init_cadastro" href="cadastro.php"><h2>cadastro</h2></a>
        </div>
    </section>
    <script src="scripts/index.js"></script>
    <!-- Mensagem de alerta -->
    
    <?php 
    if(isset($_GET["alert"]) && $_GET["alert"]==1){
        ?> 
        <div class="erro" id="alert">
            <p>Sua conta foi excluida!</p>
        </div>
        <?php
    }
    ?>
    <script src="../scripts/alertas.js"></script>
</body>
</html>