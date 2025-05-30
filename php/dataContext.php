<?php
function conectar(){
    //Informaçoes do Banco de dados
    $host = "aws-0-sa-east-1.pooler.supabase.com";
    $db   = "postgres";
    $user = "postgres.zacizdfejqkjguyujkoy";
    $pass = "TrueCalefactor83";
    $port = "6543";

    // Connection string
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";

    try {
        $pdo = new pdo($dsn, $user, $pass);
        return $pdo;
    }catch(PDOException $e){
        echo "Erro: ". $e->getMessage();
        return false;
    }
    
}
?>
