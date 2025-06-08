function errorMessage(mensagem) {
    const errorCheck = document.querySelector(`.error-message`);

    // Remove a mensagem existente antes de criar uma nova
    if (errorCheck) {
        errorCheck.remove();
    }

    const $errorElement = document.createElement("p");
    const tamanhoHeader = document.getElementById("header").offsetHeight;
    $errorElement.innerHTML = `${mensagem} ⚠️`;
    document.querySelector("#login-form").before($errorElement);
    $errorElement.classList.add('active');
    
    // Move para dentro da tela
    setTimeout(() => {
        $errorElement.style.top = (tamanhoHeader + 10) + 'px';
    }, 0);

    //Move para fora da tela depois de 3s
    setTimeout(() => {
        $errorElement.style.top = `-${tamanhoHeader}px`;
    }, 3000);
}

document.addEventListener("DOMContentLoaded", () => {
    const $emailInput = document.querySelector("#email-input");
    const $senhaInput = document.querySelector(".senha-input");
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
            errorMessage("A senha deve ter no mínimo 5 caracteres");
            return;
        }
        
        if (!haveNumber.test($senhaInput.value)){ //Obrigar usar número.
            errorMessage("A senha deve conter ao menos 1 número");
            return;
        }

        if (!haveUppercase.test($senhaInput.value)){ //Obrigar letra maiúscula
            errorMessage("A senha deve conter uma letra maiúscula");
            return;
        }

        form.submit();
    });
});