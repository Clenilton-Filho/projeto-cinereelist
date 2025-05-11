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

document.addEventListener("DOMContentLoaded", () => {
    const $emailInput = document.querySelector("#email-input");
    const $senhaInput = document.querySelector("#password-input");
    $emailInput.setAttribute("required", "true");
    $senhaInput.setAttribute("required", "true");

    /* Verificar ao submit
    const form = document.querySelector("#login-form")
    form.addEventListener("submit", (event)=>{
        const emailVazio = emailInput.value.trim() === "";
        const senhaVazia = senhaInput.value.trim() === "";
        event.preventDefault();
        if (emailVazio || senhaVazia)
        {
            alert("Por favor, preencha os campos obrigatórios.");
        }
    })
    */ 
});



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
