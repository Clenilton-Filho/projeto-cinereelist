<?php
function conectar(){
    $hostname = "localhost";
    $username = "root";
    $password = "TrueCalefactor83";
    $banco = "CineReelist";

    // Objeto com as informações de conexão
    $conn = new mysqli($hostname, $username, $password, $banco);

    if (!$conn){
        die("Conexão falhou, erros: " . $conn->connect_error);
    }

    return $conn;
}
?>
