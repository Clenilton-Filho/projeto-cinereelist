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
function guardarInteresses(PDO $pdo, int $usuarioId, int $filmeId, string $func  )
{
    //Query para ver se usuario já tem aquele filme com o status(favorito e etc) que marcou
    $stmt = $pdo->prepare("SELECT status_user 
    FROM usuario_filme 
    WHERE usuario_id = :usuario_id 
    AND filme_id = :filme_id 
    AND status_user LIKE :status_user");

    $stmt->bindValue(":usuario_id", $usuarioId);
    $stmt->bindValue(":filme_id", $filmeId);
    $stmt->bindValue(":status_user", "%$func%");
    $stmt->execute();  
    
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    //Se o resultado não retornar nulo, retira o status(favorito e etc)
    if(!empty($resultado)){
        $stmt = $pdo->prepare("UPDATE usuario_filme 
        SET status_user = REPLACE(status_user, :func, null)
        WHERE usuario_id = :usuario_id 
        AND filme_id = :filme_id
        AND status_user LIKE :status_user");

        $stmt->bindValue(":usuario_id", $usuarioId);
        $stmt->bindValue(":filme_id", $filmeId);
        $stmt->bindValue(":status_user", "%$func%");
        $stmt->bindValue(":func", $func); 
        $stmt->execute();
        return; //Retorna e para a função
    } 
    //Insere o status no filme que o usuário escolheu
    $stmt = $pdo->prepare("INSERT INTO usuario_filme (usuario_id, filme_id, status_user) 
    VALUES (:usuario_id, :filme_id, :status_user)");
    $stmt->bindValue(":usuario_id", $usuarioId);
    $stmt->bindValue(":filme_id", $filmeId);
    $stmt->bindValue(":status_user", $func);
    $stmt->execute();   
}
?>