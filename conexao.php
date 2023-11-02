<?php
// Essa classe cria a conexão para o banco de dados e possui metodos para executar os SQLs do projeto
class conexao{
    private $host = "localhost";
    private $port = "3306";
    private $dbName = "easytask";
    private $user = "root";
    private $pass = "";
    private $pdo = null;
    
    //criação do metodo PDO (PHP Data Object)
    function __construct()
    {
      try{
        $this->pdo = new PDO(
            "mysql:host=". $this->host . ";dbname=" . $this-> dbName . ";port=" . $this->port,
            $this ->user,
            $this->pass
        );
      }catch(Exception $e){
        echo "Erro ao conectar ao banco de dados!";
      }  
    }
    //Metodo resposavel por tornar o PDO disponivel em certas partes do codigo
    public function getPdo(){
      return $this->pdo;
    }

    //Metodo responsavel por executar as SQLs solicitas em outras partes do projeto
    public function executar($sql){
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>