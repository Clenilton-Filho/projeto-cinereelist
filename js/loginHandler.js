document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const emailInput = document.getElementById('email-input');
    const imagePreview = document.getElementById('perfil-icon');
    const defaultImage = '../media/img/user-gold.png';
    
    // Função para buscar a foto do usuário
    async function buscarFotoUsuario(email) {
        try {
            const response = await fetch(`../php/buscarFoto.php?email=${encodeURIComponent(email)}`);
            const data = await response.json();
            
            if (data.success && data.foto) {
                imagePreview.src = data.foto;
            } else {
                imagePreview.src = defaultImage;
            }
        } catch (error) {
            console.error('Erro ao buscar foto:', error);
            imagePreview.src = defaultImage;
        }
    }

    // Evento para atualizar a foto quando o email é digitado
    let timeoutId;
    emailInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            if (this.value && this.value.includes('@')) {
                buscarFotoUsuario(this.value);
            } else {
                imagePreview.src = defaultImage;
            }
        }, 500); // Delay de 500ms para evitar muitas requisições
    });

    // Manipular o envio do formulário
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        try {
            const response = await fetch('../php/login.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Login bem sucedido
                window.location.href = data.redirect;
            } else {
                // Mostrar mensagem de erro
                mostrarMensagemErro(data.message);
            }
        } catch (error) {
            console.error('Erro ao fazer login:', error);
            mostrarMensagemErro('Erro ao fazer login. Tente novamente.');
        }
    });
});

function mostrarMensagemErro(mensagem) {
    // Remover mensagem de erro anterior se existir
    const erroAnterior = document.querySelector('.mensagem-erro');
    if (erroAnterior) {
        erroAnterior.remove();
    }

    // Criar e mostrar nova mensagem de erro
    const erro = document.createElement('div');
    erro.className = 'mensagem-erro';
    erro.textContent = mensagem;
    
    const loginForm = document.getElementById('login-form');
    loginForm.insertBefore(erro, loginForm.querySelector('button[type="submit"]'));

    // Remover a mensagem após 5 segundos
    setTimeout(() => {
        erro.remove();
    }, 5000);
} 