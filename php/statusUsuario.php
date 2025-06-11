<?php
// Função criada para receber a requisição POST feita pelo postInteresses()
// do index.js e colocar ou tirar um status do banco
function status(PDO $pdo){
    //Recebe a requisição e guarda as informações
    $usuarioId = $_POST['usuario_id'] ?? null; 
    $filmeId = $_POST['id'] ?? null;   
    $func = $_POST['func'] ?? null;  
    
    //Se filmeId NÃO estiver nulo, executa a função
    if ($filmeId){
        guardarInteresses($pdo, $usuarioId, $filmeId, $func);  
    }

}
function guardarInteresses(PDO $pdo, int $usuarioId, int $filmeId, string $func)
{
    //Verifica se já existe o status
    $selectStmt = $pdo->prepare("SELECT status_user 
        FROM usuario_filme 
        WHERE usuario_id = :usuario_id 
        AND filme_id = :filme_id 
        AND status_user LIKE :status_user");

    $selectStmt->bindValue(":usuario_id", $usuarioId);
    $selectStmt->bindValue(":filme_id", $filmeId);
    $selectStmt->bindValue(":status_user", "%$func%");
    $selectStmt->execute();

    $resultado = $selectStmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($resultado)) {
        //Remove o status existente
        $updateStmt = $pdo->prepare(
            "UPDATE usuario_filme 
            SET status_user = REPLACE(status_user, :func, null)
            WHERE usuario_id = :usuario_id 
            AND filme_id = :filme_id
            AND status_user LIKE :status_user");

        $updateStmt->bindValue(":usuario_id", $usuarioId);
        $updateStmt->bindValue(":filme_id", $filmeId);
        $updateStmt->bindValue(":status_user", "%$func%");
        $updateStmt->bindValue(":func", $func);
        $updateStmt->execute();
        return;
    }

    //Insere o novo status
    $insertStmt = $pdo->prepare(
            "INSERT INTO usuario_filme (usuario_id, filme_id, status_user) 
        VALUES (:usuario_id, :filme_id, :status_user)");
    $insertStmt->bindValue(":usuario_id", $usuarioId);
    $insertStmt->bindValue(":filme_id", $filmeId);
    $insertStmt->bindValue(":status_user", $func);
    $insertStmt->execute();
}

?>