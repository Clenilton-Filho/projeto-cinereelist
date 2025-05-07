function mostrarSenha(event){
    const $botaoMostrar = event.target.closest(".mostrar-senha");
    const $senhaInput = $botaoMostrar.parentElement.querySelector(".senha-input");

    if ($senhaInput.type == "password"){
        $senhaInput.type = "text";
        $botaoMostrar.style.opacity = "100%"
    }else{
        $senhaInput.type = "password";
        $botaoMostrar.style.opacity = "50%"
    }
}
