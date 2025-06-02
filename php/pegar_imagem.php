<?php
    function imagemIndex(string $genero, PDO $pdo){
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
            $contador++;

            if($contador == 9)
                return;

            //Pega o valor da url no banco
            $imagem_url = $filme["imagem_url"];
                
            //Html que será imprimido com echo
            $bloco = "
            <div style='background-image: url($imagem_url)' class='div-capa-filme-generos' data-id='{$filme['id']}' onmouseover='pegarId(this)'>
                <div class='div-botoes-generos'>
                    <button class='curti material-symbols-outlined botao-generos botao-capas'>thumb_up</button>
                    <button class='favoritar material-symbols-outlined botao-generos botao-capas'>star</button>
                    <button class='assistir-mais-tarde material-symbols-outlined botao-generos botao-capas'>library_add</button>
                </div>
            </div>";

            echo $bloco; 

            //style='background-image: url($imagem_url)'
        }    
    }
?>