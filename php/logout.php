<?php
// Remove o cookie idUsuario
setcookie("idUsuario", "", time() - 3600, "/");
unset($_COOKIE['idUsuario']); // Limpa também da variável $_COOKIE

// Redireciona para a página de login
header("Location: ../pages/login.php");
exit;
?> 