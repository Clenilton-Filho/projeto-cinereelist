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
    <link rel="stylesheet" href="../style/header.css">
    <link rel="shortcut icon" href="../favicon-2.ico" type="image/x-icon">
    <style>
        .edit-profile-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #444;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .preview-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 10px 0;
            border: 3px solid #ffffff;
        }
        .btn-save {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-save:hover {
            background: #45a049;
        }
        .alert {
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
        }
        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }
        .alert-error {
            background: rgba(244, 67, 54, 0.1);
            color: #f44336;
        }
    </style>
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

    <main>
        <section class="Seção-Perfil">
            <div class="edit-profile-form">
                <h2>Editar Perfil</h2>
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Perfil atualizado com sucesso!</div>
                <?php endif; ?>
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-error">Erro ao atualizar perfil. Tente novamente.</div>
                <?php endif; ?>

                <form action="../php/atualizar_perfil.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <img src="<?php echo htmlspecialchars($fotoUrl); ?>" 
                             alt="Foto de perfil" 
                             class="preview-image" 
                             id="preview-image"
                             onerror="this.src='../media/img/user-black.png';">
                        <label for="foto-perfil">Foto de Perfil</label>
                        <input type="file" id="foto-perfil" name="foto-perfil" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($usuario['email'] ?? ''); ?>" disabled>
                    </div>

                    <button type="submit" class="btn-save">Salvar Alterações</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; CineREEList&trade; 2025</p>
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