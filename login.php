<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskLinx | Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <a class="btBack" href="index.php">
        <img src="img/btBack.png" alt="Voltar">
        <p>Voltar</p>
    </a>
    <header>
        <img src="img/logo_white.png" alt="">
    </header>
    <section>
        <h1>Login</h1>
        <form class="form" action="processaDadosUsuario.php" method="post">
            <label for="username">Nome de Usuário:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" minlength="8" required>
            <input type="submit" value="Entrar">
            <input type="hidden" name="acao" value="2">
        </form>
        <a href="cadastro.php">Cadastre-se</a>
    </section>
    <!-- Mensagem de Erro e alertas como tratamento de erro -->
    <?php 
        if(isset($_GET["erro"]) && $_GET["erro"]==2){
            ?> 
            <div class="erro" id="alert">
                <p>A senha é menor que 8 dígitos</p>
            </div>
            <?php
        }
        if(isset($_GET["erro"]) && $_GET["erro"]==1){
            ?> 
            <div class="erro" id="alert">
                <p>O usuário deve ser um email!</p>
            </div>
            <?php
        }
        if(isset($_GET["alert"]) && $_GET["alert"]==1){
            ?> 
            <div class="erro" id="alert">
                <p>Cadastro efetuado com sucesso!</p>
            </div>
            <?php
        }
        if(isset($_GET["alert"]) && $_GET["alert"]==2){
            ?> 
            <div class="erro" id="alert">
                <p>Usuário não encontrado!</p>
                <p>Verifique seu dados e tente novamente.</p>
            </div>
            <?php
        }
        if(isset($_GET["alert"]) && $_GET["alert"]==3){
            ?> 
            <div class="erro" id="alert">
                <p>Senha Incorreta!</p>
            </div>
            <?php
        }
    ?>
    <script src="../scripts/alertas.js"></script>
</body>
</html>

