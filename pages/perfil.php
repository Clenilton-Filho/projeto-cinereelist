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

// Variáveis para nome e descrição do usuário
$nomeUsuario = $usuario['nome'] ?? '';
$descricaoUsuario = $usuario['descricao'] ?? '';

// Definir caminho da foto
$fotoUrl = '../media/img/user-black.png'; // Imagem padrão
if (!empty($usuario['imagem_url'])) {
    $caminhoFoto = $rootPath . '/' . $usuario['imagem_url'];
    if (file_exists($caminhoFoto)) {
        $fotoUrl = '../' . $usuario['imagem_url'];
    }
}

// Debug para verificar os caminhos
error_log("Caminho da foto: " . $fotoUrl);
error_log("Caminho completo: " . $caminhoFoto ?? 'Não definido');
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
            <a href="../index.html">
                <h1>Cine<span>REEL</span>ist</h1>
            </a>
        </div>
        <div id="header-direita">
            <div id="div-usuario">
                <span id="nome-usuario-header"><?php echo htmlspecialchars($usuario['nome'] ?? ''); ?></span>
                <img src="<?php echo htmlspecialchars($fotoUrl); ?>" 
                     class="<?php echo empty($usuario['imagem_url']) ? 'icon' : ''; ?>" 
                     alt="foto de perfil do usuário" 
                     onerror="this.src='../media/img/user-black.png';"
                     style="display: block; width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
            </div>
            <a class="link botao-sair" href="../php/logout.php">SAIR</a>
        </div>
    </header>
    <section id="links">
        <a class="link botao-cadastrar-entrar" href="pages/cadastro.php">Cadastrar-se</a>
        <a class="link botao-cadastrar-entrar" href="login.php">Entrar</a>
    </section>
  </nav>

  <!--Seção principal-->
  <main>

    <!--Seção do perfil-->
    <section class="secao-perfil">

      <!--Informações principais-->
      <div id="principal-perfil">
        
        <!--Foto de Perfil-->
        <img src="<?=$fotoUrl?>" alt="Foto de perfil" class="foto-de-perfil">

        <!--Nome-->
        <h2 class="nome"><?=$nomeUsuario?></h2>
        
        <!--Bio do Perfil-->
        <p class="bio">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, numquam. Fugiat facilis at iure, delectus earum eius, veniam possimus enim voluptas sunt aspernatur minus tempora molestiae natus unde corporis? Autem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, aliquid error eligendi esse asperiores assumenda nam dolorum quo quasi ex excepturi consequatur minus illum, accusantium nulla dolores vitae, qui expedita. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione vero nemo debitis, quia quibusdam, harum, nostrum quaerat ipsam ipsum minus magnam deleniti exercitationem? Repudiandae totam iste officiis libero minus eaque.</p>
      </div>

      <!--informações secundárias-->
      <div id="div-info">
          <h3>
            Cadastro em: <span class="info">05/06/2025</span>
          </h3>
          <h3>
            Último login: <span class="info">05/06/2025</span>
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
          <div style="background-image: url(media/capas/um_filme_minecraft.jpg)" class="capa-filme">1</div>
          <div class="capa-filme">2</div>
          <div class="capa-filme">3</div>
          <div class="capa-filme">4</div>
          <div class="capa-filme">5</div>
          <div class="capa-filme">6</div>
          <div class="capa-filme">7</div>
          <div class="capa-filme">8</div>
          <div class="capa-filme">9</div>
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
          <div class="capa-filme">1</div>
          <div class="capa-filme">2</div>
          <div class="capa-filme">3</div>
          <div class="capa-filme">4</div>
          <div class="capa-filme">5</div>
          <div class="capa-filme">6</div>
          <div class="capa-filme">7</div>
          <div class="capa-filme">8</div>
          <div class="capa-filme">9</div>
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
          <div class="capa-filme">1</div>
          <div class="capa-filme">2</div>
          <div class="capa-filme">3</div>
          <div class="capa-filme">4</div>
          <div class="capa-filme">5</div>
          <div class="capa-filme">6</div>
          <div class="capa-filme">7</div>
          <div class="capa-filme">8</div>
          <div class="capa-filme">9</div>
        </div>
        <div class="div-botoes">
          <button class="mudar-capas mudar-capas-esquerda material-symbols-outlined" onClick="rolarEsquerda(event)">keyboard_double_arrow_left</button>
          <button class="mudar-capas mudar-capas-direita material-symbols-outlined" onClick="rolarDireita(event)">keyboard_double_arrow_right</button>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; CineREEList&trade; 2025</p>
  </footer>
  
  <!--Scripts-->
  <script src="../js/sideMenu.js"></script>
  <script src="../js/perfil.js"></script>

</body>
</html>