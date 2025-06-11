<?php
    function imagemIndex(string $genero, PDO $pdo, bool $limitado = true){
        //Fazer o select com o gênero específico
        $stmt = $pdo->prepare("SELECT id, imagem_url FROM filme WHERE genero LIKE :genero ORDER BY id DESC");
        $stmt->bindValue(":genero", "%$genero%");
        $stmt->execute();

        //Transformar em array
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $contador = 0;
        //Percorrer o array e colocar um bloco com a url do filme
        foreach ($resultado as $filme){
            //Contador para limitar até 8 filmes por categoria
            if ($limitado && ++$contador > 8) {
                break;
            }

            //Pega o valor da url no banco
            $imagem_url = $filme["imagem_url"];
                
            //Html que será imprimido com echo
            $bloco = "
            <div style='background-image: url($imagem_url)' class='div-capa-filme-generos' data-id='{$filme['id']}' onmouseover='pegarIdFilme(this)'>
                <div class='div-botoes-generos'>
                    <button class='curti material-symbols-outlined botao-generos botao-capas'>thumb_up</button>
                    <button class='favoritar material-symbols-outlined botao-generos botao-capas'>star</button>
                    <button class='assistir-mais-tarde material-symbols-outlined botao-generos botao-capas'>library_add</button>
                </div>
            </div>";

            echo $bloco; 
        }    
    }
    function imagemAlta(PDO $pdo){
        //Fazer o select com o gênero Alta
        $stmt = $pdo->prepare("SELECT id, imagem_url FROM filme WHERE genero LIKE :genero ORDER BY id ASC");

        $stmt->bindValue(":genero", "%Alta%");
        $stmt->execute();

        //Transformar em array
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $contador = 0;
        //Percorrer o array e colocar um bloco com a url do filme
        foreach ($resultado as $filme){

            //Pega o valor da url no banco
            $imagem_url = $filme["imagem_url"];
                
            //Html que será imprimido com echo
            $bloco = "
            <div class='div-capa-filme-em-alta' data-id='{$filme['id']}' onmouseover='pegarIdFilme(this)'>
                <span class='curti curti-em-alta botao-capas material-symbols-outlined icone-em-alta'>thumb_up</span>
                <img src='$imagem_url' onMouseEnter='mudarTrailer(event)')'>
            </div>";

            echo $bloco; 
        }    
    }

    function imagemIcone(PDO $pdo){
        if (!isset($_COOKIE['idUsuario'])) {
            // Se não houver cookie, retorna os botões de login/cadastro
            $bloco = "
            <a class='link botao-cadastrar-entrar' href='pages/cadastro.php'>Cadastrar-se</a>
            <a class='link botao-cadastrar-entrar' href='pages/login.php'>Entrar</a>";
            echo $bloco;
            return;
        }

        $id = $_COOKIE["idUsuario"];

        //Fazer o select com o id do cookie
        $stmt = $pdo->prepare("SELECT id, nome, imagem_url FROM usuario WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        //Receber um resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            // Se não encontrar o usuário, retorna os botões de login/cadastro
            $bloco = 
            "<a class='link botao-cadastrar-entrar' href='pages/login.php'>Entrar</a>
            <a class='link botao-cadastrar-entrar' href='pages/cadastro.php'>Cadastrar-se</a>"
            ;
            echo $bloco;
            return;
        }

        //Pega o valor da url no banco e define imagem padrão se necessário
        $imagem_url = !empty($resultado['imagem_url']) ? $resultado['imagem_url'] : 'media/img/user-black.png';
        $nome = $resultado['nome'];
        
        $bloco = "
        <div id='div-usuario'>
            <a href='pages/perfil.php'>
                <span id='nome-usuario-header' class='usuario'>$nome</span>
            </a>
            <div id='div-foto-perfil-header' class='usuario'>
                <a href='pages/perfil.php'>
                    <img id='foto-perfil-header' src='$imagem_url' alt='foto de perfil do usuário' onerror=\"this.src='media/img/user-black.png';\">
                </a>
            </div>
        </div>
        <a class='link botao-sair' href='php/logout.php'>SAIR</a>";
        echo $bloco; 
    }

    function popularPerfil(string $usuarioId, string $statusUser, PDO $pdo) {
        //Fazer o select com o gênero específico
        $stmt = $pdo->prepare(
            "SELECT f.imagem_url
            FROM usuario_filme uf
            JOIN filme f ON uf.filme_id = f.id
            WHERE uf.usuario_id = :idUsuario AND uf.status_user = :statusUser
            ORDER BY uf.id DESC"
        );                        
        
        $stmt->bindValue(":statusUser", $statusUser);
        $stmt->bindValue(":idUsuario", $usuarioId);
        $stmt->execute();
        
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($resultados)) {
            echo "<div class='capa-filme'></div>";
            return;
        }
        
        foreach ($resultados as $filme) {
            //Adicionando ../ antes da URL da imagem e salvando ela
            $imagemUrl = '../' . $filme["imagem_url"];
  
            $html = "<div style=\"background-image: url('$imagemUrl');\" class=\"capa-filme\"></div>";
            
            echo $html;
        }

    }
?>