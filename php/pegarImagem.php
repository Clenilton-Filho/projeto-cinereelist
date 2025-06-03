<?php
    function imagemIndex(string $genero, PDO $pdo, bool $limitado = true){
        //Fazer o select com o gênero ação
        $stmt = $pdo->prepare("SELECT id, imagem_url FROM filme WHERE genero LIKE :genero ORDER BY id DESC");
        //Ação com porcentagem, para puxar qualquer filme que tenha genero ação no meio
        $stmt->bindValue(":genero", "%$genero%");
        $stmt->execute();

        //Transformar em array
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $contador = 0;
        //Percorrer o array e colocar um bloco com a url do filme
        foreach ($resultado as $filme){
            //Contador para limitar até 9
            if($limitado = true){
                $contador++;
                
                if($contador == 9)
                    return;
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
        $_COOKIE['idUsuario'] = '7';
        $id = $_COOKIE["idUsuario"];

        //Fazer o select com o id do cookie
        $stmt = $pdo->prepare("SELECT id, nome, imagem_url FROM usuario WHERE id = :id");
        $stmt->bindValue(":id", "$id");
        $stmt->execute();

        //Receber um resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        //Pega o valor da url no banco
        $imagem_url = $resultado['imagem_url'];
        $nome = $resultado['nome'];
        
        $bloco = "
        <div id='div-usuario'>
            <span id='nome-usuario-header'>$nome</span>
            <div id='div-foto-perfil'>
                <a href='pages/perfil.html'>
                    <img id='foto-perfil-header' src='$imagem_url' alt='foto de perfil do usuário'>
                </a>
            </div>
        </div>";
        echo $bloco; 
        
    }
?>