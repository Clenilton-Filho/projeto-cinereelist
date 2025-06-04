<?php
session_start();

// Se já estiver logado, redireciona para a página inicial
if (isset($_COOKIE['idUsuario'])) {
    header('Location: ../index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineREEList - Entrar</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/form.css">
    <link rel="stylesheet" href="../style/login-redefinir.css">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="shortcut icon" href="../favicon-2.ico" type="image/x-icon">
</head>
<body>
    <header id="header">
        <div id="header-esquerda">
            <button class="hamburguer-menu" onClick="sideMenu()">
                <img class="hamburguer-icone invertido" class="icon" src="../media/img/hamburger-menu-black.png" alt="menu icon">
            </button>
            <a href="../index.html">
                <h1>Cine<span>REEL</span>ist</h1>
            </a>
        </div>
        <div id="header-direita">
            <a class="link botao-cadastrar-entrar" href="cadastro.php">CADASTRAR-SE</a>
        </div>
    </header>
    <nav id="side-menu">
        <header>
            <button class="hamburguer-menu" onClick="sideMenu()">
                <img class="hamburguer-icone invertido" src="../media/img/hamburger-menu-black.png" alt="menu icon">
            </button>
        </header>
        <section id="links">
            <a class="link botao-cadastrar-entrar" href="cadastro.php">CADASTRAR-SE</a>
        </section>
    </nav>
    <main>
        <video id="video-1" src="../media/videos/chairs-loop.mp4" autoplay="on" muted loop playsinline></video>
        <div id="login">
            <div id="imagem-div">
                <img id="perfil-icon" class="icon" src="../media/img/user-black.png" alt="ícone de formulário">
                <img id="imagem-preview" src="../media/img/form-icon.png" alt="Preview da imagem">
            </div>
            <form id="login-form" method="POST"> 
                <div id="email-div" class="login-div">
                    <label for="email-input">
                        <img class="invertido icon login-icone" src="../media/img/email-icon.png" alt="ícone de usuário">
                    </label>
                    <input type="email" name="email-input" id="email-input" placeholder="E-MAIL" required>
                </div>
                <div id="password-div" class="login-div">
                    <label for="password-input">
                        <img class="invertido icon login-icone" src="../media/img/password-full-black-2.png" alt="ícone de senha">
                    </label>
                    <input type="password" name="password-input" id="password-input" class="senha-input" placeholder="SENHA" required>
                    <button type="button" id="mostrar-senha" class="mostrar-senha" onclick="mostrarSenha(event)">
                        <img src="../media/img/mostrar-senha-full-black.png" alt="mostrar senha" class="invertido mostrar-senha-icone">
                    </button>
                </div>
                <button type="submit" id="entrar-botao" class="entrar-cadastrar">ENTRAR</button>
            </form>
            <button class="esqueci-senha"><a href="redefinir-senha.html">ESQUECI MINHA SENHA &UpperRightArrow;</a></button>
        </div>
    </main>
    <footer>
        <p>&copy; CineREEList&trade; 2025</p>
    </footer>
    <script src="../js/loginHandler.js"></script>
    <script src="../js/sideMenu.js"></script>
    <script src="../js/mostrarSenha.js"></script>
</body>
</html> 