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
    <title>Modificar Perfil | CineREEList</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/modificar-perfil.css">
    <link rel="shortcut icon" href="../favicon-2.ico" type="image/x-icon">
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

    <main>
        <section class="Seção-Perfil">
            <div class="edit-profile-form">
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Perfil atualizado com sucesso!</div>
                <?php endif; ?>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-error">Erro ao atualizar perfil. Tente novamente.</div>
                <?php endif; ?>

                <form action="../php/atualizar_perfil.php" method="POST" enctype="multipart/form-data">
                    <h2>Editar Perfil</h2>
                    <img src="<?php echo htmlspecialchars($fotoUrl); ?>" 
                            alt="Foto de perfil"
                            class="preview-image"
                            id="preview-image"
                            onerror="this.src='../media/img/user-black.png';">

                    <h3>Foto de Perfil</h3>
                    <label id="label-foto" for="foto-perfil">Enviar Foto</label>
                    <input type="file" id="foto-perfil" name="foto-perfil" accept="image/*">

                    <h3>Nome</h3>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>" required>

                    <button type="submit" class="btn-save">Salvar Alterações</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <a href="pages/sobre.php">&copy; CineREEList&trade; 2025</a>
    </footer>

    <script>
        // Preview da imagem
        document.getElementById('foto-perfil').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="../js/sideMenu.js"></script>
</body>
</html> 