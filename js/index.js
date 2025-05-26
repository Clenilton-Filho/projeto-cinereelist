

//deixar as animações de rolagem mais lentas

function rolarEsquerda(event){
    const $rolarDireita = document.getElementById('mudar-em-alta-direita');
    const $conteiner = event.target.closest('.div-filmes').children[0].children[0];
    const quantidade = $conteiner.offsetWidth;

    //rola o contêiner para a esquerda pelo tamanho do contêiner
    $conteiner.scrollLeft -= quantidade;

    //desabilitando o botão depois de clicado
    event.target.style.opacity = 0;
    event.target.style.pointerEvents = 'none';

    //habilitando o outro botão
    $rolarDireita.style.opacity = 1;
    $rolarDireita.style.pointerEvents = 'auto';
}
      
function rolarDireita(event){
    const $rolarEsquerda = document.getElementById('mudar-em-alta-esquerda');
    const $conteiner = event.target.closest('.div-filmes').children[0].children[0];
    const quantidade = $conteiner.offsetWidth;

    //rola o contêiner para a direita pelo tamanho do contêiner
    $conteiner.scrollLeft += quantidade;

    //desabilitando o botão depois de clicado
    event.target.style.opacity = 0;
    event.target.style.pointerEvents = 'none';

    //habilitanto o outro botão
    $rolarEsquerda.style.opacity = 1;
    $rolarEsquerda.style.pointerEvents = 'auto';
}

/*
document.addEventListener("DOMContentLoaded", () => {
    const botaoMenu = document.querySelector(".hamburguer-menu");
    const sideMenu = document.getElementById("side-menu");

    botaoMenu.addEventListener("click", () => {
        sideMenu.classList.toggle("side-menu.ativo");
        console.log("Menu hamburguer clicado!");
    });
});
*/ 
