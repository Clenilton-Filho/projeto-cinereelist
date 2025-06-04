const trailersNomes = [
    "the_matrix",
    "revenge_of_the_sith",
    "interstellar",
    "the_batman",
    "duna_parte_2"
]

const trailersSrc = [
    "media/videos/the_matrix.mp4",
    "media/videos/revenge_of_the_sith.mp4",
    "media/videos/interstellar.mp4",
    "media/videos/the_batman.mp4",
    "media/videos/duna_parte_2.mp4"
];


let filmeSelecionadoId = null;

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

function mudarTrailer(event){
    const $trailer = document.getElementById("trailer-1");
    const capaSrc = event.target.src;
    
    for (i = 0; i < trailersNomes.length; i++){
        if (capaSrc.includes(trailersNomes[i])){
            if (!$trailer.src.includes(trailersSrc[i])){
                $trailer.src = trailersSrc[i];
                $trailer.load();
                break;
            }
        }
    }
}

function pegarIdFilme(elemento){
    const dataId = elemento.getAttribute("data-id");
    filmeSelecionadoId = dataId;
}

function pegarIdUsuario(){
    //Pega a string de cookie e separa
    const cookieNome = "idUsuario" + "=";
    const cookies = document.cookie.split(";");
    
    //Percorro a string de cookies separados
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        
        while (cookie.charAt(0) == ' ') { //Checar e retorar espaço em branco
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(cookieNome) == 0) { //Se o Cookie for encontrado, retorno seu valor
            return cookie.substring(cookieNome.length, cookie.length);
        }
    }
    return null;
}

function postInteresses(elemento, func, usuario_id){
    elemento.addEventListener("click", () =>{
        if(filmeSelecionadoId){
            fetch("", {
                method: "POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${filmeSelecionadoId}&func=${func}&usuario_id=${usuario_id}`
            });
        }
    });
}

document.addEventListener("DOMContentLoaded", () =>{ 
    const favoritoElements = document.querySelectorAll(".favoritar");
    const maisTardeElements = document.querySelectorAll(".assistir-mais-tarde");
    const curtidoElements = document.querySelectorAll(".curti");
    
    //Verificar se algum botão de favorito foi clicado
    favoritoElements.forEach(element => {
        //Passa o id do usuário, o status e cria um post pro PH
        postInteresses(element, 'favorito', pegarIdUsuario());
    });
    maisTardeElements.forEach(element => {
        postInteresses(element, 'assistir_mais_tarde', pegarIdUsuario());
    });
    curtidoElements.forEach(element => {
        postInteresses(element, 'curtido', pegarIdUsuario());
    });
});


function rolarEsquerda(event){
    const $rolarDireita = document.getElementById('mudar-em-alta-direita');
    const $conteiner = document.getElementById("conteiner-capas-2-em-alta");
    const curti = document.querySelectorAll(".curti-em-alta");
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
    const curti = document.querySelectorAll(".curti-em-alta");
    const quantidade = $conteiner.offsetWidth;
    const mainWidth = document.getElementById('main').offsetWidth;

    //rola o contêiner para a direita pelo tamanho do contêiner
    $conteiner.scrollLeft += quantidade;

    //desabilitando o botão depois de clicado
    event.target.style.opacity = 0;
    event.target.style.pointerEvents = 'none';

    //habilitanto o outro botão
    $rolarEsquerda.style.opacity = 1;
    $rolarEsquerda.style.pointerEvents = 'auto';

    //reposicionando os botões de curtir
    switch (mainWidth){
        case 1360:
            curti.forEach($botao => {
                $botao.style.marginRight = "64.5%";
            });
            break
        case 1366:
            curti.forEach($botao => {
                $botao.style.marginRight = "64.5%";
            });
            break
        case 1600:
            curti.forEach($botao => {
                $botao.style.marginRight = "64.7%";
            });
            break
        default:
            curti.forEach($botao => {
                $botao.style.marginRight = "66.5%";
            });
    }
}