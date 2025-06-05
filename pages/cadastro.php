<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineREEList - Cadastro</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/form.css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <header id="header">
        <div id="header-esquerda">
            <button class="hamburguer-menu" onclick="sideMenu()">
                <img class="hamburguer-icone invertido icon" src="../media/img/hamburger-menu-black.png" alt="menu icon">
            </button>
            <a href="../index.php">
                <h1>Cine<span>REEL</span>ist</h1>
            </a>
        </div>
        <div id="header-direita">
            <a class="link botao-cadastrar-entrar" href="../pages/login.php">Entrar</a>
        </div>
    </header>

    <nav id="side-menu">
        <header>
            <button class="hamburguer-menu" onclick="sideMenu()">
                <img class="hamburguer-icone invertido" src="../media/img/hamburger-menu-black.png" alt="menu icon">
            </button>
        </header>
        <section id="links">
            <a class="link botao-cadastrar-entrar" href="../pages/login.php">Entrar</a>
        </section>
    </nav>

    <main>
        <video id="video-1" src="../media/videos/chairs-loop.mp4" autoplay muted loop playsinline></video>

        <div id="login">
            <div id="imagem-div">
                <img id="form-icon" class="icon" src="../media/img/form-icon.png" alt="ícone de formulário">
            </div>

            <form id="login-form" action="" method="post" enctype="multipart/form-data">
                <div id="nome-div" class="login-div">
                    <label for="nome-input">
                        <img class="invertido icon" src="../media/img/user-full-black.png" alt="ícone de usuário">
                    </label>
                    <input type="text" name="nome-input" id="nome-input" placeholder="NOME DE USUÁRIO" required>
                </div>

                <div id="email-div" class="login-div">
                    <label for="email-input">
                        <img class="invertido icon" src="../media/img/email-full-black.png" alt="ícone de usuário">
                    </label>
                    <input type="email" name="email-input" id="email-input" placeholder="E-MAIL" required>
                </div>

                <div id="password-div" class="login-div">
                    <label for="password-input">
                        <img class="invertido icon" src="../media/img/password-full-black-2.png" alt="ícone de senha">
                    </label>
                    <input type="password" name="password-input" id="password-input" class="password-input senha-input" placeholder="SENHA">
                    <button type="button" class="mostrar-senha" onclick="mostrarSenha(event)">
                        <img src="../media/img/mostrar-senha-full-black.png" alt="mostrar senha" class="mostrar-senha-icone invertido">
                    </button>
                </div>

                <div id="repetir-senha-div" class="login-div">
                    <input type="password" name="confirmar-senha" id="confirmar-senha" class="password-input senha-input" placeholder="CONFIRME A SENHA">
                    <button type="button" class="mostrar-senha" onclick="mostrarSenha(event)">
                        <img src="../media/img/mostrar-senha-full-black.png" alt="mostrar senha" class="mostrar-senha-icone invertido">
                    </button>
                </div>
                
                <!--
                <div id="imagem-input-div">
                    <label id="imagem-input-botao" for="imagem-input">
                        ENVIAR IMAGEM
                    </label>
                    <input type="file" name="imagem-input" id="imagem-input" accept="image/*" onchange="previewImagem(event)">
                </div>!-->

                <button class="entrar-cadastrar">CADASTRAR-SE</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; CineREEList&trade; 2025</p>
    </footer>
    
    <?php
        include "../php/dataContext.php";
        include "../php/cadastrar.php";
        
        //Testar se teve algum post para rodar o cadastro
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $pdo = conectar();
            cadastrar($pdo);
        }
    ?>
    <!-- Scripts -->
    <script src="../js/cadastro.js"></script>
    <script src="../js/sideMenu.js"></script>
    <script src="../js/mostrarSenha.js"></script>
    <script src="../js/validarSenha.js"></script>
</body>
</html>
