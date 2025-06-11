<?php
if (!isset($_COOKIE['idUsuario'])) {
    header("Location: login.php");
    exit;
}

$rootPath = dirname(__DIR__);
require_once $rootPath . "/php/dataContext.php";

$pdo = conectar();
$stmt = $pdo->prepare("SELECT nome, email, imagem_url FROM usuario WHERE id = :id");
$stmt->execute([':id' => $_COOKIE['idUsuario']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    setcookie("idUsuario", "", time() - 3600, "/");
    header("Location: login.php");
    exit;
}

$fotoUrl = '../media/img/user-black.png';
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CineREEList</title>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../style/sobre.css">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<body>
  <header id="header">
    <div id="header-esquerda">
      <a href="../index.php">
        <h1>Cine<span>REEL</span>ist</h1>
      </a>
    </div>
    <div id="div-nome-equipe">
      <h1>Equipe</h1>
      <img id="logo" src="../media/img/CRL.png" alt="Logo CineREEList">
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
  <!--Video de fundo -->
  <div id="div-video">
      <video id="video-fundo" src="../media/videos/fundo_matrix_FHD.mp4" autoplay="on" muted loop playsinline></video>
  </div>

  <!--Seção principal-->
  <main>

    <!--Colaboradores-->
    <section id="secao-colaboradores">

      <!--Cada colaborador está em uma div-->
      <div id="Erick" class="colaborador">

        <!--Imagem gif que aparece quando o mouse está em cima da div-->
        <div class="div-foto">
          <img src="../media/img/contribuidores/spawn.gif" alt="">
        </div>

        <!--Nome-->
        <h2 class="nome">Erick</h2>

        <!--O que a pessoa fez-->
        <div class="colaboracao">
          <p><span>HTML</span>Index, Perfil</p>
        </div>
      </div>  

      <div id="Antony" class="colaborador">
        <div class="div-foto">
          <img src="../media/img/contribuidores/doom_guy.gif" alt="">
        </div>
        <h2 class="nome">Antony</h2>
        <div class="colaboracao">
          <p><span>Liderança</span></p>
          <p><span>PHP</span>AtualizarFoto, buscarfoto, buscarUsuario, cadastrar, dataContext, login, logout, pegarImagem, statusUsuario</p>
          <p><span>BD</span>alterações no SupeBase</p>
        </div>

      </div>

      <div id="Jonathan" class="colaborador">
        <div class="div-foto">
          <img src="../media/img/contribuidores/spider_man.gif" alt="">
        </div>
        <h2 class="nome">Jonathan</h2>
        <div class="colaboracao">
          <p><span>HTML</span>Cadastro, Index, Login</p>
          <p><span>PHP</span>Cadastro, Index</p>
          <p><span>JS</span>Index, Cadastro, Login</p>
          <p><span>BD</span>Estrutura e conexão</p>
        </div>
      </div>

      <div id="Eduardo" class="colaborador">
        <div class="div-foto">
          <img src="../media/img/contribuidores/dr_doom.gif" alt="">
        </div>
        <h2 class="nome">Eduardo</h2>
        <div class="colaboracao">
          <p><span>Design</span>Cores e logo do projeto, Index, Perfil</p>
          <p><span>CSS</span>Perfil, Modificar Perfil, Sobre</p>
        </div>
      </div>

      <div id="Jesus" class="colaborador">
        <div class="div-foto">
          <img src="../media/img/contribuidores/azrael.gif" alt="">
        </div>
        <h2 class="nome">Jesus</h2>
        <div class="colaboracao">
          <p><span>HTML</span>Index, Perfil</p>
        </div>
      </div>

      <div id="Clenilton" class="colaborador">
        <div class="div-foto">
          <img src="../media/img/contribuidores/zer0.gif" alt="">
        </div>
        <h2 class="nome">Clenilton</h2>
        <div class="colaboracao">
          <p><span>Design</span>Index, Login, Cadastro, Sobre</p>
          <p><span>HTML</span> Cadastro, Login, Sobre, Perfil</p>
          <p><span>CSS</span> Index, Cadastro, Login</p>
          <p><span>JS Front-End</span> Index, Cadastro, Perfil</p>
        </div>
      </div>

      </div>
    </section>
  </main>

  <footer>
    <p>&copy; CineREEList&trade; 2025</p>
  </footer>
  <!--Scripts-->
  <script src="../js/sideMenu.js"></script>
  <script src="../js/sobre.js"></script>
</body>