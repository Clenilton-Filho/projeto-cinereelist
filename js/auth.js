document.addEventListener('DOMContentLoaded', function() {
    // Função para verificar se o usuário está logado
    async function verificarLogin() {
        const idUsuario = getCookie('idUsuario');
        const botoesEntrarCadastrar = document.querySelectorAll('.botao-cadastrar-entrar');
        const botaoSair = document.querySelector('.botao-sair');
        const divUsuario = document.getElementById('div-usuario');
        const nomeUsuarioHeader = document.getElementById('nome-usuario-header');
        const fotoPerfil = document.getElementById('foto-perfil-header');

        if (idUsuario) {
            // Usuário está logado
            botoesEntrarCadastrar.forEach(botao => botao.style.display = 'none');
            botaoSair.style.display = 'inline-block';
            divUsuario.style.display = 'flex';

            // Buscar informações do usuário
            try {
                const response = await fetch(`php/buscarUsuario.php?id=${idUsuario}`);
                const data = await response.json();
                
                if (data.success) {
                    // Atualizar nome do usuário
                    nomeUsuarioHeader.textContent = data.usuario.nome;
                    
                    // Atualizar foto do usuário se disponível
                    if (data.usuario.imagem_url) {
                        fotoPerfil.src = data.usuario.imagem_url;
                    }
                }
            } catch (error) {
                console.error('Erro ao buscar informações do usuário:', error);
            }
        } else {
            // Usuário não está logado
            botoesEntrarCadastrar.forEach(botao => botao.style.display = 'inline-block');
            botaoSair.style.display = 'none';
            divUsuario.style.display = 'none';
        }
    }

    // Função para obter valor de cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    verificarLogin();
}); 