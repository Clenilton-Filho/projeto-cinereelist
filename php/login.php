<?php
require_once 'dataContext.php';

function realizarLogin($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_input(INPUT_POST, 'email-input', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['password-input'];

        error_log("Tentativa de login para email: " . $email);

        if (!$email || !$senha) {
            return json_encode(['success' => false, 'message' => 'Email e senha são obrigatórios']);
        }

        try {
            // Buscar usuário pelo email na tabela correta "usuario"
            $stmt = $pdo->prepare("SELECT id, nome, email, senha_hash, imagem_url FROM usuario WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            error_log("Resultado da busca: " . ($usuario ? "Usuário encontrado" : "Usuário não encontrado"));
            
            if ($usuario) {
                if (password_verify($senha, $usuario['senha_hash'])) {
                    // Login bem sucedido
                    setcookie("idUsuario", $usuario['id'], 0, "/");
                    error_log("Login bem sucedido para o usuário: " . $usuario['email']);
                    
                    return json_encode([
                        'success' => true,
                        'message' => 'Login realizado com sucesso',
                        'redirect' => '../index.html'
                    ]);
                } else {
                    error_log("Senha incorreta para o usuário: " . $usuario['email']);
                    return json_encode([
                        'success' => false,
                        'message' => 'Email ou senha incorretos'
                    ]);
                }
            } else {
                error_log("Usuário não encontrado para o email: " . $email);
                return json_encode([
                    'success' => false,
                    'message' => 'Email ou senha incorretos'
                ]);
            }
        } catch (PDOException $e) {
            error_log("Erro no banco de dados: " . $e->getMessage());
            return json_encode([
                'success' => false,
                'message' => 'Erro ao realizar login: ' . $e->getMessage()
            ]);
        }
    }
    
    error_log("Método de requisição inválido: " . $_SERVER["REQUEST_METHOD"]);
    return json_encode(['success' => false, 'message' => 'Método de requisição inválido']);
}

// Processar o login
$pdo = conectar();
if ($pdo) {
    header('Content-Type: application/json');
    echo realizarLogin($pdo);
} else {
    error_log("Falha na conexão com o banco de dados");
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados']);
}
?> 