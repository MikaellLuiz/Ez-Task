<?php 
//Inclui nesse arquivo o arquivo conexao.php
include_once "conexao.php";

// Criando uma nova conexao com um metodo disponivel em conexao.php
$conexao = new conexao();

$pdo = $conexao->getPdo(); //Adiciona em uma variavel o PDO (PHP Data Object)


//Declaração das variaveis que seram utilizadas nesse arquivo
//O uso da função isset é verificar se uma variavel existe, neste caso a variavel dentro da variavel global $_POST
//Se ela nâo existir, ele define a variavel como null como tratamento de erro
$id = (isset($_POST["id"])) ? $_POST["id"] : null;
$name = (isset($_POST["name"])) ? $_POST["name"] : null;
$erro=null;

//validação email
$email = (isset($_POST["username"])) ? $_POST["username"] : null;
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $erro=1;
}

//validação senha
$password = (isset($_POST["password"])) ? $_POST["password"] : null;
if(strlen($password) < 8){
    $erro=2;
}

$newPassword = (isset($_POST["newPassword"])) ? $_POST["newPassword"] : null;
if(strlen($newPassword) < 8){
    $erro=3;
}

$repeatNewPassword = (isset($_POST["repeatNewPassword"])) ? $_POST["repeatNewPassword"] : null;

$acao = (isset($_POST["acao"])) ? $_POST["acao"] : 1;
//Fim da declaração de variaveis

/* Abaixo estão os IFs responsaveis por todas as operações dentro do banco de dados relacinados ao usuario

Validação: uso de if($erro!=null && $erro!=3) se da como verificação, caso seja verdade é por que alguma validação retornou
erro se a condição if($erro==null || $erro==3) retornar verdadeiro, ele executa o codigo dentro do seu escopo

$sqlCommand: variavel que armazena o comando SQL que sera executado no banco de dados

header("location: "): função que encaminha para determinada pagina especificada
*/
if ($acao == 1) { 
    //criar novo usuario
    //Chamado pelo formulario presente no arquivo cadastro.php
    if($erro!=null && $erro!=3){
        header("location: cadastro.php?erro=$erro");
        exit;
    }

    if($erro==null || $erro==3){
        try{
            $sqlCommand = "insert into usuarios (nome, email, senha) values('$name','$email','$password')"; 
            $conexao -> executar($sqlCommand);
            header("location: login.php?alert=1");
        }catch(PDOException $e){
            if($e->getCode() == '23000'){
                header("location: cadastro.php?erro=3");
            }
        }}
} else if ($acao == 2){
    //login usuario
    //chamado pelo formulario presente no arquivo login.php
    if($erro!=null && $erro!=3){
        header("location: login.php?erro=$erro");
        exit;
    }
    if($erro==null || $erro==3){
        try{
            $sqlCommand = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sqlCommand);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$user) {
                header("location: login.php?alert=2"); // Usuário não encontrado
            } else {
                if($password==$user['senha']) {
                    // Iniciar sessão, redirecionar para página inicial
                    session_start();
                    $_SESSION['user'] = $user;
                    header("location: area/dashboard.php");
                } else {
                    header("location: login.php?alert=3"); // Senha incorreta
                }
            }
        } catch(PDOException $e){
            echo $e;
        }
    }
} else if ($acao == 3) { 
    //Atualiza os dados de usuario
    //Acao chamada pelo arquivo account.php
    $pass = $conexao -> executar("select senha from usuarios where id=$id");
    if($pass[0]["senha"] == $password){
        try{
        $sqlCommand = "update usuarios set nome='$name' where id=$id";
        $conexao -> executar($sqlCommand);
        header("location: area/account.php?alert=1");// Aviso que foi atualizado
    }catch(PDOException $e){
        echo $e;
    }
    }else{
        header("location: area/account.php?erro=1"); //Erro :senha incorreta
    }

} else if ($acao == 4){ 
    //Remover Usuario
    //chamado pelo arquivo account.php
    $pass = $conexao -> executar("select senha from usuarios where id=$id");//colocar nessa variavel a senha do usuario para comparaçào posterior
    if($pass[0]["senha"] == $password){
        try{
            $sqlCommand = "delete from tarefas where usuario_id=$id";
            $conexao -> executar($sqlCommand);
            $sqlCommand = "delete from usuarios where id=$id";
            $conexao -> executar($sqlCommand);
            header("location: logout.php?acao=2"); //encaminha para o arquivo logout.php que destruira a seção
        }catch(PDOException $e){
            echo $e;
        }
    }else{
        header("location: area/account.php?erro=1"); //senha incorreta
    }

} else if ($acao == 5){
    //atualliza senha
    //chamado pelo arquivo account.php
    if($erro!=null && $erro!=1){
        header("location: area/account.php?erro=$erro");
        exit;
    }
    if($repeatNewPassword == $newPassword){
        $pass = $conexao -> executar("select senha from usuarios where id=$id");//colocar nessa variavel a senha do usuario para comparaçào posterior
        if($pass[0]["senha"] == $password){
            try{
                $sqlCommand = "update usuarios set senha = '$newPassword' where id=$id";
                $conexao -> executar($sqlCommand);
                header("location: area/account.php?alert=1");
            }catch(PDOException $e){
                echo $e;
            }
        }else{
            header("location: area/account.php?erro=1"); //senha incorreta
        }
    }
    if($repeatNewPassword != $newPassword){
        header("location: area/account.php?erro=2"); //senha nova e repetida não conferem
    }
    

}
?>