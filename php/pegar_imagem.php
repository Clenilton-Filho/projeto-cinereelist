<?php
    function imagemAcaoIndex(PDO $pdo){
        //Fazer o select com o gênero ação
        $stmt = $pdo->prepare("SELECT id, imagem_url FROM filme WHERE genero LIKE :genero ORDER BY id DESC");
        //Ação com porcentagem, para puxar qualquer filme que tenha genero ação no meio
        $stmt->bindValue(":genero", "%Ação%");
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
            $bloco = "<div class='div-capa-filme-generos'>
            <img src='$imagem_url'>
            </div>";

            echo $bloco; 
        }    
    }

    function imagemComediaIndex(PDO $pdo){
        //Fazer 
    }
    function imagemTerrorIndex(PDO $pdo){
        //Fazer
    }
    function imagemSuspenseIndex(PDO $pdo){
        //Fazer
    }
?>
