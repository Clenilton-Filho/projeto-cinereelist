function sideMenu(){
    $sideMenu = document.getElementById('side-menu');

    if ($sideMenu.style.left == '0%'){
        $sideMenu.style.left = '-50%';
    }else{
        $sideMenu.style.left = '0%';
    }
}
function mostrarSenha(event){
    const $senhaInput = event.currentTarget.closest(".login-div").querySelector(".password-input");
    const $mostrarSenhaIcone = event.currentTarget.closest(".login-div").querySelector(".mostrar-senha");

    if ($senhaInput.type == "password"){
        $senhaInput.type = "text";
        $mostrarSenhaIcone.style.opacity = "100%";
    }else{
        $senhaInput.type = "password";
        $mostrarSenhaIcone.style.opacity = "50%";
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
function errorMessage(mensagem) {
    const errorCheck = document.querySelector(".error-message");
    if (errorCheck){ //Checar se a mensagem já existe, para apagar.
        errorCheck.remove();
    }

    const $errorElement = document.createElement("p");
    $errorElement.classList.add("error-message");
    $errorElement.innerHTML = `⚠️ ${mensagem}`;          
    
    //CSS da mensagem de erro
    $errorElement.style.cssText = `
        display: flex;
        align-self: flex-end;
        color: white;
        font-size: 11px;
        margin-bottom: -10px;
    `;
    
    const $container = document.querySelector("#email-div");
    $container.before($errorElement); 
}
document.addEventListener("DOMContentLoaded", () => {
    const $emailInput = document.querySelector("#email-input");
    const $senhaInput = document.querySelector("#password-input");
    const $confirmarInput = document.querySelector("#confirmar-senha");
    
    $emailInput.setAttribute("required", "true");
    $senhaInput.setAttribute("required", "true");
    $confirmarInput.setAttribute("required", "true");
    
    //Validação do submit do form
    const form = document.querySelector("#login-form");
    form.addEventListener("submit", (event)=>{
        event.preventDefault();
        const haveNumber = new RegExp("[0-9]");
        const haveUppercase = new RegExp("[A-Z]")

        if ($confirmarInput.value != $senhaInput.value){ //Evitar senha diferente
            errorMessage("As senhas não coincidem");
            return;
        }

        if ($senhaInput.value.length < 5){ //Evitar senha muito curta.
            errorMessage("A senha deve ter no mínimo 5 caracteres.");
            return;
        }
        
        if (!haveNumber.test($senhaInput.value)){ //Obrigar usar número.
            errorMessage("A senha deve conter ao menos 1 número.");
            return;
        }

        if (!haveUppercase.test($senhaInput.value)){ //Obrigar letra maiúscula
            errorMessage("A senha deve conter uma letra maiúscula.");
            return;
        }

        form.submit();
    });
});