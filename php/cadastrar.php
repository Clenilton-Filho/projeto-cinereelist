<?php
function cadastrar(PDO $pdo) {
    try {
        //Recebe as informações do que foi enviado pelo formulário
        $nome = $_POST["nome-input"];
        $email = $_POST["email-input"];
        $senha = $_POST["password-input"];
        $imagemUrl = null; //Nulo, para caso o usuário não tenha imagem

        // Verificar se o email já existe
        $stmtVerifica = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE email = :email");
        $stmtVerifica->bindValue(":email", $email);
        $stmtVerifica->execute();
        
        if ($stmtVerifica->fetchColumn() > 0) {
            // Email já existe
            echo "<script>alert('Este email já está cadastrado!'); window.history.back();</script>";
            return;
        }

        // Debug - Verificar os valores recebidos
        error_log("Dados recebidos - Nome: " . $nome . ", Email: " . $email);

        // Processa a imagem (se enviada)
        if (!empty($_FILES["imagem-input"]["name"])) {
            // Caminho absoluto
            $pastaUpload = __DIR__ . "/../media/upload/";
            
            $extensao = pathinfo($_FILES["imagem-input"]["name"], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid() . "." . $extensao; // Gera nome único, para evitar conflito
            $caminhoCompleto = $pastaUpload . $nomeArquivo; // Gera o caminho final para onde vai a imagem
            
            // Move o arquivo para a pasta de upload
            if (move_uploaded_file($_FILES["imagem-input"]["tmp_name"], $caminhoCompleto)) {
                $imagemUrl = "/media/upload/" . $nomeArquivo; 
                error_log("Imagem salva com sucesso: " . $imagemUrl);
            } 
        }
        
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        // Debug - Mostrar a query que será executada
        $query = "INSERT INTO usuario (nome, email, senha_hash, imagem_url) VALUES (:nome, :email, :senha, :imagemCaminho)";
        error_log("Query a ser executada: " . $query);
        
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senhaHash);
        $stmt->bindValue(":imagemCaminho", $imagemUrl);
        
        // Debug - Verificar os valores que serão inseridos
        error_log("Valores para inserção - Nome: " . $nome . ", Email: " . $email . ", Imagem: " . $imagemUrl);
        
        $resultado = $stmt->execute();
        
        if ($resultado) {
            error_log("Cadastro realizado com sucesso!");
            // Redirecionar para a página de login após cadastro bem-sucedido
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../pages/login.php';</script>";
        } else {
            error_log("Erro ao cadastrar: " . print_r($stmt->errorInfo(), true));
            echo "<script>alert('Erro ao cadastrar usuário!'); window.history.back();</script>";
        }
        
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'unique constraint') !== false) {
            // Erro de violação de chave única (email duplicado)
            echo "<script>alert('Este email já está cadastrado!'); window.history.back();</script>";
        } else {
            error_log("Erro no cadastro: " . $e->getMessage());
            echo "<script>alert('Erro ao cadastrar usuário!'); window.history.back();</script>";
        }
    }
}

// Testar se teve algum post para rodar o cadastro
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = conectar();
    if ($pdo) {
        cadastrar($pdo);
    } else {
        error_log("Erro ao conectar ao banco de dados");
        echo "<script>alert('Erro ao conectar ao banco de dados!'); window.history.back();</script>";
    }
}
?>