<?php
function cadastrar(PDO $pdo) {
    //Recebe as informações do que foi enviado pelo formulário
    $email = $_POST["email-input"];
    $senha = $_POST["password-input"];
    $imagemUrl = null; //Nulo, para caso o usuário não tenha imagem

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
            echo "<script>console.log('Imagem salva com sucesso!');</script>";
        } 
    }
    
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT); //Faz o hash da senha, para não salvar ela crua
    //Faz o insert e preenche as variáveis no VALUES
    $stmt = $pdo->prepare("INSERT INTO usuario (email, senha_hash, imagem_url) VALUES (:email, :senha, :imagemCaminho)");
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":senha", $senhaHash);
    $stmt->bindValue(":imagemCaminho", $imagemUrl);
    $stmt->execute();
}
?>