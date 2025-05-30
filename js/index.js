



function telaCheia(){
    $trailer = document.getElementById("trailer-1");
    $trailer.requestFullscreen();
    $trailer.controls = true;
    $trailer.muted = false;
}

document.addEventListener('fullscreenchange', () => {
    $trailer = document.getElementById("trailer-1")
    if (!document.fullscreenElement) {
        $trailer.controls = false;
        $trailer.muted = true;
    }
});

//mudar os filmes ((((((teste))))))


function mudarFilme(event){
    $trailer = document.getElementById("trailer-1");
    
    if (event.target.src.includes("revenge_of_the_sith.jpg")){
        if (!$trailer.src.includes("revenge_of_the_sith.mp4")){
            $trailer.src = "media/videos/revenge_of_the_sith.mp4";
        }
    }else if (event.target.src.includes("the_matrix.jpg")){
        if (!$trailer.src.includes("the_matrix_trailer_2.mp4")){
            $trailer.src = "media/videos/the_matrix_trailer_2.mp4";
        }
    }
}

function rolarEsquerda(event){
    const $rolarDireita = document.getElementById('mudar-em-alta-direita');
    const $conteiner = document.getElementById("conteiner-capas-2-em-alta");
    const curti = document.querySelectorAll(".curti");
    const quantidade = $conteiner.offsetWidth;

    //rola o contêiner para a esquerda pelo tamanho do contêiner
    $conteiner.scrollLeft -= quantidade;

    //desabilitando o botão depois de clicado
    event.target.style.opacity = 0;
    event.target.style.pointerEvents = 'none';

    //habilitando o outro botão
    $rolarDireita.style.opacity = 1;
    $rolarDireita.style.pointerEvents = 'auto';

    //reposicionando os botões curtir
    curti.forEach($botao => {
        $botao.style.marginRight = "auto";
    });
}
      
function rolarDireita(event){
    const $rolarEsquerda = document.getElementById('mudar-em-alta-esquerda');
    const $conteiner = document.getElementById("conteiner-capas-2-em-alta");
    const curti = document.querySelectorAll(".curti");
    const quantidade = $conteiner.offsetWidth;

    //rola o contêiner para a direita pelo tamanho do contêiner
    $conteiner.scrollLeft += quantidade;

    //desabilitando o botão depois de clicado
    event.target.style.opacity = 0;
    event.target.style.pointerEvents = 'none';

    //habilitanto o outro botão
    $rolarEsquerda.style.opacity = 1;
    $rolarEsquerda.style.pointerEvents = 'auto';

    //reposicionando os botões de curtir
    //reposicionando os botões curtir
    curti.forEach($botao => {
        $botao.style.marginRight = "66.5%";
    });

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
