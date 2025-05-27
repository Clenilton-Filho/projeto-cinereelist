<?php
function cadastrar(mysqli $conn) {
    // Ativa exibição de erros para debug
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $email = $_POST['email-input'];
    $senha = $_POST['password-input'];
    
    // Processa a imagem (se enviada)
    $imagemUrl = null;
    if (!empty($_FILES['imagem-input']['name'])) {
        // CAMINHO ABSOLUTO corrigido - funciona em qualquer servidor
        $pastaUpload = __DIR__ . '/../media/upload/';
        
        // Gera nome único mantendo a extensão original
        $extensao = pathinfo($_FILES['imagem-input']['name'], PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoCompleto = $pastaUpload . $nomeArquivo;
        
        // Move o arquivo para a pasta de upload
        if (move_uploaded_file($_FILES['imagem-input']['tmp_name'], $caminhoCompleto)) {
            $imagemUrl = 'media/upload/' . $nomeArquivo; 
            echo "<script>console.log('Imagem salva com sucesso!');</script>";
        } 
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO usuario (email, senha_hash, imagem_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $senhaHash, $imagemUrl);

    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>