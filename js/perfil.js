function rolarEsquerda(event){
    const $rolarDireita = event.target.parentElement.children[1];
    const $divFilmes = event.target.parentElement.parentElement.children[1];
    const quantidade = $divFilmes.children[0].offsetWidth; 

    //rola o contêiner para a esquerda pelo tamanho da capa
    $divFilmes.scrollLeft -= quantidade + 10;


    //se tiver todo pra esquerda, desabilita o botão
    if ($divFilmes.scrollLeft <= 0){
        event.target.style.opacity = 0;
        event.target.style.pointerEvents = 'none';
        event.target.style.cursor = 'auto';
    }

    //habilitanto o outro botão
    if ($rolarDireita.style.opacity == 0){
        $rolarDireita.style.opacity = 1;
        $rolarDireita.style.pointerEvents = 'auto';
        $rolarDireita.style.cursor = 'pointer';
    }
}

 
function rolarDireita(event){
    const $rolarEsquerda = event.target.parentElement.children[0];
    const $divFilmes = event.target.parentElement.parentElement.children[1];
    const quantidade = $divFilmes.children[0].offsetWidth; 

    //rola o contêiner para a direita pelo tamanho da capa
    $divFilmes.scrollLeft += quantidade + 10;

    //se tiver todo pra direita, desabilita o botão
    if ($divFilmes.scrollLeft>=($divFilmes.offsetWidth/2 + 50)){
        event.target.style.opacity = 0;
        event.target.style.pointerEvents = 'none';
        event.target.style.cursor = 'auto';
    }

    //habilitanto o outro botão

    if ($rolarEsquerda.style.opacity == 0){
        $rolarEsquerda.style.opacity = 1;
        $rolarEsquerda.style.pointerEvents = 'auto';
        $rolarEsquerda.style.cursor = 'pointer';
    }
}