<?php
//Resposavel por acabar com a seção do usuario
session_start();
$acao = (isset($_POST["acao"])) ? $_POST["acao"] : 1;

if($acao == 1){
    //Neste caso, sera feito o logout se for clicado o botao de logout na dashboard
    session_destroy();
    header("Location: index.php");
}else if($acao == 2){
    //Neste outro, sera feito o logout quando a conta foir excluida pelo usuario
    session_destroy();
    header("Location: area/account.php?alert=4");
}
?>