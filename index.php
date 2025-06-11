<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal | CineREEList</title>

  <!--Links para os CSS-->
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/index.css">
  <link rel="shortcut icon" href="../favicon-2.ico" type="image/x-icon">

  <!--Ícones da página vindos do google fonts-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0&icon_names=starlibrary_adddouble_arrowkeyboard_double_arrow_left" />
</head>
<body>
  <!--iníciando sessão-->
  <?php
    session_start();
    include "php/dataContext.php";
    include "php/pegarImagem.php";
    include "php/statusUsuario.php";  
    $pdo = conectar();
  ?>

  <!--header padrão das páginas-->
  <header id="header">
    <div id="header-esquerda">
        <button class="hamburguer-menu" onClick="sideMenu()">
            <img class="hamburguer-icone invertido" src="media/img/hamburger-menu-black.png" alt="menu icon">
        </button>
        <a href="index.php">
          <h1>Cine<span>REEL</span>ist</h1>
        </a>
    </div>

  <!--Informações de usuário só aparecem se logado-->
    <div id="header-direita">
      <?= imagemIcone($pdo);?>
    </div>
  </header>

  
  <!--Menu lateral para versão mobile (incompleto)-->
  <nav id="side-menu">
      <header>
          <button class="hamburguer-menu" onclick="sideMenu()">
              <img class="hamburguer-icone invertido" src="../media/img/hamburger-menu-black.png" alt="menu icon">
          </button>
      </header>
      <section id="links">
          <a class="link botao-cadastrar-entrar" href="../pages/login.php">Entrar</a>
          <a class="link botao-cadastrar-entrar" href="../pages/cadastro.php">Cadastrar-se</a>
      </section>
  </nav>

  <!--Seção principal-->
  <main id="main">
    <div id="div-cadeiras">
      <video id="video-cadeiras" src="media/videos/chairs-loop.mp4" autoplay="on" muted loop playsinline></video>
    </div>
    
  <!--Seção de filmes/séries em alta-->
    <section id="secao-em-alta" class="secao">

    <!--Div para os trailers que tocam ao passar o mouse em uma capa-->
      <div id="div-trailer-1" class="div-trailer">

      <!--Botões para o trailer: Favoritar, Assistir mais tarde e Tela Cheia -->
        <div id="div-botoes-trailer-em-alta" class="div-botoes-trailer"> 

          <button id="mais-tarde-em-alta" class="assistir-mais-tarde"><span class="material-symbols-outlined icone-em-alta">library_add</span> Assistir mais tarde</button>

          <button id="tela-cheia-em-alta" class="tela-cheia" onClick="telaCheia()"><span class="material-symbols-outlined icone-em-alta">open_in_full</span>Tela Cheia</button>

          <button id="favoritar-em-alta" class="favoritar"><span class="material-symbols-outlined icone-em-alta">star</span> Favoritar</button>
         
        </div>

      <!--O trailer padrão-->
        <video id="trailer-1" class="trailer" src="media/videos/the_matrix.mp4" autoplay="on" muted loop playsinline></video>
      </div>

      <!--Logo e mensagem de boas vindas-->
      <div id="div-boas-vindas">
        <div id="div-logo">
          <img src="media/img/logo-1.png" alt="Logo CineREEList">
        </div>
        <h1>
          o <strong>MELHOR</strong> catálogo de filmes e séries<br>
          está à sua espera!
        </h1>
      </div>

      <!--Onde ficam as capas no Em Alta-->
      <div id="conteiner-transparente-em-alta">
        <h2 id="titulo-filmes-em-alta">Em alta</h2>
        <div id="div-filmes-em-alta">
          <div id="conteiner-capas-1-em-alta" class="conteiner-capas-1">
            <div id="conteiner-capas-2-em-alta" class="conteiner-capas-2">

              <!--As capas são populadas usando banco de dados-->
              <?= imagemAlta($pdo); ?>
            </div>
          </div>

          <!--Botões para mudar os filmes/séries exibidos-->
          <button id="mudar-em-alta-esquerda" class="botao-mudar-filmes material-symbols-outlined" onclick="rolarEsquerda(event)">
              keyboard_double_arrow_left
            </button>
          <button id="mudar-em-alta-direita" class="botao-mudar-filmes material-symbols-outlined" onclick="rolarDireita(event)">
            keyboard_double_arrow_right
          </button>
        </div>
      </div>
    </section>

    <!--Botão para ir para a seção de gêneros-->
    <a href="#secao-generos">
      <button id="rolar-tela-baixo" class="rolar-tela material-symbols-outlined">
        keyboard_double_arrow_down
      </button>
    </a>

    <!--Filmes/Séries exibidos por gênero-->
    <section id="secao-generos" class="secao">

      <!--Trailer padrão ao fundo-->
      <div id="div-trailer-2" class="div-trailer" >
        <video id="trailer-2" class="trailer" src="media/videos/the_matrix.mp4" autoplay="on" muted loop playsinline></video>
      </div>

      <!--Títulos dos gêneros-->
      <div id="div-titulos-generos">
        <h2 class="titulo-genero">Ação</h2>
        <h2 class="titulo-genero">Terror</h2>
        <h2 class="titulo-genero">Comédia</h2>
      </div>

      <div id="div-generos">
        <div class="conteiner-capas-1-generos" class="conteiner-capas-1">
          <div class="conteiner-capas-2-generos" class="conteiner-capas-2">
            
            <!--Capas são populadas automaticamente-->
            <?= imagemIndex("Ação",$pdo); ?>
          </div>
        </div>
        <div class="conteiner-capas-1-generos" class="conteiner-capas-1">
          <div class="conteiner-capas-2-generos" class="conteiner-capas-2">
            <?= imagemIndex("Terror",$pdo); ?>
          </div>
        </div>
        <div class="conteiner-capas-1-generos" class="conteiner-capas-1">
          <div class="conteiner-capas-2-generos" class="conteiner-capas-2">
            <?= imagemIndex("Comédia",$pdo); ?>
          </div>
        </div>
      </div>
    </section>
    
    <!--Botão para voltar à seção Em Alta-->
    <a href="#main">
      <button id="rolar-tela-cima" class="rolar-tela material-symbols-outlined">
        keyboard_double_arrow_up
      </button>
    </a>
  </main>

  <footer>
    <a href="pages/sobre.php">&copy; CineREEList&trade; 2025</a>
  </footer>
  
  <?php
    status($pdo);
  ?>
  <!--Scripts-->
  <script src="js/sideMenu.js"></script>
  <script src="js/index.js"></script>
</body>
</html>