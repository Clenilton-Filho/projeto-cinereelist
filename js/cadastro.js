function sideMenu(){
    $sideMenu = document.getElementById('side-menu');

    if ($sideMenu.style.left == '0%'){
        $sideMenu.style.left = '-50%';
    }else{
        $sideMenu.style.left = '0%';
    }
}
function mostrarSenha(){
    const $senhaInput = document.getElementById("password-input");
    const $mostrarSenhaIcone = document.getElementById("mostrar-senha")

    if ($senhaInput.type == "password"){
        $senhaInput.type = "text";
        $mostrarSenhaIcone.style.opacity = "100%"
    }else{
        $senhaInput.type = "password";
        $mostrarSenhaIcone.style.opacity = "50%"
    }
}

function previewImagem(event) {
    const reader = new FileReader();
    const formIcon = document.getElementById("form-icon");
    const previewDaImagem = document.getElementById("imagem-preview");

    reader.onload = function() {
        previewDaImagem.src = reader.result;
        formIcon.style.opacity = "0";
        previewDaImagem.style.opacity = "100%";
    };
    reader.readAsDataURL(event.target.files[0]);
}