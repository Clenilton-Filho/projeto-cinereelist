<?php
require_once "dataContext.php";

if (!isset($_COOKIE['idUsuario'])) {
    header("Location: ../pages/login.php");
    exit;
}

$userId = $_COOKIE['idUsuario'];
$nome = $_POST['nome'] ?? '';
$uploadDir = "../media/upload/";
$imagemUrl = null;

// Criar diretório de upload se não existir
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Processar upload de imagem
if (isset($_FILES['foto-perfil']) && $_FILES['foto-perfil']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['foto-perfil']['tmp_name'];
    $fileInfo = getimagesize($tempFile);
    
    // Verificar se é uma imagem válida
    if ($fileInfo !== false) {
        $extension = image_type_to_extension($fileInfo[2], false);
        $newFileName = uniqid('profile_') . '.' . $extension;
        $targetFile = $uploadDir . $newFileName;
        
        // Mover arquivo para diretório de upload
        if (move_uploaded_file($tempFile, $targetFile)) {
            $imagemUrl = '/media/upload/' . $newFileName;
        }
    }
}

try {
    $pdo = conectar();
    
    // Preparar query baseado na existência ou não de nova imagem
    if ($imagemUrl !== null) {
        // Primeiro, vamos buscar a imagem antiga para deletá-la
        $stmtOldImage = $pdo->prepare("SELECT imagem_url FROM usuario WHERE id = :id");
        $stmtOldImage->execute([':id' => $userId]);
        $oldImage = $stmtOldImage->fetch(PDO::FETCH_ASSOC);
        
        // Se existir uma imagem antiga, deletá-la
        if ($oldImage && $oldImage['imagem_url'] && file_exists("../" . $oldImage['imagem_url'])) {
            unlink("../" . $oldImage['imagem_url']);
        }
        
        $stmt = $pdo->prepare("UPDATE usuario SET nome = :nome, imagem_url = :imagem_url WHERE id = :id");
        $params = [
            ':nome' => $nome,
            ':imagem_url' => $imagemUrl,
            ':id' => $userId
        ];
    } else {
        $stmt = $pdo->prepare("UPDATE usuario SET nome = :nome WHERE id = :id");
        $params = [
            ':nome' => $nome,
            ':id' => $userId
        ];
    }
    
    $stmt->execute($params);
    
    if ($stmt->rowCount() > 0) {
        header("Location: ../pages/modificar-perfil.php?success=1");
    } else {
        header("Location: ../pages/modificar-perfil.php?error=1");
    }
} catch (PDOException $e) {
    error_log("Erro ao atualizar perfil: " . $e->getMessage());
    header("Location: ../pages/modificar-perfil.php?error=1");
}
exit;
?> 