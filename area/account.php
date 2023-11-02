<?php
// inclusão do arquivo conexao.php
include_once '../conexao.php';

//inicia a sessão na pagina
session_start();

//atribuição de valores que estão na variavel global $_SESSION.
$usuario_id = $_SESSION['user']['id'];
$nome = $_SESSION['user']['nome'];
$email = $_SESSION['user']['email'];
$senha = $_SESSION['user']['senha'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/account.css">
</head>
<body>
    <h1>Suas Informações</h1>
    <section>
        <!-- alterar nome -->
        <p>Aqui você pode editar o nome cadastrado. Para confirma as alterações, digite a sua senha e clique em editar.</p>
            <form action="../processaDadosUsuario.php" method="post">
                <div class="editLabel">
                    <label>Nome</label>
                    <input type="text" name="name" value="<?=$nome?>" require>
                </div>
                <div class="editLabel">
                    <label>Email</label>
                    <input type="text" name="username" value="<?=$email?>" readonly title="Não é possivel alterar o email">
                </div>
                <div class="editLabel">
                    <label>Senha</label>
                    <input type="password" name="password" require>
                </div>             
                <input type="hidden" name="acao" value="3">
                <input type="hidden" name="id" value="<?=$usuario_id?>">
                <div class="editBt">
                    <input type="submit" value="Editar">
                </div>
            </form>
    </section>
    <section>
        <!-- alterar a senha -->
        <h2>Altere sua senha</h2>
            <form action="../processaDadosUsuario.php" method="post">
                <div>
                    <label for="password">Senha Atual</label>
                    <input type="password" name="password" require>
                </div>
                <div>
                    <label for="newPassword">Nova senha</label>
                    <input type="password" name="newPassword" require>
                </div>
                <div>
                    <label for="repeatNewPassword">Repita a nova senha</label>
                    <input type="password" name="repeatNewPassword" require>
                </div>
                <div>
                    <input type="submit" value="Editar">
                </div>

                <input type="hidden" name="id" value="<?=$usuario_id?>">
                <input type="hidden" name="acao" value="5">
            </form>
    </section>
    <section>
        <!-- area de exclusão de usuario -->
        <h2>Area Perigosa</h2>`
        <h3>Apagar Conta</h3>
        <p>Sera excluido todas suas informações incluindo todos os registros e suas tarefas!</p>
        <p>Após essa confirmação de sua senha, seus dados serão excluidos. Essa operação não pode ser desfeita!</p>
        <form class="cleanAll" action="../processaDadosUsuario.php" method="post">
            <div>
                <label for="password">Digite sua senha</label>
                <input type="text" name="password">
            </div>
            <input type="hidden" name="id" value="<?=$usuario_id?>">
            <input type="hidden" name="acao" value="4">
            <input class= cleanAllBt type="submit" value="Apagar Tudo">
        </form>

</section>
            
    <?php 
    if(isset($_GET["alert"]) && $_GET["alert"]==1){
        ?> 
        <div class="erro" id="alert" >
            <p>Suas informações foram editadas</p>
            <p>Elas seram atualizadas no proximo login</p>
        </div>
        <?php
    }
    ?>
    <?php 
    if(isset($_GET["erro"]) && $_GET["erro"]==1){
        ?> 
        <div class="erro" id="alert">
            <p>Senha incorreta!</p>
        </div>
        <?php
    }
    ?>
    <?php 
    if(isset($_GET["erro"]) && $_GET["erro"]==3){
        ?> 
        <div class="erro" id="alert">
            <p>O campos Nova senha e Repita a nova senhas devem ser iguais!</p>
        </div>
        <?php
    }
    ?>
    <?php 
    if(isset($_GET["alert"]) && $_GET["alert"]==4){
        ?> 
        <div class="erro" id="alert" >
            <p>Clique no botão para ser redirecionado para pagina inicial</p>
            <a href="../index.php" target="_top">Pagina Inical</a>
        </div>
        <?php
    }
    ?> 
    <script src="../scripts/alertas.js"></script> 
</body>
</html>