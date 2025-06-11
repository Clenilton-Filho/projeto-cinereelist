<?php
// Verificar se o usuário está logado usando o cookie
if (!isset($_COOKIE['idUsuario'])) {
    header("Location: login.php");
    exit;
}

$rootPath = dirname(__DIR__);
require_once $rootPath . "/php/dataContext.php";

// Buscar informações do usuário
$pdo = conectar();
$stmt = $pdo->prepare("SELECT nome, email, imagem_url FROM usuario WHERE id = :id");
$stmt->execute([':id' => $_COOKIE['idUsuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    // Se não encontrar o usuário, remove o cookie e redireciona para login
    setcookie("idUsuario", "", time() - 3600, "/");
    header("Location: login.php");
    exit;
}

// Definir caminho da foto
$fotoUrl = '../media/img/user-black.png'; // Imagem padrão
if (!empty($usuario['imagem_url'])) {
    $caminhoFoto = $rootPath . '/' . $usuario['imagem_url'];
    if (file_exists($caminhoFoto)) {
        $fotoUrl = '../' . $usuario['imagem_url'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Perfil | CineREEList</title>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../style/perfil.css">
  <link rel="shortcut icon" href="../favicon-2.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0&icon_names=starlibrary_adddouble_arrowkeyboard_double_arrow_left" />
</head>
<body>
  <header id="header">
    <div id="header-esquerda">
        <button class="hamburguer-menu" onClick="sideMenu()">
            <img class="hamburguer-icone invertido" src="../media/img/hamburger-menu-black.png" alt="menu icon">
        </button>
        <a href="../index.php">
            <h1>Cine<span>REEL</span>ist</h1>
        </a>
    </div>
    <div id="header-direita">
        <div id="div-usuario">
            <a href="perfil.php">
              <span id="nome-usuario-header"><?php echo htmlspecialchars($usuario['nome'] ?? ''); ?></span>
            </a>
            <a href="perfil.php">
              <div id="div-foto-perfil-header" style="background-image: url(<?php echo htmlspecialchars($fotoUrl); ?>)"></div>
            </a>
        </div>
        <a class="link botao-sair" href="../php/logout.php">SAIR</a>
    </div>
  </header>
  <nav id="side-menu">
        <header>
            <button class="hamburguer-menu" onClick="sideMenu()">
                <img class="hamburguer-icone invertido" src="../media/img/hamburger-menu-black.png" alt="menu icon">
            </button>
        </header>
        <section id="links">
            <a class="link botao-cadastrar-entrar" href="cadastro.php">Cadastrar-se</a>
        </section>
  </nav>

  <!--Seção principal-->
  <main>

    <!--Seção do perfil-->
    <section class="secao-perfil">

      <!--Informações principais-->
      <div id="principal-perfil">
        
        <!--Foto de Perfil-->
        <img src="../media/img/lp_albums.gif" alt="Foto de perfil" class="foto-de-perfil">

        <!--Nome-->
        <h2 class="nome">Neo</h2>
        
        <!--Bio do Perfil-->
        <p class="bio">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, numquam. Fugiat facilis at iure, delectus earum eius, veniam possimus enim voluptas sunt aspernatur minus tempora molestiae natus unde corporis? Autem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, aliquid error eligendi esse asperiores assumenda nam dolorum quo quasi ex excepturi consequatur minus illum, accusantium nulla dolores vitae, qui expedita.</p>
      </div>

      <!--informações secundárias-->
      <div id="div-info">
          <h3>
            Cadastro em: <span class="info">05/06/2025</span>
          </h3>
          <h3>
            Último login: <span class="info">12/06/2025</span>
          </h3>
      </div>

      <div id="div-link-modificar">
        <a id="link-modificar" href="modificar-perfil.php">Atualizar Perfil</a>
      </div>
    </section>

    <!--Seção das capas de filmes/séries-->
    <section class="lista-de-filmes">

      <!--Primeira lista (Curtidos)-->
      <div class="lista">
        <div class="nome-lista">

          <!--Ícone da lista (span) e Nome da lista (fora do span)-->
          <span class="material-symbols-outlined">thumb_up</span>Curtidos
      </div>

        <!--Div que agrupa as outras-->
        <div class="div-filmes">

          <!--Cada div contém uma capa como background-image no CSS-->
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
        </div>

        <!--div com os botões referentes a essa lista, está fora da div com as capas, mas por cima dela-->
        <div class="div-botoes">
          <button class="mudar-capas mudar-capas-esquerda material-symbols-outlined" onClick="rolarEsquerda(event)">keyboard_double_arrow_left</button>
          <button class="mudar-capas mudar-capas-direita material-symbols-outlined" onClick="rolarDireita(event)">keyboard_double_arrow_right</button>
        </div>
      </div>

      <!--Segunda lista (Favoritos)-->
      <div class="lista">
        <div class="nome-lista"><span class="material-symbols-outlined">star</span>Favoritos</div>
        <div class="div-filmes">
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
        </div>
        <div class="div-botoes">
          <button class="mudar-capas mudar-capas-esquerda material-symbols-outlined" onClick="rolarEsquerda(event)">keyboard_double_arrow_left</button>
          <button class="mudar-capas mudar-capas-direita material-symbols-outlined" onClick="rolarDireita(event)">keyboard_double_arrow_right</button>
        </div>
      </div>

      <!--Terceira lista (Assistir mais tarde)-->
      <div class="lista">
        <div class="nome-lista"><span class="material-symbols-outlined">library_add</span>Assistir mais tarde</div>
        <div class="div-filmes">
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
          <div class="capa-filme"></div>
        </div>
        <div class="div-botoes">
          <button class="mudar-capas mudar-capas-esquerda material-symbols-outlined" onClick="rolarEsquerda(event)">keyboard_double_arrow_left</button>
          <button class="mudar-capas mudar-capas-direita material-symbols-outlined" onClick="rolarDireita(event)">keyboard_double_arrow_right</button>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <a href="sobre.php">&copy; CineREEList&trade; 2025</a>
  </footer>
  
  <!--Scripts-->
  <script src="../js/sideMenu.js"></script>
  <script src="../js/perfil.js"></script>

</body>
</html>