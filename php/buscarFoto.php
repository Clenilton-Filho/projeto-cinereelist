<?php
require_once 'dataContext.php';

header('Content-Type: application/json');

if (!isset($_GET['email'])) {
    echo json_encode(['success' => false, 'message' => 'Email não fornecido']);
    exit;
}

$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);

if (!$email) {
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

$pdo = conectar();

if (!$pdo) {
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT imagem_url FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($resultado && $resultado['imagem_url']) {
        echo json_encode([
            'success' => true,
            'foto' => $resultado['imagem_url']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Usuário não encontrado ou sem foto'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro ao buscar foto: ' . $e->getMessage()
    ]);
}
?> 