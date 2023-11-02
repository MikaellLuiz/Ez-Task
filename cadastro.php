<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskLinx</title>
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
        <!-- formulario para cadastro de usuario no banco de dados -->
        <h1>Cadastro</h1>
        <form class="form" action="processaDadosUsuario.php" method="post">
            <label for="name">Nome:</label>
            <input type="text" name="name" required>

            <label for="username">E-mail:</label>
            <input type="text" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" name="password" minlength="8" riquired>

            <input type="hidden" name="acao" value="1">
            <input type="submit" value="Cadastrar">
        </form>
        <a href="login.php">Login</a>
    </section>

    <!-- Mensagens de erro -->
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
                <p>O email fornecido não é válido!</p>
            </div>
            <?php
        }
        if(isset($_GET["erro"]) && $_GET["erro"]==3){
            ?> 
            <div class="erro" id="alert">
                <p>O email já está sendo utilizado!</p>
            </div>
            <?php
        }
    ?>
    <script src="../scripts/alertas.js"></script>
</body>
</html>
