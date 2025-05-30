<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>CineREEList</title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/index.css">
  <link rel="shortcut icon" href="../favicon-2.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=starlibrary_adddouble_arrowkeyboard_double_arrow_left" />
</head>
<body>
  <?php
    include "php/dataContext.php";
    include "php/pegar_imagem.php";  
    $pdo = conectar();
    
  ?>
  <header id="header">
    <div id="header-esquerda">
        <a href="index.html">
          <h1>Cine<span>REEL</span>ist</h1>
        </a>
    </div>
    <div id="header-direita">
      <div id="div-usuario">
        <span id="nome-usuario-header">Usuário</span>
        <div id="div-foto-perfil">
          <a href="pages/perfil.html">
            <img id="foto-perfil-header" src="media/img/user-black.png" class="icon" alt="foto de perfil do usuário">
          </a>
        </div>
      </div>
      <a class="link botao-cadastrar-entrar" href="pages/cadastro.php">CADASTRAR-SE</a>
      <a class="link botao-cadastrar-entrar" href="pages/login.html">ENTRAR</a>
    </div>
  </header>

  <main id="main">
    <div id="div-cadeiras">
      <video id="video-cadeiras" src="media/videos/chairs-loop.mp4" autoplay="on" muted loop playsinline></video>
    </div>
    
    <section id="secao-em-alta" class="secao">
      <div id="div-trailer-1" class="div-trailer">
        <div id="div-botoes-trailer-em-alta" class="div-botoes-trailer"> 
          <button id="mais-tarde-em-alta" class="assistir-mais-tarde"><span class="material-symbols-outlined">library_add</span> Assistir mais tarde</button>

          <button id="tela-cheia-em-alta" class="tela-cheia" onClick="telaCheia()"><span class="material-symbols-outlined">open_in_full</span>Tela Cheia</button>

          <button id="favoritar-em-alta" class="favoritar"><span class="material-symbols-outlined">star</span> Favoritar</button>

          
        </div>
        <video id="trailer-1" class="trailer" src="media/videos/the_matrix_trailer_2.mp4" autoplay="on" muted loop playsinline></video>
      </div>
      <div id="div-boas-vindas">
        <div id="div-logo">
          <img src="media/img/logo-1.png" alt="Logo CineREEList">
        </div>
        <h1>
          o <strong>MELHOR</strong> catálogo de filmes<br>
          está à sua espera!
        </h1>
      </div>

      <div id="conteiner-transparente-em-alta">
        <h2 id="titulo-filmes-em-alta">Em alta</h2>
        <div id="div-filmes-em-alta">
          <div id="conteiner-capas-1-em-alta" class="conteiner-capas-1">
            <div id="conteiner-capas-2-em-alta" class="conteiner-capas-2">
              <div class="div-capa-filme-em-alta" >
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/the_matrix.jpg" alt="capa de filme" onMouseEnter="mudarFilme(event)">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/revenge_of_the_sith.jpg" alt="capa de filme" onMouseEnter="mudarFilme(event)">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/the_matrix_revolutions.jpg" alt="capa de filme">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/the_matrix_resurrections.jpg" alt="capa de filme">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/the_matrix_path_of_neo.jpg" alt="capa de filme">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/enter_the_matrix.jpg" alt="capa de filme">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/deus_ex.jpg" alt="capa de filme">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/deus_ex_human_revolution.jpg" alt="capa de filme">
              </div>
              <div class="div-capa-filme-em-alta">
                <span class="curti material-symbols-outlined">thumb_up</span>
                <img src="media/img/deus_ex_mankind_divided.jpg" alt="capa de filme">
              </div>
            </div>
          </div>
          <button id="mudar-em-alta-esquerda" class="botao-mudar-filmes material-symbols-outlined" onclick="rolarEsquerda(event)">
              keyboard_double_arrow_left
            </button>
          <button id="mudar-em-alta-direita" class="botao-mudar-filmes material-symbols-outlined" onclick="rolarDireita(event)">
            keyboard_double_arrow_right
          </button>
        </div>
      </div>
    </section>
    <a href="#secao-generos">
      <button id="rolar-tela-baixo" class="rolar-tela material-symbols-outlined">
        keyboard_double_arrow_down
      </button>
    </a>

    <section id="secao-generos" class="secao">
      <div id="div-trailer-2" class="div-trailer" >
        <video id="trailer-2" class="trailer" src="media/videos/the_matrix_trailer_2.mp4" autoplay="on" muted loop playsinline></video>
      </div>
      <h2 class="titulo-genero">Ação</h2>
      <div class="div-filmes">
        <div class="conteiner-capas-1-generos" class="conteiner-capas-1">
          <div class="conteiner-capas-2-generos" class="conteiner-capas-2">
            <?= imagemAcaoIndex($pdo); ?>
          </div>
        </div>
      </div>
      <h2 class="titulo-genero">Terror</h2>
      <div class="div-filmes">
        <div class="conteiner-capas-1-generos" class="conteiner-capas-1">
          <div class="conteiner-capas-2-generos" class="conteiner-capas-2">
            <div class="div-capa-filme-generos">
              <span class="curti material-symbols-outlined">thumb_up</span>
              <img src="media/img/the_matrix.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_reloaded.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_revolutions.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_resurrections.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_path_of_neo.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/enter_the_matrix.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/deus_ex.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/deus_ex_human_revolution.jpg" alt="capa de filme">
            </div>
          </div>
        </div>
      </div>
      <h2 class="titulo-genero">Comé</h2>
      <div class="div-filmes">
        <div class="conteiner-capas-1-generos" class="conteiner-capas-1">
          <div class="conteiner-capas-2-generos" class="conteiner-capas-2">
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_reloaded.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_revolutions.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_resurrections.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/the_matrix_path_of_neo.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/enter_the_matrix.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/deus_ex.jpg" alt="capa de filme">
            </div>
            <div class="div-capa-filme-generos">
              <img src="media/img/deus_ex_human_revolution.jpg" alt="capa de filme">
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <a href="#main">
      <button id="rolar-tela-cima" class="rolar-tela material-symbols-outlined">
        keyboard_double_arrow_up
      </button>
    </a>
  </main>

  <footer>
    <p>&copy; CineREEList&trade; 2025</p>
  </footer>

  <!--Scripts-->
  <script src="js/sideMenu.js"></script>
  <script src="js/index.js"></script>
</body>
</html>